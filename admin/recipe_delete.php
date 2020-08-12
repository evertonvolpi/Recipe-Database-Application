<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? redirect_to(url_for('/admin/index.php')); //if !isset redirect

if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        delete_recipe($id);
        delete_assigned_categories($id);
        delete_instructions($id);

        redirect_to(url_for('/admin/index.php'));
    } else {
        $message = "INCORRECT PASSWORD";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
} else {
    $subject = find_recipe_by_id($id);
    $instructions = mysqli_fetch_assoc($subject);
    mysqli_free_result($subject);
}

?>

<?php $page_title = 'Delete - ' . h($instructions['name']); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    <h1>DELETE - <?php echo h($instructions['name']); ?></h1>
    
    <h2>Are you sure you want to delete this recipe?</h2>
    
    <form action="<?php echo url_for('/admin/recipe_delete.php?id=' . h(u($id))) ?>" method="post">
        <input type="password" name="password" placeholder="Admin Password" required /></br>
        <input type="submit" value="Delete Recipe">
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>