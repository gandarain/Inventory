<form id="parsley-form1" class="form-horizontal form-label-left" novalidate name="form_decrease">
    <div class="update_message"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('total') ?> <span class="required">*</span></label>
        <input type="number" class="form-control" name="total" required="required">
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-success save"><i class="fas fa-save"></i> <?php echo lang('btn_save') ?></button>
            <button type="button" class="btn btn-danger cancel" data-dismiss="modal" data-loading-text="<?php echo lang('btn_cancel2') ?>"><i class="fas fa-times"></i> <?php echo lang('btn_cancel2') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form1").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('product/decrease_product/'.$record->id) ?>",
            form_selector = "form[name='form_decrease']";

        submitForm(null, form_selector, link, '.update_message', true);
        // submitForm(null, form_selector, link, '.update_message', false);
        return false;
    });

    // $('.save').click(function(e) {
    //     // alert("hello")
    //     e.preventDefault();
    //     var link = "<?php //echo base_url('product/increase_product/'.$record->id) ?>",
    //     form_selector = "form[name='form_increase']";
    //     submitForm(null, form_selector, link, false);
    // })
</script>