<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? redirect_to(url_for('/admin/index.php')); //if !isset redirect

$subject = find_recipe_by_id($id);
$instructions = mysqli_fetch_assoc($subject);
mysqli_free_result($subject);

$ingredients = find_ingredients_of_recipe($id);

$categories = find_categories_of_recipe($id);

?>

<?php $page_title = h($instructions['name']); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    <h1><?php echo h($instructions['name']); ?></h1>
    
    <p>
        <?php 
        $i = 1;
        while($category = mysqli_fetch_assoc($categories)) {
            echo h(find_name_of_category($category['cat_id']));
            if (mysqli_num_rows($categories) > $i) echo ' | ';
            $i++;
        } ?>
    </p>
    <?php mysqli_free_result($categories); ?>
    
    
    <h3>Ingredients</h3>
    
    <table>
        <?php while($ingredient = mysqli_fetch_assoc($ingredients)) { ?>
        <tr>
            <td><?php echo h(find_name_of_ingredient($ingredient['ing_id'])); ?></td>
            <td><?php echo h($ingredient['quantity']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($ingredients); ?>
        
    <h3>Instructions</h3>
        
    <p><?php echo h($instructions['content']); ?></p>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>