<style>
    .mytable {
        min-width: 100%;
    }
</style>
<input type="hidden" name="menu_id" value="<?php echo $menu_id ?>">
<table class="table mytable">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo lang('groups') ?></th>
            <th><?php echo lang('description') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($groups)): ?>
            <?php foreach ($groups as $ig => $g): ?>
                <tr>
                    <td>
                        <?php 
                            // Check if group is having access into current menu
                            $is_accessible = array_filter($mgroups, function($mg) use ($g) {
                                return $mg->group_id == $g->id;
                            });
                            $checked = !empty($is_accessible) ? 'checked' : ''; 
                        ?>
                        <input type="checkbox" class="flat" name="group_id" value="<?php echo $g->id ?>" <?php echo $checked ?>>
                    </td>
                    <td><?php echo $g->name ?></td>
                    <td><?php echo $g->description ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<script>
    init_iCheck();
    let mytable = $(".mytable").DataTable();

    // do Add or Delete
    $(".mytable input[name='group_id']").change(function() {
        let operation = this.checked === true ? 'add' : 'delete';
        let menu_id = $("input[name='menu_id']").val();

        let target = `<?php echo base_url('menu') ?>/${operation}_group`;

        // Prepare data (form replacement)
        let data = {};
        data['group_id'] = this.value;
        data['menu_id'] = menu_id;
        data['submit'] = 1;

        let response = sendAjax(target, data);
    });
</script>