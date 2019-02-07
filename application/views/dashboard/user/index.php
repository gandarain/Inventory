<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 form-search-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('search') ?><small><?php echo lang('user') ?></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form name="search" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('name') ?></label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-xs-12" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('email') ?></label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-xs-12" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('phone') ?></label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="number" class="form-control col-xs-12" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('user_type') ?></label>
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_dropdown('utype', $utype, null, 'class="form-control"') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><?php echo lang('status') ?></label>
                        <div class="col-sm-6 col-xs-12">
                            <?php 
                                $status[''] = lang('greetings_select');
                                echo form_dropdown('status', $status, null, 'class="form-control"'); 
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> <?php echo lang('search') ?></button>
                            <button type="button" class="btn btn-success action_add"><i class="fas fa-plus"></i> <?php echo lang('btn_add') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 form-action-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('info') ?><small><?php echo lang('user') ?></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"></div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 table-data-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('list') ?><small><?php echo lang('user') ?></small></h2>
                <div class="pull-right tableTools-container"></div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"></div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('vendors/parsleyjs/dist/parsley.min.js') ?>"></script> 
<script>
$(document).ready(function() {    
    // Load Form Add
    let form_info = sendAjax('<?php echo base_url('user/info_for_admin') ?>');
    $(".form-action-panel .x_panel .x_content").html(form_info);

    // Search Button
    $("form[name='search']").on('submit', function(e) {
        e.preventDefault();
        let uri = '<?php echo base_url('user/index') ?>';
        let data = $("form[name='search']").serialize() + "&submit=1";
        let response = sendAjax(uri, data);

        $(".table-data-panel .x_panel .x_content").html(response);
    });

    $(".action_add").on('click', function() {
        let target = '<?php echo base_url('user/create') ?>';
        let modalProps = {
            id: 'main-modal',
            body: target,
            title: '<?php echo lang('add').' '.lang('user') ?>',
        }

        showModal(modalProps);
    });
});
</script>