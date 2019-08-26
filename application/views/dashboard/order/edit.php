<form id="parsley-form" class="form-horizontal" novalidate name="form_edit">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('product') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('product_id', $product, $record->product_id, 'class="form-control product"') ?>    
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('store') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('store_id', $store, $record->store_id, 'class="form-control store"') ?>    
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo lang('btn_save') ?></button>
            <button type="button" class="btn btn-danger cancel"><i class="fas fa-undo"></i> <?php echo lang('btn_cancel') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('order/update/'.$record->id) ?>",
            form_selector = "form[name='form_edit']";

        submitForm(null, form_selector, link);
        return false;
    });

    $(".cancel").on('click', function() {
        if(confirm('<?php echo lang('dialog_abandon_changes') ?>')) {
            // Load Form Add
            let form_add = sendAjax('<?php echo base_url('order/create') ?>');
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

    $(".product").change(function(){
        var link = "<?php echo base_url('order/update_dropdown_store/') ?>" + $(this).val();
        let respon = sendAjax(link, null, '', false);
        console.log(respon);
        let my_select = $(".store");
        my_select.empty();

        $.each(respon.message, function(id, value){
            my_select.append(
                $('<option></option>')
                .attr("value", value.store_id)
                .text(value.name)
            )
        });
    })
</script>