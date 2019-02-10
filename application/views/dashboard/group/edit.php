<form id="parsley-form" class="form-horizontal" novalidate name="form_edit">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('groups') ?> <span class="required">*</span></label>
        <input type="text" class="form-control" name="name" required="required" value="<?php echo $record->name ?>">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <label class="control-label"><?php echo lang('special_privilege') ?> <span class="required">*</span></label>:
        <div class="radio">
            <?php foreach (DD_ALLOW() as $key => $value): ?>
            <label>
                <input type="radio" class="flat" name="special_privilege" value="<?php echo $key ?>" <?php echo $key == $record->special_privilege ? 'checked' : ''; ?>> <?php echo $value ?>
            </label>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label"><?php echo lang('description') ?></label>
        <textarea name="description" rows="2" class="form-control"><?php echo $record->description ?></textarea>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo lang('btn_update') ?></button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        // Add this to re-styling radio button with input flat
        if ($("input.flat")[0]) {
            $(document).ready(function () {
                $('input.flat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
        }
    });

    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('group/update/'.$record->id) ?>",
            form_selector = "form[name='form_edit']";

        submitForm(null, form_selector, link);
        return false;
    });

</script>