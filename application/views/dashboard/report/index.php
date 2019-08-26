<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 form-search-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('search') ?><small><?php echo lang('order') ?></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form name="search" class="form-horizontal">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label"><?php echo lang('product') ?></label>
                        <?php echo form_dropdown('product_id', $product, null, 'class="form-control product"') ?>    
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label"><?php echo lang('store') ?></label>
                        <?php echo form_dropdown('store_id', $store, null, 'class="form-control store"') ?>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label"><?php echo lang('from') ?><span class="required">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input type="text" class="form-control datepicker" name="from" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label class="control-label"><?php echo lang('to') ?><span class="required">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input type="text" class="form-control datepicker" name="to" readonly>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> <?php echo lang('search') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 table-data-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('list') ?><small><?php echo lang('order') ?></small></h2>
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
    // Height Change Handler
    $(".form-action-panel").bind('heightChange', function() {
        // View Manipulation
        let form_action_height = $(".form-action-panel .x_panel").outerHeight();
        let form_search_height = $(".form-search-panel .x_panel").outerHeight();

        if(form_search_height < form_action_height)
            $(".form-search-panel .x_panel").css('height', form_action_height);
    });

    // Trigger heightChange
    $(".form-action-panel").trigger('heightChange');

    // Search Button
    $("form[name='search']").on('submit', function(e) {
        e.preventDefault();
        let uri = '<?php echo base_url('report/index') ?>';
        let data = $("form[name='search']").serialize() + "&submit=1";
        let response = sendAjax(uri, data);

        $(".table-data-panel .x_panel .x_content").html(response);
    });

    $(".date").datetimepicker({
        format: "dd-mm-yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        minuteStep: 5
    });
});
</script>