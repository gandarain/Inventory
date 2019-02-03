<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <section class="login_content">
                <form id="parsley-form" name="login_form" novalidate>
                    <h1><?php echo lang('login_form') ?></h1>
                    <div class="login_message"></div>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="<?php echo lang('username') ?>"  />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password') ?>" required="" />
                    </div>
                    <div>
                        <button class="btn btn-default"><?php echo lang('login') ?></button>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <div>
                            <h1><i class="fa fa-paw"></i> <?php echo lang('appname') ?></h1>
                            <p><?php echo lang('appdev').' '.lang('appname') ?></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script src="<?php echo base_url('vendors/parsleyjs/dist/parsley.min.js') ?>"></script> 
<script>
$("#parsley-form").parsley().on('field:validated', function(){}).on('form:submit', function(){
    console.log("TESTING");
    var link = "<?php echo base_url('app/login') ?>",
    form_selector = "form[name='login_form']";

    submitForm(null, form_selector, link);
    return false;
});
</script>