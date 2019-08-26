<div class="row">
    <div class="col-md-12 col-sm-6 col-xs-12 form-search-panel">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo lang('percentage') ?><small><?php echo lang('order') ?></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php foreach (@$records as $ir => $r): ?>
                    <?php if($r->total): ?>
                    <div class="widget_summary">
                        <div class="w_left w_25">
                            <span><?php echo $r->name ?></span>
                        </div>
                        <div class="w_center w_55">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal=<?php echo $r->total ?>></div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span><?php echo $r->total."%" ?></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
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

    // Load Form Add
    let form_add = sendAjax('<?php echo base_url('store/create') ?>');
    $(".form-action-panel .x_panel .x_content").html(form_add);

    // Trigger heightChange
    $(".form-action-panel").trigger('heightChange');

    // Search Button
    $("form[name='search']").on('submit', function(e) {
        e.preventDefault();
        let uri = '<?php echo base_url('store/index') ?>';
        let data = $("form[name='search']").serialize() + "&submit=1";
        let response = sendAjax(uri, data);

        $(".table-data-panel .x_panel .x_content").html(response);
    });
});
</script>