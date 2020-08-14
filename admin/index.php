<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Admin Area'; ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <div>
        <table id="admin_table">
            <tr>
                <th>Name</th>
                <th>&nbsp;</th> <!--view-->
                <th>&nbsp;</th> <!--edit-->
                <th>&nbsp;</th> <!--delete-->
            </tr>

            <?php $recipes = find_all_recipes() ?>
            <?php while($recipe = mysqli_fetch_assoc($recipes)) { ?>
            <tr>
                <td><?php echo h($recipe['name']) ?></td>
                <td><a class="action" href="<?php echo url_for('/admin/recipe_view.php?id=' . h(u($recipe['id']))); ?>"><i class="fas fa-eye view_button" title="view"></i></a></td>
                <td><a class="action" href="<?php echo url_for('/admin/recipe_edit.php?id=' . h(u($recipe['id']))); ?>"><i class="far fa-edit edit_button" title="edit"></i></a></td>
                <td><a class="action" href="<?php echo url_for('/admin/recipe_delete.php?id=' . h(u($recipe['id']))); ?>"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td>
            </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($recipes) ?>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>