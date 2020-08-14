<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? redirect_to(url_for('/admin/ingredient.php')); //if !isset redirect
$ingredient_name = find_name_of_ingredient($id);

if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        update_ingredient($id, $_POST['new_value']);

        redirect_to(url_for('/admin/ingredient.php'));
    } else {
        $message = "INCORRECT PASSWORD";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<?php $page_title = 'Edit Ingredient - ' . h($ingredient_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>EDIT INGREDIENT - <?php echo h($ingredient_name); ?></h1>
    
    <form action="<?php echo url_for('/admin/ingredient_edit.php?id=' . h(u($id))) ?>" method="post">
        <input type="text" name="new_value" value="<?php echo h($ingredient_name); ?>" required></br>
        <input type="password" name="password" placeholder="Admin Password" required /></br>
        <input type="submit" value="Submit">
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>