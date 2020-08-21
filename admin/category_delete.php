<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/category.php')); //if !isset redirect
$category_name = find_name_of_category($id);
$errors = [];

if(is_post_request()) {

    $result = delete_category($id);      
    if($result) {
        $_SESSION['status'] = 'Category "' . h($category_name) . '" successfuly deleted.';
        redirect_to(url_for('/admin/category.php'));
    } else {
        $errors[] = 'You cannot delete a category that is assigned to a recipe.';
    }
}

?>

<?php $page_title = 'Delete Category - ' . h($category_name); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">

    <?php echo display_errors($errors); ?>

    <h1>DELETE CATEGORY - <?php echo h($category_name); ?></h1>
    
    <h2>Are you sure you want to delete this category?</h2>
    
    <form action="<?php echo url_for('/admin/category_delete.php?id=' . h(u($id))) ?>" method="post">
        <button type="submit" name="submit">Delete</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>