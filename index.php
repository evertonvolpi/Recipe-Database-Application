<?php require_once('private/initialize.php'); ?>

<?php

    if(is_post_request()) {

        if($_POST['recipe_selected'] === '1') {
            $id = $_POST['recipe_id'];

            $subject = find_recipe_by_id($id);
            $recipe_selected = mysqli_fetch_assoc($subject);
            mysqli_free_result($subject);

            $categories = find_categories_of_recipe($recipe_selected['id']);
            $ingredients = find_ingredients_of_recipe($recipe_selected['id']);

            $recipes = find_all_recipes();
        } else if ($_POST['filter_ing'] === '1') {
            foreach($_POST['ingredients_list'] as $ingredient) {
                $ing_array[] = $ingredient;
            }
            $recipes = select_recipes_by_ingredients($ing_array);
        } else {
            foreach($_POST['categories_list'] as $category) {
                $cat_array[] = $category;
            }
            $recipes = select_recipes_by_categories($cat_array);
        }
    } else {
        $recipes = find_all_recipes();
    }
?>

<?php $page_title = 'Receitas da Gabi'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="form">
        <form action="<?php echo url_for('/index.php') ?>" method="post" id="select_form">
            <label for="recipes"><h2>Select a Recipe</h2></label>
            <select name="recipes" id="recipes">
                <option value="" selected disabled="disabled">Select</option>
                <?php while($recipe = mysqli_fetch_assoc($recipes)) { ?>
                <option value="<?php echo $recipe['id']; ?>"><?php echo h($recipe['name']); ?></option>
                <?php } ?>
            </select>
            <?php mysqli_free_result($recipes); ?>

            <input type="text" name="recipe_id" id="recipe_id" class="hidden" value="">
            <input type="text" name="recipe_selected" id="recipe_selected" class="hidden" value="0">
        </form>
    </div>

    <div>
        <div class="form">
            <button type="button" id="apply_filters_button">Filters</button>
        </div>

        <div id="filters" class="hidden">
            <div class="form filter_ingredients">
                <form action="<?php echo url_for('/index.php') ?>" method="post" id="select_form">        
                    <h3>Filter by ingredients</h3>
                    <?php $ings = find_all_ingredients(); ?>
                    <select multiple name="ingredients_list[]" id="ingredients_list" required>
                        <?php while($ingredient = mysqli_fetch_assoc($ings)) { ?>
                        <option type="checkbox" class="ing_list_item" value="<?php echo $ingredient['id'] ?>"><?php echo h(find_name_of_ingredient($ingredient['id'])) ?></option>
                        <?php } ?>
                    </select></br>
                    <?php mysqli_free_result($ings); ?>

                    <input type="text" name="filter_ing" id="filter_ing" class="hidden" value="0">
                    <input type="submit" id="submit_filter_ing" value="Filter">
                </form>
            </div>

            <div class="form filter_categories">
                <form action="<?php echo url_for('/index.php') ?>" method="post" id="select_form">        
                    <h3>Filter by categories</h3>
                    <?php $cats = find_all_categories(); ?>
                    <select multiple name="categories_list[]" id="categories_list" required>
                        <?php while($category = mysqli_fetch_assoc($cats)) { ?>
                        <option type="checkbox" class="cat_list_item" value="<?php echo $category['id'] ?>"><?php echo h(find_name_of_category($category['id'])) ?></option>
                        <?php } ?>
                    </select></br>
                    <?php mysqli_free_result($cats); ?>

                    <input type="text" name="filter_cat" id="filter_cat" class="hidden" value="0">
                    <input type="submit" id="submit_filter_cat" value="Filter">
                </form>
            </div> 
        </div>
    </div>

    <div class="form">
        <p>
            <?php foreach($ing_array as $ing) {
                echo h(find_name_of_ingredient($ing));
                if (next($ing_array) == true) echo ' | ';
            } ?>
        </p>
                
        <p>
            <?php foreach($cat_array as $cat) {
                echo h(find_name_of_category($cat));
                if (next($cat_array) == true) echo ' | ';
            } ?>
        </p>
                
        <?php
            if(is_post_request()) {
                if($_POST['recipe_selected'] !== '1') {      
                    echo '<button><a href="' . url_for('/index.php') . '">Clear Filters</a></button>';
                }
            } 
        ?>
    </div>
    
    <div class="view_recipe">
        <?php
        if(is_post_request()) {
            if($_POST['recipe_selected'] === '1') {            
                include(SHARED_PATH . '/display_recipe.php');
            } 
        }
        ?>         
    </div>
</div>

<script src="<?php echo url_for('/scripts/home_script.js'); ?>"></script>

<?php include(SHARED_PATH . '/footer.php'); ?>