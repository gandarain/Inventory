<form id="parsley-form" class="form-horizontal" novalidate name="form_edit">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('name') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="name" required="required" value="<?php echo $record->name ?>">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('category') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('category_id', $category, $record->category_id, 'class="form-control"') ?>    
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('total') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="total" required="required" value="<?php echo $record->total ?>">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('category') ?> <span class="required">*</span></label>
        <?php
            $AT = array();
            foreach ($assigned_to as $assigned) {
                $AT[$assigned->division_id] = $assigned->division_id;
            };
        ?>
        <?php echo form_multiselect('store_id[]', $store, $AT, 'class="form-control" id="store" required') ?>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('price') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="price" required="required" value="<?php echo $record->price ?>">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('description') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="description" required="required" value="<?php echo $record->description ?>">
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
        var link = "<?php echo base_url('product/update/'.$record->id) ?>",
            form_selector = "form[name='form_edit']";

        submitForm(null, form_selector, link);
        return false;
    });

    $(".cancel").on('click', function() {
        if(confirm('<?php echo lang('dialog_abandon_changes') ?>')) {
            // Load Form Add
            let form_add = sendAjax('<?php echo base_url('product/create') ?>');
            $(".form-action-panel .x_panel .x_content").html(form_add);
        } else {
            return false;
        }
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