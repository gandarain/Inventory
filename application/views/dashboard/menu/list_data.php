<table class="datatable table">
    <thead>
        <tr>
            <th class="no-order" width="40px">#</th>
            <th><?php echo lang('name') ?></th>
            <th><?php echo lang('class_name') ?></th>
            <th><?php echo lang('method_name') ?></th>
            <th><?php echo lang('description') ?></th>
            <th class="text-center no-order" width="100px"><?php echo lang('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$records as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <td><?php echo $r->class_name ?></td>
            <td><?php echo $r->method_name ?></td>
            <td><?php echo $r->description ?></td>
            <td width="150px" class="text-center">
                <div class="btn-group">
                    <button class="btn btn-sm btn-success action_edit" value="<?php echo $r->id ?>"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger action_delete" value="<?php echo $r->id ?>"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-sm btn-warning add_group" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('add_group'), $r->name) ?>"><i class="fas fa-users"></i></button>
                    <button class="btn btn-sm btn-primary show_groups" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('group_access_for_menu'), $r->name) ?>"><i class="fas fa-user-lock"></i></button>
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
        let target = '<?php echo base_url('menu/update') ?>/' + $(this).val();
        let form_edit = sendAjax(target);

        $(".form-action-panel .x_panel .x_content").html(form_edit);
    });

    $(".datatable").on('click','.show_groups', function() {
        let target = '<?php echo base_url('menu/show_groups') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });

    $(".datatable").on('click','.add_group', function() {
        let target = '<?php echo base_url('menu/add_group') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });

    // Delete Button
    $(".datatable").on('click','.action_delete', function(e) {
        if(confirm('<?php echo lang('dialog_delete') ?>')) {
            let target = '<?php echo base_url('menu/delete') ?>/' + $(this).val();
            let response = sendAjax(target, null, '', true);
        } else {
            return false;
        }
    });
</script>