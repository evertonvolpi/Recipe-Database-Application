<div class="title_cat_style">
   <h1><?php echo h($recipe_selected['name']) ?? ''; ?></h1>
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
</div>

<div class="ing_style">
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
</div>

<div class="ins_style">
    <h3>Instructions</h3>
    <p><?php echo h($recipe_selected['content']); ?></p>
</div>

    
