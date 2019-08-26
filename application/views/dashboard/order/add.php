<form id="parsley-form" class="form-horizontal" novalidate name="form_add">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('product') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('product_id', $product, null, 'class="form-control product"') ?>    
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('store') ?> <span class="required">*</span></label>
        <?php echo form_dropdown('store_id', $store, null, 'class="form-control store"') ?>    
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('total') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="total" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('date') ?> <span class="required">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <input type="text" class="form-control datepicker" name="date" readonly>
        </div>
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
        var link = "<?php echo base_url('order/create') ?>",
            form_selector = "form[name='form_add']";

        submitForm(null, form_selector, link);
        return false;
    });

    $(".date").datetimepicker({
        format: "dd-mm-yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        minuteStep: 5
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