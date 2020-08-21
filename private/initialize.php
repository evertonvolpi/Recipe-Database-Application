<?php
    ob_start(); // output buffering: on
    session_start(); // sessions: on

    define('PRIVATE_PATH', dirname(__FILE__));
    define('SHARED_PATH', PRIVATE_PATH . '/shared');
    define('MAIN_PATH', dirname(PRIVATE_PATH));

    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/receitas') + 9;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define ('WWW_ROOT', $doc_root);

    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');
    require_once('authentication_functions.php');

    $db = db_connect();
    $errors = [];
?>