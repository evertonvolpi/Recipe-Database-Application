<?php

    function url_for($path) {
        if ($path[0] != '/') {
            $path = '/' . $path;
        }
        return WWW_ROOT . $path;
    }

    function redirect_to($url) {
        header('Location: ' . $url);
        exit;
    }

    function h($string="") {
        return htmlspecialchars($string);
    }

    function u($string="") {
        return urlencode($string);
    }

    function raw_u($string="") {
        return rawurlencode($string);
    }

    function is_post_request() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function is_get_request() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function display_status_message() {
        if(isset($_SESSION['status'])) {
            $message = $_SESSION['status'];
            unset($_SESSION['status']);
            return '<p class="message">' . h($message) . '</p>';
        }
    }

?>