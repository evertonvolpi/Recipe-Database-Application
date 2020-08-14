<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/main.css'); ?>">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.12.1/css/all.css">
    <script src="<?php echo url_for('/scripts/jquery.3.5.1.js'); ?>"></script>
    <title><?php echo $page_title ?? 'Receitas'; ?></title>
</head>
<body>
    <header>
        <h1>
            <a href="<?php echo url_for('/index.php'); ?>">RECEITAS DA GABI</a>
        </h1>
        <nav>
            <div><a href="<?php echo url_for('/index.php'); ?>"><button>Home</button></a></div>
            <div><a href="<?php echo url_for('/admin/index.php'); ?>"><button>Admin Area</button></a></div>
        </nav>
    </header>    