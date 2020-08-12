<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Categories'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    <h1>Categories</h1>
    
    <button><a href="<?php echo url_for('/admin/category_new.php') ?>">Create New Category</a></button>
    
    <table>
        <?php $categories = find_all_categories(); ?>
        <?php while($category = mysqli_fetch_assoc($categories)) { ?>
        <tr>
            <td><?php echo $category['name']; ?></td>
            <td>
                <button><a href="<?php echo url_for('/admin/category_edit.php?id=' . h(u($category['id']))); ?>">Edit</a></button>      
            </td>
            <td>
                <button><a href="<?php echo url_for('/admin/category_delete.php?id=' . h(u($category['id']))); ?>">Delete</a></button>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($categories); ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>