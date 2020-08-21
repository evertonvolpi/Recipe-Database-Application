<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? redirect_to(url_for('/admin/category.php')); //if !isset redirect
$category_name = find_name_of_category($id);

if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        delete_category($id);
        $_SESSION['status'] = 'Category "' . h($category_name) . '" successfuly deleted.';
        redirect_to(url_for('/admin/category.php'));
    } else {
        $message = "INCORRECT PASSWORD";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<?php $page_title = 'Delete Category - ' . h($category_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>DELETE CATEGORY - <?php echo h($category_name); ?></h1>
    
    <h2>Are you sure you want to delete this category?</h2>
    
    <form action="<?php echo url_for('/admin/category_delete.php?id=' . h(u($id))) ?>" method="post">
        <input type="password" name="password" placeholder="Admin Password" required /></br>
        <input type="submit" value="Delete Category">
    </form>
</div>



<?php include(SHARED_PATH . '/footer.php'); ?>