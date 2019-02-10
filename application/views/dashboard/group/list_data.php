<table class="datatable table">
    <thead>
        <tr>
            <th class="no-order" width="40px">#</th>
            <th><?php echo lang('groups') ?></th>
            <th><?php echo lang('description') ?></th>
            <th><?php echo lang('special_privilege') ?></th>
            <th class="text-center no-order" width="250px"><?php echo lang('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$records as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <td><?php echo $r->description ?></td>
            <td><?php echo DD_ALLOW($r->special_privilege, true) ?></td>
            <td width="150px" class="text-center">
                <div class="btn-group">
                    <button class="btn btn-sm btn-success action_edit" value="<?php echo $r->id ?>"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger action_delete" value="<?php echo $r->id ?>"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-sm btn-success add_users" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('add_user_for'), $r->name) ?>"><i class="fas fa-user-plus"></i></button>
                    <button class="btn btn-sm btn-warning show_user" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('user_list_of'), $r->name) ?>"><i class="fas fa-user-shield"></i></button>
                    <button class="btn btn-sm btn-success add_menu" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('add_menu_for'), $r->name) ?>">
                        <i class="fas fa-list-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-warning show_menu" value="<?php echo $r->id ?>" title="<?php echo sprintf(lang('menu_access_for'), $r->name) ?>"><i class="fas fa-bars"></i></button>
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
        let target = '<?php echo base_url('group/update') ?>/' + $(this).val();
        let form_edit = sendAjax(target);

        $(".form-action-panel .x_panel .x_content").html(form_edit);
    });

    // Delete Button
    $(".datatable").on('click','.action_delete', function(e) {
        if(confirm('<?php echo lang('dialog_delete') ?>')) {
            let target = '<?php echo base_url('group/delete') ?>/' + $(this).val();
            let response = sendAjax(target, null, '', true);
        } else {
            return false;
        }
    });

    $(".datatable").on('click','.show_user', function() {
        let target = '<?php echo base_url('group/show_user') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });

    $(".datatable").on('click','.add_users', function() {
        let target = '<?php echo base_url('group/create_user') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });

    $(".datatable").on('click','.show_menu', function() {
        let target = '<?php echo base_url('group/show_menu') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });

    $(".datatable").on('click','.add_menu', function() {
        let target = '<?php echo base_url('group/create_menu') ?>/' + $(this).val();
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: this.title
        }

        showModal(modalProps);
    });</script>