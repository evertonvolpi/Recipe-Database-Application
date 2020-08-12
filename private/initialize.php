<?php

    //ob_start();

    define('PRIVATE_PATH', dirname(__FILE__));
    define('SHARED_PATH', PRIVATE_PATH . '/shared');
    define('MAIN_PATH', dirname(PRIVATE_PATH));

    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/receitas') + 9;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define ('WWW_ROOT', $doc_root);

    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');

    $db = db_connect();
    
    $sql_password = "SELECT * FROM admin_password";
    $result_password = mysqli_query($db, $sql_password);
    $subject_password = mysqli_fetch_assoc($result_password);
    mysqli_free_result($result_password);
    $admin_password = $subject_password['admin_password'];
?>