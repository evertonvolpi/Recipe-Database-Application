<?php 
    require_once('../private/initialize.php');

    $errors = [];
    $username = '';
    $password = '';

    if(is_post_request()) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        //Validations
        if(is_blank($username)) {
          $errors[] = 'Username cannot be blank.';
        }
        if(is_blank($password)) {
          $errors[] = 'Password cannot be blank.';
        }

        //no errors(blank) > try to login
        if(empty($errors)) {
            $login_failure_msg = 'Log in was unsuccessful. Review username and password.';
            $admin = find_admin_by_username($username);

            if($admin) {
                if(password_verify($password, $admin['hashed_password'])) {
                    //password matches
                    log_in($admin);
                    redirect_to(url_for('/admin/index.php'));
                } else {
                    //password does not match
                    $errors[] = $login_failure_msg;
                }
            } else {
                //no username found
                $errors[] = $login_failure_msg;
            }
        }
    }
?>

<?php $page_title = 'Login' ?>

<?php include(SHARED_PATH . '/header_admin.php'); ?>

<div id="content">
    <h1>Log In</h1>
    
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/admin/login.php'); ?>" method="post">
        <label for="username">Username:</label></br>
        <input type="text" id="username" name="username" required /></br>
        <label for="password">Password:</label></br>    
        <input type="password" id="password" name="password" required /></br>
        <button type="submit" name="submit">Log In</button>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>