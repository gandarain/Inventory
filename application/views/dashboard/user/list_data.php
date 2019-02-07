<table class="datatable table" >
    <thead>
        <tr>
            <th class="no-order" width="40px">#</th>
            <th><?php echo lang('name') ?></th>
            <th><?php echo lang('phone') ?></th>
            <th><?php echo lang('email') ?></th>
            <th><?php echo lang('user_type') ?></th>
            <th><?php echo lang('date_regist') ?></th>
            <th><?php echo lang('status') ?></th>
            <th class="text-center no-order" width="250px"><?php echo lang('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$records as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <td><?php echo $r->phone ?></td>
            <td><?php echo $r->email ?></td>
            <td><?php echo $r->utype_name ?></td>
            <td><?php echo DATE_FORMAT_($r->registration_date, DEFAULT_DATETIME_FORMAT) ?></td>
            <td><?php echo DD_STATUS_USER($r->status, true) ?></td>
            <td class="text-center">
                <div class="btn-group">
                    <button class="btn btn-sm btn-success action_edit" value="<?php echo $r->id ?>">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger action_delete" value="<?php echo $r->id ?>"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-sm btn-primary action_group" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('user_group_for'), $r->name) ?>"><i class="fas fa-users"></i></button>
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
    $(".datatable").on("click",".action_edit", function(e) {
        let target = '<?php echo base_url('user/update') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: '<?php echo lang('edit').' '.lang('user') ?>',
            // buttons: [
            //     `<button type="button" class="btn btn-default close_modal"><?php echo lang('button_close') ?></button>`,
            //     `<button type="button" class="btn btn-cring" onclick=""><?php echo lang('btn_update') ?></button>`
            // ]
        }

        showModal(modalProps);
    });

    // Delete Button
    $(".datatable").on("click",".action_delete", function(e) {
        if(confirm('<?php echo lang('dialog_delete') ?>')) {
            let target = '<?php echo base_url('user/delete') ?>/' + $(this).val();
            let response = sendAjax(target, null, '', true);
        } else {
            return false;
        }
    });

    // Group List button
    $(".datatable").on('click','.action_group', function() {
        let target = '<?php echo base_url('user/show_groups') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });
</script>