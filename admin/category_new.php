<?php 

require_once('../private/initialize.php');

require_login();

if(is_post_request()) {
    $result = create_new_category($_POST['new_category_name']);        
    if($result) {
        $_SESSION['status'] = 'Category "' . h($_POST['new_category_name']) . '" successfuly created.';
        redirect_to(url_for('/admin/category.php'));
    } else {
        $message = $result;
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<?php $page_title = 'New Category'; ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>New Category</h1>
    
    <form action="<?php echo url_for('/admin/category_new.php'); ?>" method="post">
        <input type="text" name="new_category_name" placeholder="New Category Name" required></br>
        <button type="submit">Submit</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>