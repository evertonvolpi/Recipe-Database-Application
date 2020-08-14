<?php require_once('../private/initialize.php');

if(is_post_request()) {
    if($_POST['password'] == $admin_password) {
        $result = create_new_category($_POST['new_category_name']);        
        if($result) {
            redirect_to(url_for('/admin/category.php'));
        } else {
            $message = $result;
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "INCORRECT PASSWORD";
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
        <input type="password" name="password" placeholder="Admin Password" required /></br>
        <input type="submit" value="Submit">
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>