<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Ingredients'; ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>Ingredients</h1>
    
    <button><a href="<?php echo url_for('/admin/ingredient_new.php') ?>">Register New Ingredient</a></button>
    
    <table>
        <?php $ingredients = find_all_ingredients(); ?>
        <?php while($ingredient = mysqli_fetch_assoc($ingredients)) { ?>
        <tr>
            <td><?php echo $ingredient['name']; ?></td>
            <td><a class="action" href="<?php echo url_for('/admin/ingredient_edit.php?id=' . h(u($ingredient['id']))); ?>"><i class="far fa-edit edit_button" title="edit"></i></a></td>
            <td><a class="action" href="<?php echo url_for('/admin/ingredient_delete.php?id=' . h(u($ingredient['id']))); ?>"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td>        
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($ingredients); ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>