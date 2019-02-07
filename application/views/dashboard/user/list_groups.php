<style>
    .mytable {
        min-width: 100%;
    }
</style>
<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
<table class="table mytable" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo lang('groups') ?></th>
            <th><?php echo lang('description') ?></th>
            <th><?php echo lang('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($groups)): ?>
            <?php foreach ($groups as $ig => $g): ?>
                <tr>
                    <td>
                        <?php 
                            // Check if group is accessible for current user
                            $is_accessible = array_filter($ugroups, function($ug) use ($g) {
                                return $ug->group_id == $g->id;
                            });
                            $checked = !empty($is_accessible) ? 'checked' : ''; 
                        ?>
                        <input type="checkbox" class="flat" name="group_id" value="<?php echo $g->id ?>" <?php echo $checked ?>>
                    </td>
                    <td><?php echo $g->name ?></td>
                    <td><?php echo $g->description ?></td>
                    <td>
                        <!-- Group Related Actions -->
                    </td>
                </tr>
            <?php endforeach ?>            
        <?php endif ?>
    </tbody>
</table>
<script>
    init_iCheck();
    let mytable = $(".mytable").DataTable();

    $(".mytable input[name='group_id']").change(function() {
        let operation = this.checked === true ? 'add' : 'delete';
        let user_id = $("input[name='user_id']").val();

        let target = `<?php echo base_url('user') ?>/${operation}_group`;

        // Prepare data (form replacement)
        let data = {};
        data['group_id'] = this.value;
        data['user_id'] = user_id;

        let response = sendAjax(target, data);
    });
</script>