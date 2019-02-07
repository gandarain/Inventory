<form id="parsley-form" class="form-horizontal form-label-left" novalidate name="form_add">
    <div class="update_message"></div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('name') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="name" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('username') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="username" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('email') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="email" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('password') ?></label>
        <div class="col-sm-6 col-xs-12">
            <div class="input-group">
                <input type="password" class="form-control password" name="password" id="password" required="required">
                <span class="input-group-btn">
                    <button type="button" onclick="showPassword($(this))" class="btn btn-default">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </span>
            </div>
        </div>
        
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('confirm_password') ?></label>
        <div class="col-sm-6 col-xs-12">
            <input type="password" class="form-control password" id="confirmPassword" data-parsley-equalto="#password" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('phone') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="phone" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('user_type') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <?php echo form_dropdown('utype', $utype, null, 'class="form-control" required="required"') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('status') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12 radio">
            <?php foreach (DD_STATUS_USER() as $key => $value): ?>
            <label>
                <input type="radio" class="flat" name="status" value="<?php echo $key ?>" <?php echo $key == _ACTIVE ? 'checked' : ''; ?>> <?php echo $value ?>
            </label>
            <?php endforeach ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('birth') ?> <span class="required">*</span></label>
        <div class="col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="birth" onfocus="openDatePicker($(this))">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> <?php echo lang('btn_save') ?></button>
        </div>
    </div>
</form>
<script>
    init_iCheck();
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('user/create') ?>",
            form_selector = "form[name='form_add']";

        submitForm(null, form_selector, link, '.update_message', false);
        return false;
    });

    $("#password").on('change', function() {
        if($(this).val())
            $("#confirmPassword").attr('required', 'required');
        else
            $("#confirmPassword").removeAttr('required');
    });

    function showPassword(btn) {
        let type = $("input.password").attr('type');

        if(type === 'password') {
            $("input.password").attr('type', 'text');
            btn.html('<i class="fas fa-eye"></i>');
        } else {
            $("input.password").attr('type', 'password');
            btn.html('<i class="fas fa-eye-slash"></i>');
        }
    }
</script>