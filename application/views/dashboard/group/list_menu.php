<table class="datatable table" id="myTable">
    <thead>
        <tr>
            <th class="no-order" width="40px">#</th>
            <th><?php echo lang('menu') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_create') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_read') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_update') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_delete') ?></th>
            <th class="text-center no-order"><?php echo lang('crud_report') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (@$menus as $ir => $r): ?>
        <tr>
            <td><?php echo $ir+1 ?></td>
            <td><?php echo $r->name ?></td>
            <td class="text-center">
                <?php $checked = !empty($r->create_) ? 'checked': '' ?>
                <input type="checkbox" class="flat" name="create_" value="<?php echo $r->acl_id ?>" <?php echo $checked ?>>
            </td>
            <td class="text-center">
                <?php $checked = !empty($r->read_) ? 'checked': '' ?>
                <input type="checkbox" class="flat" name="read_" value="<?php echo $r->acl_id ?>" <?php echo $checked ?>>
            </td>
            <td class="text-center">
                <?php $checked = !empty($r->update_) ? 'checked': '' ?>
                <input type="checkbox" class="flat" name="update_" value="<?php echo $r->acl_id ?>" <?php echo $checked ?>>
            </td>
            <td class="text-center">
                <?php $checked = !empty($r->delete_) ? 'checked': '' ?>
                <input type="checkbox" class="flat" name="delete_" value="<?php echo $r->acl_id ?>" <?php echo $checked ?>>
            </td>
            <td class="text-center">
                <?php $checked = !empty($r->report_) ? 'checked': '' ?>
                <input type="checkbox" class="flat" name="report_" value="<?php echo $r->acl_id ?>" <?php echo $checked ?>>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    init_iCheck();
    let myTable = $("#myTable").DataTable({
        columnDefs: [
            { targets: 'no-order', orderable: false }
        ]
    });

    $( '#myTable :checkbox' ).change(function(){
        let akses = 0;

        if($(this).is(':checked')){
            akses = 1;
        }else{
            akses = 0;
        }
        
        let data = {};
        data[$(this).attr('name')] = akses;

        // console.log(data);
        let target = '<?php echo base_url('group/update_privilege') ?>/' + $(this).val();
        // // let update_group = sendAjax(target);
        let response = sendAjax(target, data);
    });
</script>