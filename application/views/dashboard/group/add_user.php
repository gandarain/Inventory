<form id="parsley-form2" novalidate name="form_add_user">
    <div class="form-message"></div>
    <table class="table" id="table2">
        <thead>
            <tr>
                <th class="no-order" width="40px">#</th>
                <th><?php echo lang('user') ?></th>
                <th><?php echo lang('username') ?></th>
                <th><?php echo lang('email') ?></th>
                <th><?php echo lang('phone') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (@$records as $ir => $r): ?>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" class="flat" name="users[]" value="<?php echo $r->id ?>">
                        </label>
                    </td>
                    <td><?php echo $r->name ?></td>
                    <td><?php echo $r->username ?></td>
                    <td><?php echo $r->email ?></td>
                    <td><?php echo $r->phone ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <button type="submit" class="btn btn-success pull-right close_modal"><i class="fas fa-save"></i> <?php echo lang('btn_update') ?></button>
</form>

<script>
    init_iCheck();
    $('#table2').DataTable();

    $("#parsley-form2").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('group/create_user/'.$records_group->id) ?>",
            form_selector = "form[name='form_add_user']";

        submitForm(null, form_selector, link, '.form-message', false);
        return false;
    });

</script>