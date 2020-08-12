<?php require_once('../private/initialize.php'); ?>

<?php
if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        $recipe_name = h($_POST['recipe_name']) ?? '';
        $instructions = h($_POST['recipe_instructions']) ?? '';
        
        $new_recipe_id = create_new_recipe_instructions($recipe_name, $instructions);
        
        $ing_new_list = explode(',', $_POST['ing_list']);
        foreach($ing_new_list as $ing_id) {
            $ing_qty_list[$ing_id] = h($_POST[$ing_id]);
        }
        
        $cat_new_list = explode(',', $_POST['cat_list']);

        create_new_recipe_ingredients($new_recipe_id, $ing_qty_list);
        create_new_recipe_categories($new_recipe_id, $cat_new_list);

        redirect_to(url_for('/admin/recipe_view.php?id=' . h(u($new_recipe_id))));
    } else {
        $message = "INCORRECT PASSWORD";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }    
}
?>

<?php $page_title = 'New Recipe'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<h1>New Recipe</h1>

<form action="<?php echo url_for('/admin/recipe_new.php'); ?>" id="new_recipe_form" method="post">
    
    <!-- N A M E -->
    
    <label for="recipe_name">Recipe Name</label></br>
    <input type="text" name="recipe_name" id="recipe_name" placeholder="Recipe Name" required></br>
    
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
    
    <table id="categories_table"></table>
    
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
    
    <table id="ingredients_table"></table>
    
    <input type="text" name="ing_list" id="ing_list" class="hidden" value=""/>
    
    <!-- I N S T R U C T I O N S -->
    
    <label for="recipe_instructions_form">Recipe Instructions</label></br>
    <textarea name="recipe_instructions" id="recipe_instructions" cols="30" rows="10"></textarea></br>

    <!-- S U B M I T -->

    <input type="password" name="password" placeholder="Admin Password" required /></br>
    <input type="submit" id="submit" value="Submit"/></br>
</form>

<script>var catArray = []; var ingArray = [];</script>
<script src="<?php echo url_for('/scripts/script.js'); ?>"></script>

<?php include(SHARED_PATH . '/footer.php'); ?>