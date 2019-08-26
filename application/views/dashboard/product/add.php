<form id="parsley-form" class="form-horizontal" novalidate name="form_add">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('name') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="name" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('category') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('category_id', $category, null, 'class="form-control"') ?>    
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('total') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="total" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('store') ?> <span class="required">*</span></label>
        <?php echo form_multiselect('store_id[]', $store, null, 'class="form-control" id="store" required') ?>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('price') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="price" required="required">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('description') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="description" required="required">
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
        var link = "<?php echo base_url('product/create') ?>",
            form_selector = "form[name='form_add']";

        submitForm(null, form_selector, link);
        return false;
    });

    $('#store').multiselect({
        maxHeight: '50vh',
        buttonWidth: '100%',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        selectAllJustVisible: false
    });
</script>