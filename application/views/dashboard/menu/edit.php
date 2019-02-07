<form id="parsley-form" class="form-horizontal" novalidate name="form_edit">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('menu') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="name" required="required" value="<?php echo $record->name ?>">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('class_name') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="class_name" required="required" value="<?php echo $record->class_name ?>">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('method_name') ?></label>
        <input type="text" class="form-control" name="method_name" value="<?php echo $record->method_name ?>">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('description') ?></label>
        <textarea class="form-control" name="description" rows="2"><?php echo $record->description ?></textarea>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> <?php echo lang('btn_update') ?></button>
            <button type="button" class="btn btn-danger cancel"><i class="fas fa-undo"></i> <?php echo lang('btn_cancel') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('menu/update/'.$record->id) ?>",
            form_selector = "form[name='form_edit']";

        submitForm(null, form_selector, link);
        return false;
    });

    $(".cancel").on('click', function() {
        if(confirm('<?php echo lang('dialog_abandon_changes') ?>')) {
            // Load Form Add
            let form_add = sendAjax('<?php echo base_url('menu/create') ?>');
            $(".form-action-panel .x_panel .x_content").html(form_add);
        } else {
            return false;
        }
    });
</script>