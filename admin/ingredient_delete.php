<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/ingredient.php')); //if !isset redirect
$ingredient_name = find_name_of_ingredient($id);
$errors = [];

if(is_post_request()) {
    $result = delete_ingredient($id);      
    if($result) {
        $_SESSION['status'] = 'Ingredient "' . h($ingredient_name) . '" successfuly deleted.';
        redirect_to(url_for('/admin/ingredient.php'));
    } else {
        $errors[] = 'You cannot delete an ingredient that is assigned to a recipe.';
    }
}

?>

<?php $page_title = 'Delete Ingredient - ' . h($ingredient_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">

    <?php echo display_errors($errors); ?>

    <h1>DELETE INGREDIENT - <?php echo h($ingredient_name); ?></h1>
    
    <h2>Are you sure you want to delete this ingredient?</h2>
    
    <form action="<?php echo url_for('/admin/ingredient_delete.php?id=' . h(u($id))) ?>" method="post">
        <button type="submit">Delete</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>