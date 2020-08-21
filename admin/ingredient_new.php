<?php 

require_once('../private/initialize.php');

require_login();

if(is_post_request()) {
    $result = create_new_ingredient($_POST['new_ingredient_name']);        
    if($result) {
        $_SESSION['status'] = 'Ingredient "' . h($_POST['new_ingredient_name']) . '" successfuly registered.';
        redirect_to(url_for('/admin/ingredient.php'));
    } else {
        $message = $result;
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<?php $page_title = 'New Ingredient'; ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>New Ingredient</h1>
    
    <form action="<?php echo url_for('/admin/ingredient_new.php'); ?>" method="post">
        <input type="text" name="new_ingredient_name" placeholder="New Ingredient Name" required></br>
        <button type="submit">Submit</button>
    </form>
<div id="content">

<?php include(SHARED_PATH . '/footer.php'); ?>