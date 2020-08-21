<?php

    function log_in($admin) {
        session_regenerate_id(); // avoid session fixation
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $admin['username'];
        return true;
    }

    function log_out() {
        session_regenerate_id();
        unset($_SESSION['admin_id']);
        unset($_SESSION['last_login']);
        unset($_SESSION['username']);
        return true;
    }

    function is_logged_in() {
        return isset($_SESSION['admin_id']);
    }

    function require_login() {
        if(!is_logged_in()) {
            redirect_to(url_for('/admin/login.php'));
        }
    }
?>