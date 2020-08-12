<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Admin Area'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div>
        <button><a href="<?php echo url_for('/admin/recipe_new.php'); ?>">New Recipe</a></button>
        <button><a href="<?php echo url_for('/admin/category.php'); ?>">Categories</a></button>
        <button><a href="<?php echo url_for('/admin/ingredient.php'); ?>">Ingredients</a></button>    
    </div>

    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Categories</th>
                <th>Ingredients</th>
                <th>&nbsp;</th> <!--view-->
                <th>&nbsp;</th> <!--edit-->
                <th>&nbsp;</th> <!--delete-->
            </tr>

            <?php $recipes = find_all_recipes() ?>
            <?php while($recipe = mysqli_fetch_assoc($recipes)) { ?>
            <tr>
                <td><?php echo h($recipe['id']) ?></td>
                <td><?php echo h($recipe['name']) ?></td>
                <td>
                    <?php $categories = find_categories_of_recipe($recipe['id']); ?>
                    <ul>
                        <?php while($category = mysqli_fetch_assoc($categories)) { ?>
                        <li><?php echo find_name_of_category($category['cat_id']); ?></li>
                        <?php } ?>
                    </ul>
                    <?php mysqli_free_result($categories); ?>
                </td>
                <td>
                    <?php $ingredients = find_ingredients_of_recipe($recipe['id']); ?>
                    <ul>
                        <?php while($ingredient = mysqli_fetch_assoc($ingredients)) { ?>
                        <li><?php echo find_name_of_ingredient($ingredient['ing_id']); ?></li>
                        <?php } ?>
                    </ul>
                    <?php mysqli_free_result($ingredients); ?>
                </td>
                <td><button><a class="action" href="<?php echo url_for('/admin/recipe_view.php?id=' . h(u($recipe['id']))); ?>">View</a></button></td>
                <td><button><a class="action" href="<?php echo url_for('/admin/recipe_edit.php?id=' . h(u($recipe['id']))); ?>">Edit</a></button></td>
                <td><button><a class="action" href="<?php echo url_for('/admin/recipe_delete.php?id=' . h(u($recipe['id']))); ?>">Delete</a></button></td>
            </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($recipes) ?>
    </div>   

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>