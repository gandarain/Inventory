<div class="form-horizontal form-label-left" novalidate name="form_increase">
    <div class="update_message"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('date') ?></h5>
                <p class="card-text"><?php echo $record->date ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('name') ?></h5>
                <p class="card-text"><?php echo $record->p_name ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('category') ?></h5>
                <p class="card-text"><?php echo $record->c_name ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('store') ?></h5>
                <p class="card-text"><?php echo $record->s_name ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('price') ?></h5>
                <p class="card-text"><?php echo $record->price ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('total') ?></h5>
                <p class="card-text"><?php echo $record->total ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo lang('total_price') ?></h5>
                <p class="card-text"><?php echo $record->total * $record->price ?></p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="button" class="btn btn-danger cancel" data-dismiss="modal" data-loading-text="<?php echo lang('btn_close') ?>"><i class="fas fa-times"></i> <?php echo lang('btn_close') ?></button>
        </div>
    </div>
</div>