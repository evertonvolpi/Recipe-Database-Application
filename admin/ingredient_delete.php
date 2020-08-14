<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? redirect_to(url_for('/admin/ingredient.php')); //if !isset redirect

if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        delete_ingredient($id);

        redirect_to(url_for('/admin/ingredient.php'));
    } else {
        $message = "INCORRECT PASSWORD";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
} else {
    $ingredient_name = find_name_of_ingredient($id);
}

?>

<?php $page_title = 'Delete Ingredient - ' . h($ingredient_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>DELETE INGREDIENT - <?php echo h($ingredient_name); ?></h1>
    
    <h2>Are you sure you want to delete this ingredient?</h2>
    
    <form action="<?php echo url_for('/admin/ingredient_delete.php?id=' . h(u($id))) ?>" method="post">
        <input type="password" name="password" placeholder="Admin Password" required /></br>
        <input type="submit" value="Delete Ingredient">
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>