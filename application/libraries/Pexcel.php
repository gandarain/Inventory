<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/PHPExcel.php';

class PExcel extends PHPExcel {
    public $max_data = 10000;
    public $formatCurrency = 'currency';
    public $formatQty = 'quantity';
    public $formatTextCenter = 'center';
    public $formatNumber = 'number';

    private $table_headers = array();
    private $table_details = array();
    private $properties = array();
    private $multi_row_headers = 1;
    private $_styleHeader = array();
    private $_styleBorder = array();
    private $_styleAddOns = array();
    private $_styleSubtotal = array();
    private $_styleGrandTotal = array();
    private $_stylesDetail = array();
    private $CI;
    private $no_merging = 1;
    private $excel_dir = 'spreadsheets';
    private $subtotal_label = 'SUBTOTAL';
    private $grandtotal_label = 'GRAND TOTAL';

    private $filename = 'Excel Recap';
    private $creator = 'MKD Cakebox';
    private $subject = 'Office 2007 XLSX User Document';
    private $keyword = 'Excel';
    private $category = 'Report';

    private $currentCell = '';
    private $currentCol = '';
    private $currentRow = '';
    private $firstCell = '';
    private $lastCell = '';
    private $colPointer = '';
    private $rowPointer = '';
    private $nullCell = '-';
    private $initColPointer = 'A';
    private $initRowPointer = 2;
    private $firstRowDetail = '';
    private $lastRowDetail = '';
    private $firstColDetail = '';
    private $lastColDetail = '';
    private $tableLengthCol = '';
    private $activeSheet;
    private $willBeMerged = array();
    private $_styledColumns = array();
    private $_styledRows = array();
    private $_styledCells = array();

    private $_formatCurrency = array(
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
        'font' => array('italic' => true),
        'code' => '#,##0.00'
    );
    private $_formatQty = array(
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
        'font' => array('italic' => true),
        'code' => '#,##0.00'
    );
    private $_formatNumber = array(
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
        'font' => array('italic' => true),
        'code' => '#,##0.00'
    );
    private $_formatText = array(
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
    );
    private $_formatCellColor = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => PHPExcel_Style_Color::COLOR_RED
        )
    );

    public function __construct(){
        parent::__construct();
        $this->CI =& get_instance();

        $this->_styleHeader = array(
            'font'  => array('bold'  => true),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '50A0D2')
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )
        );
        $this->_styleAddOns = array(
            'font'  => array(
                'bold'  => true,
                'size' => 16
            ),
        );
        $this->_styleBorder = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );
        $this->_styleSubtotal = array(
            'font'  => array('bold'  => true),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '9AA9C3')
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );
        $this->_styleGrandTotal = array(
            'font'  => array('bold'  => true),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '8490A3')
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );
        $this->_stylesDetail = array(
            'format' => array(
                $this->formatCurrency => $this->_formatCurrency,
                $this->formatTextCenter => $this->_formatText,
                $this->formatQty => $this->_formatQty,
                $this->formatNumber => $this->_formatNumber
            ),
            'cellColor' => $this->_formatCellColor
        );

        $this->prepExcelDir();
    }

    protected function validate_data() {
        if(!is_array($this->table_headers)) {
            throw new Exception('Headers must be array');
        }
        if(!is_array($this->table_details)) {
            throw new Exception('Details must be array');
        }
        if(!is_array($this->properties)) {
            throw new Exception('Properties must be array');
        }

        $is_hdr_multirow = $this->isMultiDimension($this->table_headers);
        if($is_hdr_multirow === true) 
        {
            if(!isset($this->properties['rowspan']) OR $this->properties['rowspan'] < 2) {
                $this->multi_row_headers = 2; // 2 is minimum
            } else {
                $this->multi_row_headers = $this->properties['rowspan'];
            }
        }
    }

    /**
     * Excel Generator
     * @param table_headers - contains array of headers labels
     * @param table_details - contains array of details value
     * @param properties - contains some properties and options
     */
    public function excelGenerator($table_headers = array(), $table_details = array(), $properties = array())
    {
        $this->table_headers = $table_headers;
        $this->table_details = $table_details;
        $this->properties = $properties;
        $this->validate_data();
        $user_info = $this->CI->session->userdata('user_info');
        $haveAddons = false;

        // Set file properties
        $file_name = (isset($this->properties['file_name']) && $this->properties['file_name'] != '')? $this->properties['file_name'] : $this->filename;
        $file_subject = (isset($this->properties['file_subject']))?: $this->subject;
        $file_description = (isset($this->properties['file_description']))?: $file_subject;
        $file_category = (isset($this->properties['file_category']))?: $this->category;

        $excel = new PHPExcel();
        $excel->getProperties()
            ->setCreator($this->creator)
            ->setLastModifiedBy($this->creator)
            ->setTitle($file_name)
            ->setSubject($file_subject)
            ->setDescription($file_description)
            ->setCategory($file_category);

        $this->activeSheet = $excel->setActiveSheetIndex(0);

        $this->colPointer = $this->initColPointer;
        $this->rowPointer = $this->initRowPointer;
        $this->_setCurrentCell();
        $this->firstCell = $this->lastCell = $this->currentCell;

        // ******************* Decide to Draw Header Info later ******************* //
        if(isset($this->properties['addon_info']) && !empty($this->properties['addon_info']))
        {
            if(is_array($this->properties['addon_info']))
            {
                $this->rowPointer = $this->rowPointer + 1 + count($this->properties['addon_info']);
                $haveAddons = true;
            }
        }
        // ******************* /Decide to Draw Header Info later ******************* //
        // ******************* Draw Table Headers ******************* //
        if(isset($this->properties['header_style']) && is_array($this->properties['header_style']))
        {
            // if header style is settle
            $this->_styleHeader = $this->properties['header_style'];
        }

        // Do horizontal loop
        foreach ($this->table_headers as $ith => $th) {
            $this->_setCurrentCell();
            $this->_setCurrentRow();
            $multirow = $this->currentCell.":".$this->colPointer.(($this->multi_row_headers + $this->rowPointer) - $this->no_merging);

            if(is_array($th) && !empty($th))
            {
                // Do vertical loop
                $this->activeSheet->setCellValue($this->currentCell, $th['main_col']);
                $this->activeSheet->getStyle($this->currentCell)->applyFromArray($this->_styleHeader);
                $countSubCol = count($th['sub_col']);

                foreach ($th['sub_col'] as $iscol => $scol) {
                    $currentSubCell = $this->colPointer.(($this->multi_row_headers + $this->rowPointer) - $this->no_merging);
                    $this->activeSheet->setCellValue($currentSubCell, $scol);
                    $this->activeSheet->getStyle($currentSubCell)->applyFromArray($this->_styleHeader);

                    if($iscol != ($countSubCol - 1) && $iscol < $countSubCol) {
                        $this->colPointer++;
                    }
                }

                array_push($this->willBeMerged, $this->currentCell.":".$this->colPointer.$this->rowPointer);
            }
            else
            {
                if(is_array($th)) {
                    $th = '-';
                }

                $this->activeSheet->setCellValue($this->currentCell, $th);
                $this->activeSheet->getStyle($multirow)->applyFromArray($this->_styleHeader);

                if($this->multi_row_headers > $this->no_merging) {
                    array_push($this->willBeMerged, $multirow);
                    $this->currentCell = $this->colPointer.(($this->multi_row_headers + $this->rowPointer) - $this->no_merging);
                }
            }

            $this->colPointer++;
        }
        // ******************* /Draw Table Headers ******************* //
        $this->rowPointer = (($this->multi_row_headers + $this->rowPointer) - $this->no_merging) + 1; // go below header row
        $this->firstRowDetail = $this->rowPointer;
        // ******************* Draw Table Details ******************* //
        if(!empty($this->table_details))
        {
            foreach ($this->table_details as $itr => $r) {
                $this->colPointer = $this->initColPointer; // Reset column pointer
                if(is_object($r)) $r = (array)$r; // Casting Object to Array

                foreach($r as $itd => &$td) {
                    $this->_setCurrentCell();
                    $this->_drawDetailRow($td);
                    $this->colPointer++;
                }

                $this->rowPointer++;
            }
        }
        // ******************* /Draw Table Details ******************* //
        // ******************* SET TABLE STYLING ******************* //
        // ****** TABLE BORDERS ******  //
        if (!isset($this->properties['border']) || isset($this->properties['border']) && $this->properties['border'] !== false)
            $this->activeSheet->getStyle("$this->firstCell:$this->lastCell")->applyFromArray($this->_styleBorder);
        // ****** /TABLE BORDERS ******  //
        $this->_applyRowsStyle();
        // ******************* /SET TABLE STYLING ******************* //
        // ****** TRICK FOR AUTOSIZE MERGED COLUMNS ******  //
        // this code have the best execution time because calculateColumnWidths
        // only executed once
        for ($col=$this->initColPointer; $col < $this->colPointer ; $col++) { 
            $this->activeSheet->getColumnDimension($col)->setAutoSize(true);
        }
        $this->activeSheet->calculateColumnWidths();
        for ($col=$this->initColPointer; $col < $this->colPointer ; $col++) { 
            $this->activeSheet->getColumnDimension($col)->setAutoSize(false);
        }
        // ****** /TRICK FOR AUTOSIZE MERGED COLUMNS ******  //
        // ******************* Draw Header Info ******************* //
        if($haveAddons === true)
        {
            $this->rowPointer = $this->initRowPointer;
            $this->colPointer = $this->initColPointer;
            foreach ($this->properties['addon_info'] as $iaddon => $addon) {
                if(!is_string($addon) && !is_int($addon)) {
                    throw new Exception("Additional information params, should contain only 1 level array of strings");
                }

                $countCol = count($this->table_headers);
                $this->_setCurrentCell();
                $this->activeSheet->setCellValue($this->currentCell, $addon);
                $this->activeSheet->getStyle($this->currentCell)->applyFromArray($this->_styleAddOns);
                $last_col = $this->multiplyAbjad(($countCol-1), $this->colPointer);
                $this->lastCell = $last_col.$this->rowPointer;
                array_push($this->willBeMerged, $this->currentCell.':'.$this->lastCell);
                $this->rowPointer++;
            }
        }
        // ******************* /Draw Header Info ******************* //
        // ******************* Merging Cells ******************* //
        foreach($this->willBeMerged as $mc) {
            $this->activeSheet->mergeCells($mc);
        }
        // ******************* /Merging Cells ******************* //
        $this->activeSheet->setTitle((isset($this->properties['sheet_name']))? $this->properties['sheet_name'] : 'Sheet 1');

        $folder_path = $this->excel_dir;
        if(isset($this->properties['folder_path']) && $this->properties['folder_path'] != '')
            $folder_path .= '/'.$this->properties['folder_path'];

        $save_location = $folder_path.'/'.$file_name.'.xlsx';

        try {
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $objWriter->save($save_location);

            $excel->disconnectWorksheets();
            unset($excel);

            // NOTE Execution Time 0.6xxx
            return array(true, $save_location);
        } catch (Exception $e) {
            return array(false, $e->getMessage());
        }
    }

    protected function multiplyAbjad($int, $abj = 'A')
    {
        $newAbj = chr(ord($abj) + $int);

        return $newAbj;
    }

    protected function isMultiDimension($array)
    {
        $multi = array_filter($array, 'is_array');
        return (count($multi) > 0);
    }

    public function prepExcelDir($specific_folder = null)
    {
        // Create if not exists spreadsheet main folder
        $spreadsheet_folder = $this->excel_dir;
        $this->createDir($spreadsheet_folder);

        if($specific_folder) {
            $specific_folder = str_replace(' ', '_', strtolower($specific_folder));
            $full_path = $spreadsheet_folder.'/'.$specific_folder;
            $this->createDir($full_path);
        } else {
            $full_path = $spreadsheet_folder;
        }

        // Delete existing .XLSX file
        $this->deleteFiles($full_path.'/*.xlsx');
        // Delete existing ZIP File
        if($specific_folder)
            $this->deleteFiles($full_path.'*.zip');

        return $full_path;
    }

    protected function createDir($directory)
    {
        $path = realpath($directory);
        $is_exists = ($path !== FALSE && is_dir($path))? TRUE : FALSE;

        if($is_exists === FALSE) {
            mkdir($directory);
            chmod($directory, 0777);
        }
    }

    protected function deleteFiles($files_path)
    {
        $files = glob($files_path);

        foreach ($files as $f) {
            if(is_file($f))
                unlink($f);
        }
    }

    private function alphabetToNumber($input, $reverse = false)
    {
        $alphabetASCIIStart = 96;
        if($reverse === true) {
            if($input)
                return chr($input + $alphabetASCIIStart);
            else
                return '';
        } else {
            if($input)
                return ord(strtolower($input)) - $alphabetASCIIStart;
            else
                return 0;
        }
    }

    private function _drawDetailRow($td)
    {
        if(is_array($td)) {
            $cellValue = isset($td['value']) ? $td['value'] : $this->nullCell;
            $this->activeSheet->setCellValue($this->currentCell, $cellValue);
            $this->_applyCellStyle($td);
            $this->_pushStyleProps($td);
        } else {
            $this->activeSheet->setCellValue($this->currentCell, $td);
        }
    }

    private function _setCurrentRow()
    {
        $this->currentRow = $this->initColPointer.$this->rowPointer.":".$this->currentCell;
    }

    private function _setCurrentCell()
    {
        $this->currentCell = $this->colPointer.$this->rowPointer;
        $this->lastCell = $this->currentCell;
    }

    private function _pushStyleProps($options = array())
    {
        // ****************** INDIRECT STYLE ****************** //
        // Row/Columns Styling (will applied later)
        if (!empty($options['rowStyle'])) 
        {
            $this->_styledRows[$this->rowPointer] = $options['rowStyle'];
        }
        if(!empty($options['colStyle']))
        {
            $colIndex = $this->alphabetToNumber($this->colPointer);
            $this->_styledColumns[$colIndex] = $options['colStyle'];
        }

        if(!empty($options['colSpan'])) {
            $nextCell = $this->getCellRow($this->currentCell, $options['colSpan']);
            array_push($this->willBeMerged, sprintf('%s:%s', $this->currentCell, $nextCell));
        }
        // ****************** /INDIRECT STYLE ****************** //
    }

    private function _setColumnsStyle()
    {
        if(isset($this->properties['columnsStyle']) && !empty($this->properties['columnsStyle']) && is_array($this->properties['columnsStyle']))
        {
            foreach ($this->properties['columnsStyle'] as $icolStyle => $colStyle) {
                $targets = $colStyle['targets'];
                if (is_array($targets)) {
                    foreach ($targets as $t) {
                        $currStyles = array();
                        if(!empty($colStyle['format'])) {
                            $currStyles = array_merge_recursive($currStyles, $this->_stylesDetail['format'][$colStyle['format']]);
                        }
                        if(!empty($colStyle['style'])) {
                            $currStyles = array_merge_recursive($currStyles, $colStyle['style']);
                        }

                        $this->_styledColumns[$t] = $currStyles;
                    }
                } else {
                    throw new Exception("targets must be contains array", 1);
                }
            }
        }
    }

    private function _applyCellStyle($options)
    {
        // ****************** DIRECT STYLE ****************** //
        // Current Cell Styling (applied directly)
        if(!empty($options['style'])) {
            // using PHPExcel Styling Array
            $this->activeSheet->getStyle($this->currentCell)->applyFromArray($options['style']);
        } else {
            $cellStyle = array();
            if (!empty($options['format'])) {
                $cellStyle = $this->_stylesDetail['format'][$options['format']];
                // Apply Number Format into current cell
                $this->activeSheet->getStyle($this->currentCell)->getNumberFormat()->applyFromArray($cellStyle);
            }

            if(!empty($options['align'])) {
                $cellStyle = array_merge($cellStyle, $this->getCellAlignment($options['align']));
            }

            // Apply Cell Styling
            $this->activeSheet->getStyle($this->currentCell)->applyFromArray($cellStyle);
        }
        // ****************** /DIRECT STYLE ****************** //
    }

    protected function _applyRowsStyle()
    {
        $fcol = $this->getCol($this->firstCell);
        $lcol = $this->getCol($this->lastCell);

        foreach ($this->_styledRows as $ir => $r) {
            $fcell = $fcol.$ir;
            $lcell = $lcol.$ir;
            $this->activeSheet->getStyle($fcell.':'.$lcell)->applyFromArray($r);
        }
    }

    private function getCol($cell)
    {
        return preg_replace('/[0-9]/', '', $cell);
    }

    private function getRow($cell)
    {
        return preg_replace('/[a-zA-Z]/', '', $cell);
    }

    private function getCellRow($initialPoint, $toPoint = 1)
    {
        if($toPoint < 1) {
            return $initialPoint;
        }

        $row = $this->getRow($initialPoint);
        $nextCol = $this->alphabetToNumber($initialPoint) + ($toPoint-1);
        $nextCol = $this->alphabetToNumber($nextCol, true);

        return strtoupper($nextCol.$row);
    }

    private function getCellAlignment($align)
    {
        $horizontal = 0;
        $vertical = 1;
        $align = explode(' ', $align);

        $no_vertical = array('left', 'right');
        $no_horizontal = array('top', 'bottom');

        if(empty($align[$vertical]))
            $align[$vertical] = $align[$horizontal];

        if(in_array($align[$horizontal], $no_vertical) && !in_array($align[$vertical], $no_horizontal)) {
            $align[$vertical] = 'bottom';
        }

        return array(
            'alignment' => array(
                'horizontal' => $align[$horizontal],
                'vertical' => $align[$vertical]
            )
        );
    }

    public function subtotalStyle()
    {
        return $this->_styleSubtotal;
    }

    public function grandTotalStyle()
    {
        return $this->_styleGrandTotal;
    }
}
