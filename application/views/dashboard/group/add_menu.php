<form id="parsley-form3" class="form-horizontal form-label-left" novalidate name="form_add_menu">
    <table class="table" id="table2">
        <thead>
            <tr>
                <th class="no-order" width="40px">#</th>
                <th><?php echo lang('menu') ?></th>
                <th><?php echo lang('description') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($records as $r): ?>
            <tr>
                <td>
                    <label>
                        <input type="checkbox" class="flat" name="menu[]" value="<?php echo $r->id ?>">
                    </label>
                </td>
                <td><?php echo $r->name ?></td>
                <td><?php echo $r->description ?></td>
            </tr>
        <?php endforeach ?>
     </tbody>
    </table>

    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success pull-right" onClick><i class="fas fa-save"></i> <?php echo lang('btn_update') ?></button>
        </div>
    </div>
</form>

<script>
    init_iCheck();
    $('#table2').DataTable();

    $("#parsley-form3").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('group/create_menu/'.$group_id) ?>",
            form_selector = "form[name='form_add_menu']";

        submitForm(null, form_selector, link, null, false);
        return false;
    });

</script>