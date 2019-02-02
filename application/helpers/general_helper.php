<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Helper
 * to store our custom function
 */

function ERROR_DELIMITER($message)
{
    $error_string = '<div class="alert alert-danger alert-dismissable fade in"><button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true"><i class="fas fa-xs fa-times"></i></span></button>'.$message.'</div>';

    return $error_string;
}

function SUCCESS_DELIMITER($message)
{
    $error_string = '<div class="alert alert-success alert-dismissable fade in"><button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true"><i class="fas fa-xs fa-times"></i></span></button>'.$message.'</div>';

    return $error_string;
}

function WARNING_DELIMITER($message)
{
    $error_string = '<div class="alert alert-warning alert-dismissable fade in"><button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true"><i class="fas fa-xs fa-times"></i></span></button>'.$message.'</div>';

    return $error_string;
}

function INFO_DELIMITER($message)
{
    $error_string = '<div class="alert alert-info alert-dismissable fade in"><button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true"><i class="fas fa-xs fa-times"></i></span></button>'.$message.'</div>';

    return $error_string;
}

/**
 * Formatting Response into JSON (New format of JSON_RESPONSE())
 * Support for Unit testing mode
 *
 * @param integer $status Response Status (See: Constants.php)
 * @param string $message Response Messages
 * @param array $params Response additional properties
 * @param boolean $withDelimiter Print Response with Delimiter (template div styles based on Response Status)
 * @param boolean $stop Stop run code after execute this function
 *
 * @return
 */
function JSONRES($status, $message, $params = array(), $withDelimiter = false, $stop = true) {
    // for new template
    if(!empty($_ENV['UNIT_TEST']) && $_ENV['UNIT_TEST'] === TRUE) {
        $json_response = JSON_RESPONSE($status, $message, $withDelimiter, $params, false);
        $json_response = json_decode($json_response); // revert back to json encode
        return $json_response;
    } else {
        JSON_RESPONSE($status, $message, $withDelimiter, $params, $stop);
    }
}

/**
 * Formatting Response into JSON
 *
 * @param integer $status Response Status (See: Constants.php)
 * @param string $message Response Messages
 * @param boolean $withDelimiter Print Response with Delimiter (template div styles based on Response Status)
 * @param array $params Response additional properties
 * @param boolean $stop Stop run code after execute this function
 *
 * @return
 */
function JSON_RESPONSE($status, $message, $withDelimiter = true, $params = array(), $stop = true)
{
    if($withDelimiter === true)
    {
        switch ($status) {
            case _SUCCESS:
                $message = SUCCESS_DELIMITER($message);
                break;
            case _WARNING:
                $message = WARNING_DELIMITER($message);
                break;
            case _ERROR:
                $message = ERROR_DELIMITER($message);
                break;
            case _INFO:
                $message = INFO_DELIMITER($message);
                break;
            default:
                $message = ERROR_DELIMITER($message);
                break;
        }
    }

    $jsonRet = array('status' => $status, 'message' => $message);

    if(!empty($params))
    {
        foreach ($params as $index => $value)
        {
            $jsonRet[$index] = $value;
        }
    }

    echo json_encode($jsonRet);
    if($stop === true)
    {
        die();
    }
    else
    {
        return;
    }
}

function PRINT_ERROR($message)
{
    $error_string = '<div class="col-lg-12"><div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div></div>';

    return $error_string;
}

function PRINT_SUCCESS($message)
{
    $error_string = '<div class="col-lg-12"><div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.' <i class="fa fa-refresh fa-spin"></i></div></div>';

    return $error_string;
}

function PRINT_WARNING($message)
{
    $error_string = '<div class="col-lg-12"><div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div></div>';

    return $error_string;
}

function _PREP_UPLOAD_DIR()
{
    // Custom Temporary folder for uploads
    _CREATE_DIR(FOLDER_IMAGES_TEMP); // Create folder images temp if not exists
    _CREATE_DIR(FOLDER_FILES_TEMP); // Create folder files temp if not exists
    // Real uploads folder
    _CREATE_DIR(FOLDER_IMAGES); // Create folder images if not exists
    _CREATE_DIR(FOLDER_FILES); // Create folder files if not exists
}

function _CREATE_DIR($directory)
{
    $dir_explode = explode(DIRECTORY_SEPARATOR, $directory);
    $create_folder = '';
    for ($i=0; $i < count($dir_explode) ; $i++) {
        if(!empty($dir_explode[$i]))
            $create_folder .= $dir_explode[$i].DIRECTORY_SEPARATOR;

        $path = realpath($create_folder);
        $is_exists = ($path !== FALSE && is_dir($path))? TRUE : FALSE;
        if($is_exists === FALSE) {
            mkdir($create_folder);
            chmod($create_folder, 0777);
        }
    }
}

function _DELETE_FILES($files_path)
{
    $files = glob($files_path);

    foreach ($files as $f) {
        if(is_file($f))
            unlink($f);
    }
}

function _DELETE_DIR($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!_DELETE_DIR($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
/**
 * Move Temporary files into real folder
 * @param String $temp_path - Temporary path
 * @param Enum $type - Document type to be moved (file|folder)
 * @return String - return new path if success, and return empty string when fail
 */
function MOVE_TEMP_TO_REAL($temp_path, $type = 'file')
{
    $explode_path = explode(DIRECTORY_SEPARATOR, $temp_path);
    $temp_folder_index = array_search(FOLDER_UPLOAD_TEMP, $explode_path);

    // Remove index before temp folder
    for ($i=0; $i < $temp_folder_index ; $i++) { 
        unset($explode_path[$i]);
    }

    // Set temp path without base url
    $temp_path = join(DIRECTORY_SEPARATOR, $explode_path);
    
    // set new path, remove _temp
    $new_path = preg_replace("/_temp/im", '', $temp_path);
    $explode_new_path = explode(DIRECTORY_SEPARATOR, $new_path);
    unset($explode_new_path[count($explode_new_path)-1]);
    
    // Reconstruct array index
    $explode_path = array_values($explode_path);
    unset($explode_path[count($explode_path)-1]);

    $source = join(DIRECTORY_SEPARATOR, $explode_path);
    $destination = join(DIRECTORY_SEPARATOR, $explode_new_path);
    _CREATE_DIR($destination); // Create destination folder if not exists

    if($type == 'folder') {
        // Check if dir is exists
        if(is_dir($source)) {
            // Delete Files in destination
            _DELETE_DIR(sprintf('%s', $destination));
            rename($source, $destination);
            return sprintf('%s%s/', base_url(), $destination);
        } else {
            return '';
        }
    } else {
        // Check if temp path is exists
        if(is_file($temp_path)) {
            // Delete Files in new path
            _DELETE_FILES(sprintf('%s/*.*', $destination));
            // Move files to new path
            rename($temp_path, $new_path);
            return base_url().$new_path;
        } else {
            return '';
        }

    }
}
 /* Language Loader
 * to decide which language this Project should use, default is en
 *
 * @param string $language_file, Language file to load, just put filename without _lang.php. 
 *      Ex: api_lang.php, just put 'api' as $language_file
 * @param string $idiom Two Character of language encoding. see function AVAILABLE_LANGUAGE()
 */
function _LANG_LOADER($language_file, $idiom = 'en')
{
    $CI = &get_instance();

    $available_lang = AVAILABLE_LANGUAGE();

    if(!array_key_exists($idiom, $available_lang)) {
        $idiom = 'en';
    }

    $CI->lang->load($language_file, $available_lang[$idiom]);
}

/**
 * (Void) Load Navigation (Top and Side), including set title bar
 * @param string $titlebar Value for Title Bar
 * @param string $headertitle Value for Header Title
 * @param string $topnav Navigation prefix (default: 'default')
 * @param string $sidenav Side Navbar prefix (default: 'default')
 */
function LOAD_NAVBAR($titlebar = '', $headertitle = '', $topnav = 'default', $sidenav = '') {
    $CI = & get_instance();
    $header = '';
    $topnavs = $topnav.'_topnavs';
    if(empty($sidenavs))
        $sidenavs = $topnav.'_sidenavs';
    else
        $sidenavs = $sidenav.'_sidenavs';

    if(empty($titlebar)) {
        $titlebar = lang('appname');
    } else {
        $header = $titlebar;
        $titlebar = $titlebar.' | '.lang('appname');
    }

    if(!empty($headertitle))
        $header = $headertitle;

    $CI->template->write('title', $titlebar, TRUE);
    if(!empty($header))
        $CI->template->write('header', $header, TRUE);

    $CI->template->write_view('navs', 'template/'.$topnavs, TRUE);

    if($sidenav !== FALSE)
        $CI->template->write_view('sidenavs', 'template/'.$sidenavs, TRUE);
}

function UPDATE_iFLAG( $flag )
{
    $CI =& get_instance();
    if( $flag )
        return lang("msg_success_saved");
    else
        return lang('msg_failed_saved').' '.$CI->db->_error_message();
}

function INSERT_iFLAG( $flag )
{
    $CI =& get_instance();
    if( $flag )
        return lang("msg_success_saved");
    else
        return lang('msg_failed_saved').' '.$CI->db->_error_message();
}

function DELETE_iFLAG ( $flag )
{
    $CI =& get_instance();
    if( $flag )
        return lang('msg_success_delete');
    else
        return lang('msg_failed_delete').' '.$CI->db->_error_message();
}

function encrypt( $q )
{
    $cryptKey = CRYPT_KEY;
    $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decrypt( $q )
{
    $cryptKey = CRYPT_KEY;
    $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function requestFromAjax() {
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

/**
 * Dropwdown for Allowed / Not Allowed
 *
 * @param integer $index (default: null) Index of dropdown data
 * @param boolean $with_style (default: false) Wheter using text style or not
 *
 * @return string/array Will return string if index is settled
 */
function DD_ALLOW($index = null, $with_style = false)
{
    $data_without_style = array(
        0 => lang("NotAllow"),
        1 => lang('Allow')
    );

    $data_with_style = array(
        0 => sprintf('<span class="red">%s</span>', lang('NotAllow')),
        1 => sprintf('<span class="green">%s</span>', lang('Allow'))
    );

    if($with_style)
        $data = $data_with_style;
    else
        $data = $data_without_style;

    if(!is_null($index))
        return $data[$index];
    else
        return $data;
}

function DD_STATUS($index = null, $with_style = false)
{
    $data_without_style = array(
        0 => lang('NoStock'),
        1 => lang('LimitedStock'),
        2 => lang('AlwaysAvailable')
    );

    $data = $data_without_style;
    if(!is_null($index))
        return $data[$index];
    else
        return $data;
}

function DD_ITEM_CONDITION($index = null, $with_style = false)
{
    $data_without_style = array(
        1 => lang('NewItem'),
        2 => lang('SecondItem')
    );

    $data = $data_without_style;
    if(!is_null($index))
        return $data[$index];
    else
        return $data;
}

function DD_STATUS_USER($index = null, $with_style = false)
{
    $data_without_style = array(
        0 => lang('Inactive'),
        1 => lang('Active')
    );

    $data = $data_without_style;
    if(!is_null($index))
        return $data[$index];
    else
        return $data;
}
/**
 * Date Calculation
 *
 * @param string $operators Operators of date used by php,
 *      ex: "+1 day" or "-2 months" or "+20 hours" or etc.
 * @param string $date (optional) String of date to be calculated
 * @param boolean $withTime (optional) include time in output
 * @param boolean $toDB (optinal) If $toDB is true, then the function will formatting date with Y-m-d format
 *
 * @return string Result of date calculation
 */
function dateCalc($operators, $date = 'now', $withTime = false, $toDB = false) {
    if($withTime === true) {
        if($toDB === true)
            $newDate = date('Y-m-d H:i:s', strtotime($date.' '.$operators));
        else
            $newDate = date('d-m-Y H:i:s', strtotime($date.' '.$operators));
    } else {
        if($toDB === true)
            $newDate = date('Y-m-d', strtotime($date.' '.$operators));
        else
            $newDate = date('d-m-Y', strtotime($date.' '.$operators));
    }

    return $newDate;
}

/**
 * Date Formatter
 *
 * @param string $strdate (optional) String of date will be formatted
 * @param string $dateformat (optional) Format of output date
 *
 * @return string Formatted date
 */
function DATE_FORMAT_( $strdate = null, $dateformat = DEFAULT_DATE_FORMAT )
{
    if(empty($strdate))
        $strdate = 'now';
    else if($strdate == 'first')
        $strdate = 'first day of this month';
    else if($strdate == 'last')
        $strdate = 'last day of this month';

    $strdate = date($dateformat, strtotime($strdate));
    if(date('Y', strtotime($strdate)) < MIN_YEAR)
        return null;
    else
        return $strdate;
}

/**
 * Date Formatter into DB
 *
 * @param string $strdate (optional) String of date will be formatted
 * @param string $dateformat (optional) Format of output date
 *
 * @return string Formatted date
 */
function FORMAT_DATE_( $strdate = null, $dateformat = DEFAULT_DB_DATE_FORMAT )
{
    return DATE_FORMAT_($strdate, $dateformat);
}

/**
 * Compare date
 *
 * @param string $biggerDate - Date we expect to be greater than $smallerDate
 * @param string $smallerDate - Date we expect to be weaker than $biggerDate
 *
 * @return boolean - True if $biggerDate is greater and False in otherwise
 */
function COMPARE_DATE($biggerDate, $smallerDate)
{
    $biggerDate = new DateTime(date('Y-m-d H:i:s', strtotime($biggerDate)));
    $smallerDate = new DateTime(date('Y-m-d H:i:s', strtotime($smallerDate)));

    if($biggerDate >= $smallerDate)
        return true;
    else
        return false;
}