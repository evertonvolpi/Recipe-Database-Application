<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/category.php')); //if !isset redirect
$category_name = find_name_of_category($id);

if(is_post_request()) {
    update_category($id, $_POST['new_value']);
    $_SESSION['status'] = 'Category "' . h($_POST['new_value']) . '" successfuly edited.';
    redirect_to(url_for('/admin/category.php'));
}

?>

<?php $page_title = 'Edit Category - ' . h($category_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>EDIT CATEGORY - <?php echo h($category_name); ?></h1>
    
    <form action="<?php echo url_for('/admin/category_edit.php?id=' . h(u($id))) ?>" method="post">
        <input type="text" name="new_value" value="<?php echo h($category_name); ?>" required></br>
        <button type="submit">Submit</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>