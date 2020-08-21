<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin.php')); //if !isset redirect

$subject = find_recipe_by_id($id);
$recipe_instructions = mysqli_fetch_assoc($subject);
mysqli_free_result($subject);

$cat_old_list = [];
$ing_old_list = [];

if(is_post_request()) {
    $recipe_name = h($_POST['recipe_name']) ?? '';
    $instructions = h($_POST['recipe_instructions']) ?? '';
    $cat_new_list = explode(',', $_POST['cat_list']);
    
    $ing_new_list = explode(',', $_POST['ing_list']);
    foreach($ing_new_list as $ing_id) {
        $ing_qty_list[$ing_id] = h($_POST[$ing_id]);
    }
    update_recipe_instructions($id, $recipe_name, $instructions);
    delete_assigned_categories($id);
    create_new_recipe_categories($id, $cat_new_list);
    delete_recipe($id);
    create_new_recipe_ingredients($id, $ing_qty_list);
    
    $_SESSION['status'] = 'Recipe "' . h($recipe_name) . '" successfuly edited.';
    redirect_to(url_for('/admin/recipe_view.php?id=' . h(u($id))));     
}
?>

<?php $page_title = 'Edit - ' . h($recipe_instructions['name']); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">

    <form action="<?php echo url_for('/admin/recipe_edit.php?id=' . $id); ?>" method="post">
        
        <!-- N A M E -->
        
        <label for="recipe_name">Recipe Name</label></br>
        <input type="text" name="recipe_name" id="recipe_name" value="<?php echo $recipe_instructions['name']; ?>" required></br>
        
        <!-- C A T E G O R I E S -->
    
        <label for="categories_list">Select the categories</label></br>
        <?php $categories = find_all_categories(); ?>
        <select name="categories_list" id="categories_list">
            <option value="" selected disabled="disabled">Select</option>
            <?php while($category = mysqli_fetch_assoc($categories)) { ?>
            <option class="cat_list_item" value="<?php echo $category['id'] ?>"><?php echo find_name_of_category($category['id']) ?></option>
            <?php } ?>
        </select></br>
        <?php mysqli_free_result($categories); ?>
            
        <?php $recipe_categories = find_categories_of_recipe($id); ?>
        <table id="categories_table">
            <?php while($category = mysqli_fetch_assoc($recipe_categories)) { ?>
            <tr>
                <td><?php echo find_name_of_category($category['cat_id']); ?></td>
                <td><a class="remove_button" href="javascript:void(0)" id="<?php echo 'rem_cat_' . $category['cat_id']; ?>"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td>
            </tr>
            <?php $cat_old_list[] = $category['cat_id']; } ?>
        </table>
        <?php mysqli_free_result($recipe_categories); ?>
            
        <input type="text" name="cat_list" id="cat_list" class="hidden" value=""/>
            
        <!-- I N G R E D I E N T S -->
            
        <label for="ingredients_list">Select new ingredient</label></br>
        <?php $ingredients = find_all_ingredients(); ?>
        <select name="ingredients_list" id="ingredients_list">
            <option value="" selected disabled="disabled">Select</option>
            <?php while($ingredient = mysqli_fetch_assoc($ingredients)) { ?>
            <option class="ing_list_item" value="<?php echo $ingredient['id'] ?>"><?php echo find_name_of_ingredient($ingredient['id']) ?></option>
            <?php } ?>
        </select></br>
        <?php mysqli_free_result($ingredients); ?>
            
        <?php $recipe_ingredients = find_ingredients_of_recipe($id); ?>
        <table id="ingredients_table">
            <?php while($ingredient = mysqli_fetch_assoc($recipe_ingredients)) { ?>
            <tr>
                <td><?php echo find_name_of_ingredient($ingredient['ing_id']); ?></td>
                <td>
                    <input 
                    type="text" 
                    name="<?php echo h($ingredient['ing_id']); ?>"
                    value="<?php echo h($ingredient['quantity']); ?>" />
                </td>
                <td><a class="remove_button" href="javascript:void(0)" id="<?php echo 'rem_ing_' . $ingredient['ing_id']; ?>"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td>

                <!-- <td><button type="button" class="remove_button" id="<?php //echo 'rem_ing_' . $ingredient['ing_id']; ?>">Remove</button></td> -->
            </tr>
            <?php $ing_old_list[] = $ingredient['ing_id']; } ?>
        </table>
        <?php mysqli_free_result($recipe_ingredients); ?>
            
        <input type="text" name="ing_list" id="ing_list" class="hidden" value=""/>
            
        <!-- I N S T R U C T I O N S -->
            
        <label for="recipe_instructions_form">Recipe Instructions</label></br>
        <textarea name="recipe_instructions" id="recipe_instructions" cols="30" rows="10">
            <?php echo h($recipe_instructions['content']); ?>
        </textarea></br>
            
            
        <!-- S U B M I T -->
        <button type="submit" id="submit">Submit</button>
    </form>

</div>

<script> var catArray = <?php echo json_encode($cat_old_list); ?>; </script>
<script> var ingArray = <?php echo json_encode($ing_old_list); ?>; </script>
<script src="<?php echo url_for('/scripts/script.js'); ?>"></script>


<?php include(SHARED_PATH . '/footer.php'); ?>