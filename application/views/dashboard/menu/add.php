<form id="parsley-form" class="form-horizontal" novalidate name="form_add">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('menu') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="name" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('class_name') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="class_name" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('method_name') ?></label>
        <input type="text" class="form-control" name="method_name">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('description') ?></label>
        <textarea class="form-control" name="description" rows="2"></textarea>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo lang('btn_save') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('menu/create') ?>",
            form_selector = "form[name='form_add']";

        submitForm(null, form_selector, link);
        return false;
    });
</script>