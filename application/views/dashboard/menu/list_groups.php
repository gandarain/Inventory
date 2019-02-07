<table class="datatable table" id="mytable">
    <thead>
        <tr>
            <th width="40px">#</th>
            <th><?php echo lang('user') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_create') ?></th>  
            <th class="text-center no-order"><?php echo lang('crud_read') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_update') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_delete') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_report') ?></th>          
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$records as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <?php $checked = !empty($r->create_) ? 'checked': '' ?>
            <td class="text-center"><input type="checkbox" class="flat" name="create_" value="<?php echo $r->id_acl ?>" <?php echo $checked ?>></td>
            <?php $checked = !empty($r->read_) ? 'checked': '' ?> 
            <td class="text-center"><input type="checkbox" class="flat" name="read_" value="<?php echo $r->id_acl ?>" <?php echo $checked ?>></td>
            <?php $checked = !empty($r->update_) ? 'checked': '' ?> 
            <td class="text-center"><input type="checkbox" class="flat" name="update_" value="<?php echo $r->id_acl ?>" <?php echo $checked ?>></td>
            <?php $checked = !empty($r->delete_) ? 'checked': '' ?> 
            <td class="text-center"><input type="checkbox" class="flat" name="delete_" value="<?php echo $r->id_acl ?>" <?php echo $checked ?>></td>
            <?php $checked = !empty($r->report_) ? 'checked': '' ?>
            <td class="text-center"><input type="checkbox" class="flat" name="report_" value="<?php echo $r->id_acl ?>" <?php echo $checked ?>></td>            
        <?php endforeach ?>
    </tbody>
</table>

<script>
    init_iCheck();
    let mytable = $("#mytable").DataTable({
        columnDefs: [
            { targets: 'no-order', orderable: false }
        ]
    });

   $('#mytable :checkbox').change(function () {
       let akses = 0;
        if ($(this).is(':checked')) {
            akses = 1;
        } else {
            akses = 0;
        }

        let data={};
        data[$(this).attr('name')]= akses;

        let target = '<?php echo base_url('menu/update_acl') ?>/' + $(this).val();
        let response = sendAjax(target, data);
    });
</script>