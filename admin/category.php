<?php require_once('../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Categories'; ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">

    <?php echo display_status_message(); ?>

    <h1>Categories</h1>
    
    <button><a href="<?php echo url_for('/admin/category_new.php') ?>">Create New Category</a></button>
    
    <table>
        <?php $categories = find_all_categories(); ?>
        <?php while($category = mysqli_fetch_assoc($categories)) { ?>
        <tr>
            <td><?php echo $category['name']; ?></td>
            <td><a class="action" href="<?php echo url_for('/admin/category_edit.php?id=' . h(u($category['id']))); ?>"><i class="far fa-edit edit_button" title="edit"></i></a></td>
            <td><a class="action" href="<?php echo url_for('/admin/category_delete.php?id=' . h(u($category['id']))); ?>"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($categories); ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>