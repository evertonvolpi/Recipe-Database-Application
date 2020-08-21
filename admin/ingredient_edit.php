<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/ingredient.php')); //if !isset redirect
$ingredient_name = find_name_of_ingredient($id);

if(is_post_request()) {
    update_ingredient($id, $_POST['new_value']);
    $_SESSION['status'] = 'Ingredient "' . h($_POST['new_value']) . '" successfuly edited.';
    redirect_to(url_for('/admin/ingredient.php'));
}

?>

<?php $page_title = 'Edit Ingredient - ' . h($ingredient_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>EDIT INGREDIENT - <?php echo h($ingredient_name); ?></h1>
    
    <form action="<?php echo url_for('/admin/ingredient_edit.php?id=' . h(u($id))) ?>" method="post">
        <input type="text" name="new_value" value="<?php echo h($ingredient_name); ?>" required></br>
        <button type="submit">Submit</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>