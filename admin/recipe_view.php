<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/index.php')); //if !isset redirect

$subject = find_recipe_by_id($id);
$recipe_selected = mysqli_fetch_assoc($subject);
mysqli_free_result($subject);

$ingredients = find_ingredients_of_recipe($id);

$categories = find_categories_of_recipe($id);

?>

<?php $page_title = h($instructions['name']); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">

    <?php echo display_status_message(); ?>

    <div class="view_recipe">
        <?php include(SHARED_PATH . '/display_recipe.php'); ?>         
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>