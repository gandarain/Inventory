<form name="form_action" class="form-inline">
    <table class="datatable table mytable">
        <thead>
            <tr>
                <th class="no-order" width="40px">#</th>
                <th><?php echo lang('user') ?></th>
                <th><?php echo lang('username') ?></th>
                <th><?php echo lang('email') ?></th>
                <th><?php echo lang('phone') ?></th>
                <th class="text-center no-order" width="100px"><?php echo lang('action') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($record as $row => $r): ?>
            <tr>
                <td><?php echo $row+1 ?></td>
                <td><?php echo $r->name ?></td>
                <td><?php echo $r->username ?></td>
                <td><?php echo $r->email ?></td>
                <td><?php echo $r->phone ?></td>
                <td class="text-center">
                    <input type="checkbox" class="flat" name="users_group[]" value="<?php echo $r->ug_id ?>">
                </td>
            </tr>
       <?php endforeach ?>
        </tbody>
    </table>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <input type="hidden" name="group_id" value="<?php echo $group_id ?>">
    <div class="col-sm-6 col-xs-12">
        <div class="row">
            <div class="form-group">
                <label class="control-label"><?php echo lang('do_something') ?></label>
                <?php
                    $actions = array(
                        '' => lang('with_selected'),
                        'delete' => lang('crud_delete')
                    );
                    echo form_dropdown('action', $actions, null, 'class="form-control" width="150px"');
                ?>
            </div>
        </div> 
    </div>
</form>
<script>
    init_iCheck();
    $(".mytable").DataTable();

    // do actions changed
    $("select[name='action']").on('change', function() {
        if(!this.value)
            return false;

        let confirm_messages = '';
        let uri_target = '';
        let form_data = $("form[name='form_action']").serialize();

        if(this.value == 'delete') {
            confirm_messages = '<?php echo lang("dialog_delete") ?>';
            uri_target = '<?php echo base_url('group/delete_user') ?>';
        }

        if(confirm(confirm_messages)) {
            let response = sendAjax(uri_target, form_data);

            if(response.status == _SUCCESS) {
                // Hide modal when action is success
                let current_modal = $(this).closest('.modal').attr('id');
                $(`#${current_modal}`).modal('hide');
            }            
        }
        
        $(this).val(''); // Reset Action dropdown
    });
</script>