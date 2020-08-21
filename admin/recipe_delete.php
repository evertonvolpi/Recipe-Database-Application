<?php 

require_once('../private/initialize.php');

require_login();

$id = $_GET['id'] ?? redirect_to(url_for('/admin/index.php')); //if !isset redirect
$subject = find_recipe_by_id($id);
$instructions = mysqli_fetch_assoc($subject);
mysqli_free_result($subject);

if(is_post_request()) {
    delete_recipe($id);
    delete_assigned_categories($id);
    delete_instructions($id);
    $_SESSION['status'] = 'Recipe "' . h($instructions['name']) . '" successfuly deleted.';
    redirect_to(url_for('/admin/index.php'));
}

?>

<?php $page_title = 'Delete - ' . h($instructions['name']); ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>DELETE - <?php echo h($instructions['name']); ?></h1>
    
    <h2>Are you sure you want to delete this recipe?</h2>
    
    <form action="<?php echo url_for('/admin/recipe_delete.php?id=' . h(u($id))) ?>" method="post">
        <button type="submit">Delete</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>