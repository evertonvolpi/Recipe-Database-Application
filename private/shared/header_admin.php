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
    <header id="admin_header">
        <h1>
            <a href="<?php echo url_for('/index.php'); ?>">RECEITAS DA GABI</a>
        </h1>
        
        <nav>
            <div><button id="hamburguer_menu"><i class="fas fa-bars"></i></button></div>
            <div class="to_hide"><a href="<?php echo url_for('/index.php'); ?>"><button>Home</button></a></div>
            <div class="to_hide"><a href="<?php echo url_for('/admin/index.php'); ?>"><button>Admin Area</button></a></div>
            <div class="to_hide"><a href="<?php echo url_for('/admin/recipe_new.php'); ?>"><button>New Recipe</button></a></div>
            <div class="to_hide"><a href="<?php echo url_for('/admin/category.php'); ?>"><button>Categories</button></a></div>
            <div class="to_hide"><a href="<?php echo url_for('/admin/ingredient.php'); ?>"><button>Ingredients</button></a></div>
        </nav>
    </header>