<table class="datatable table">
    <thead>
        <tr>
            <th class="no-order" width="40px">#</th>
            <th><?php echo lang('name') ?></th>
            <th><?php echo lang('description') ?></th>
            <th class="text-center no-order" width="100px"><?php echo lang('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$records as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <td><?php echo $r->description ?></td>
            <td width="150px" class="text-center">
                <div class="btn-group">
                    <button class="btn btn-sm btn-success action_edit" value="<?php echo $r->id ?>"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger action_delete" value="<?php echo $r->id ?>"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    // Apply Datatable plugin into .datatable
    let myTable = $(".datatable").DataTable({
        dom: 'Brtip',
        columnDefs: [
            { targets: 'no-order', orderable: false }
        ],
        buttons: dtTablesButtons()
    });

    // Remove Previous Buttons
    $(".tableTools-container").html('');
    // Append Datatables buttons into tableTools-container
    myTable.buttons().container().appendTo( $('.tableTools-container') );

    // Edit Button
    $(".datatable").on('click', '.action_edit', function() {
        let target = '<?php echo base_url('category/update') ?>/' + $(this).val();
        let form_edit = sendAjax(target);

        $(".form-action-panel .x_panel .x_content").html(form_edit);
    });

    // Delete Button
    $(".datatable").on('click','.action_delete', function(e) {
        if(confirm('<?php echo lang('dialog_delete') ?>')) {
            let target = '<?php echo base_url('category/delete') ?>/' + $(this).val();
            let response = sendAjax(target, null, '', true);
        } else {
            return false;
        }
    });
</script>