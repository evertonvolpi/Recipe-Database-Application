<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/main.css'); ?>">
    <script src="<?php echo url_for('/scripts/jquery.3.5.1.js'); ?>"></script>
    <title><?php echo $page_title ?? 'Receitas'; ?></title>
</head>
<body>
    <header>
        <h1>
            <a href="<?php echo url_for('/index.php'); ?>">RECEITAS DA GABI</a>
        </h1>
        <nav>
            <button><a href="<?php echo url_for('/index.php'); ?>">Home</a></button>
            <button><a href="<?php echo url_for('/admin/index.php'); ?>">Admin Area</a></button>
        </nav>
    </header>    