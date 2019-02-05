<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="form_login" name="form_login" novalidate>
                    <h1><?php echo lang('form_login') ?></h1>
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="<?php echo lang('username') ?>" required="required" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="<?php echo lang('password') ?>" required="required" />
                    </div>
                    <div>
                        <button class="btn btn-default" onclick="submitForm(event, '#form_login', '<?php echo base_url('app/login') ?>')"><?php echo lang('login') ?></button>
                        <a class="reset_pass" href="#"><?php echo lang('forgot_password') ?></a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link"><?php echo lang('dialog_signup') ?>
                            <a href="#signup" class="to_register"> <?php echo lang('create_account') ?> </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />
    
                        <div>
                            <h1><i class="fa fa-paw"></i> <?php echo lang('appname') ?></h1>
                            <p><?php echo lang('appdev').' '.lang('appname') ?></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form name="form_register" id="form_register" novalidate>
                    <h1><?php echo lang('create_account') ?></h1>
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="<?php echo lang('username') ?>" required="required" />
                    </div>
                    <div>
                        <input type="text" class="form-control" name="name" placeholder="<?php echo lang('name') ?>" required="required" />
                    </div>
                    <div>
                        <input type="email" class="form-control" name="email" placeholder="<?php echo lang('email') ?>" required="required" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="<?php echo lang('password') ?>" required="required" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password2" placeholder="Retype <?php echo lang('password') ?>" required="required" />
                    </div>
                    <div>
                        <input type="text" class="form-control" name="phone" placeholder="<?php echo lang('phone') ?>" required="required" />
                    </div>
                    <div>
                        <input type="text" class="form-control birth-picker" name="birth" value="" placeholder="<?php echo lang('birth') ?>" required="required" />
                    </div>
                    <div>
                        <textarea class="form-control" name="address" rows="3" placeholder="<?php echo lang('address') ?>"></textarea>
                    </div>

                    <div class="clearfix">&nbsp;</div>
                    <div>
                        <button class="btn btn-default" onclick="submitForm($(this), 'form_register', '<?php echo base_url('app/register') ?>')"><?php echo lang('btn_submit') ?></button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link"><?php echo lang('dialog_login') ?>
                            <a href="#signin" class="to_register"> <?php echo lang('login') ?> </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

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
    $("#form_register").parsley().on('field:validated', function(){}).on('form:submit', function() {
        let link = '<?php echo base_url('app/register') ?>',
            form_selector = '#form_register';

        submitForm(null, form_selector, link);
        return false;
    });
</script>
