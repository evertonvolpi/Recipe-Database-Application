<?php

// R E C I P E S

function find_all_recipes() {
    global $db;

    $sql = "SELECT * FROM instructions ";
    $sql .= "ORDER BY name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_recipe_by_id($recipe_id) {
    global $db;

    $sql = "SELECT * FROM instructions ";
    $sql .= "WHERE id='" . db_escape($db, $recipe_id) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function create_new_recipe_instructions($name, $instructions) {
    global $db;

    $sql = "INSERT INTO instructions (name, content) VALUES ";
    $sql .= "('" . db_escape($db, $name) . "', ";
    $sql .= "'" . db_escape($db, $instructions) . "') ";
    $result = mysqli_query($db, $sql);

    if($result) {
        return mysqli_insert_id($db);
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function create_new_recipe_ingredients($id, $ing_id_qty_list) {
    global $db;

    $sql = "INSERT INTO recipe (ins_id, ing_id, quantity) VALUES ";
    foreach($ing_id_qty_list as $ing_id => $qty) {
       $sql .= "('" . db_escape($db, $id) . "', ";
       $sql .= "'" . db_escape($db, $ing_id) . "', ";
       $sql .= "'" . db_escape($db, $qty) . "')";
       if (next($ing_id_qty_list) == true) $sql .= ","; 
    }
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo 'aqui: ' . mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function create_new_recipe_categories($id, $cat_id_list) {
    global $db;

    $sql = "INSERT INTO assigned_categories (ins_id, cat_id) VALUES ";
    foreach($cat_id_list as $cat_id) {
       $sql .= "('" . db_escape($db, $id) . "', ";
       $sql .= "'" . db_escape($db, $cat_id) . "')";
       if (next($cat_id_list) == true) $sql .= ","; 
    }
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_recipe_instructions($id, $name, $content) {
    global $db;

    $sql = "UPDATE instructions SET ";
    $sql .= "name='" . db_escape($db, $name) . "', ";
    $sql .= "content='" . db_escape($db, $content) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_instructions($recipe_id) {
    global $db;

    $sql = "DELETE FROM instructions ";
    $sql .= "WHERE id='" . db_escape($db, $recipe_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_assigned_categories($recipe_id) {
    global $db;

    $sql = "DELETE FROM assigned_categories ";
    $sql .= "WHERE ins_id='" . db_escape($db, $recipe_id) . "' ";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_recipe($recipe_id) {
    global $db;

    $sql = "DELETE FROM recipe ";
    $sql .= "WHERE ins_id='" . db_escape($db, $recipe_id) . "' ";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// I N G R E D I E N T S

function find_all_ingredients() {
    global $db;

    $sql = "SELECT * FROM ingredients";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_ingredients_of_recipe($recipe_id) {
    global $db;

    $sql = "SELECT * FROM recipe ";
    $sql .= "WHERE ins_id='" . db_escape($db, $recipe_id) . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_name_of_ingredient($ingredient_id) {
    global $db;

    $sql = "SELECT * FROM ingredients ";
    $sql .= "WHERE id='" . db_escape($db, $ingredient_id) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject['name'];
}

function create_new_ingredient($new_ingredient_name) {
    global $db;

    $sql = "INSERT IGNORE INTO ingredients (name) VALUES ";
    $sql .= "('" . db_escape($db, $new_ingredient_name) . "')";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_ingredient($ingredient_id, $new_value) {
    global $db;

    $sql = "UPDATE ingredients SET ";
    $sql .= "name='" . db_escape($db, $new_value) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $ingredient_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_ingredient($ingredient_id) {
    global $db;

    $sql = "DELETE FROM ingredients ";
    $sql .= "WHERE id='" . db_escape($db, $ingredient_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        return false;
    }
}

// C A T E G O R I E S

function find_all_categories() {
    global $db;

    $sql = "SELECT * FROM categories";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_categories_of_recipe($recipe_id) {
    global $db;

    $sql = "SELECT * FROM assigned_categories ";
    $sql .= "WHERE ins_id='" . db_escape($db, $recipe_id) . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_name_of_category($category_id) {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE id='" . db_escape($db, $category_id) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject['name'];
}

function create_new_category($new_category_name) {
    global $db;

    $sql = "INSERT IGNORE INTO categories (name) VALUES ";
    $sql .= "('" . db_escape($db, $new_category_name) . "')";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_category($category_id, $new_value) {
    global $db;

    $sql = "UPDATE categories SET ";
    $sql .= "name='" . db_escape($db, $new_value) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $category_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_category($category_id) {
    global $db;

    $sql = "DELETE FROM categories ";
    $sql .= "WHERE id='" . db_escape($db, $category_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        return false;
    }
}

// F I L T E R S

function select_recipes_by_ingredients($ing_list) {
    global $db;

    $sql = "SELECT instructions.id, ";
    $sql .= "instructions.name, ";
    $sql .= "recipes.ins_id, ";
    $sql .= "recipes.ing_id ";
    $sql .= "FROM instructions ";
    $sql .= "RIGHT JOIN (";
    
    if(count($ing_list) === 1) {
        $sql .= "SELECT * FROM recipe ";
        $sql .= "WHERE ing_id='" . db_escape($db, $ing_list[0]) . "'";
    } else {
        $i = 1;
        $last_value = array_pop($ing_list);
        
        $sql .= "SELECT t1.* FROM recipe t1 ";
        foreach($ing_list as $ing) {
            $sql .= "RIGHT JOIN recipe t" . ($i+1);
            $sql .= " ON t" . $i . ".ins_id = ";
            $sql .= "t" . ($i+1) . ".ins_id AND ";
            $sql .= "t" . ($i+1) . ".ing_id = ";
            $sql .= db_escape($db, $ing) . " ";
            $i++;
        }
        $sql .= "WHERE t1.ing_id = " . db_escape($db, $last_value);
    }
    
    $sql .= ") as recipes ON instructions.id = recipes.ins_id ";
    $sql .= "ORDER BY instructions.name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function select_recipes_by_categories($cat_list) {
    global $db;

    $sql = "SELECT instructions.id, ";
    $sql .= "instructions.name, ";
    $sql .= "categories.ins_id, ";
    $sql .= "categories.cat_id ";
    $sql .= "FROM instructions ";
    $sql .= "RIGHT JOIN (";
    
    if(count($cat_list) === 1) {
        $sql .= "SELECT * FROM assigned_categories ";
        $sql .= "WHERE cat_id='" . db_escape($db, $cat_list[0]) . "'";
    } else {
        $i = 1;
        $last_value = array_pop($cat_list);
        
        $sql .= "SELECT t1.* FROM assigned_categories t1 ";
        foreach($cat_list as $cat) {
            $sql .= "RIGHT JOIN assigned_categories t" . ($i+1);
            $sql .= " ON t" . $i . ".ins_id = ";
            $sql .= "t" . ($i+1) . ".ins_id AND ";
            $sql .= "t" . ($i+1) . ".cat_id = ";
            $sql .= db_escape($db, $cat) . " ";
            $i++;
        }
        $sql .= "WHERE t1.cat_id = " . db_escape($db, $last_value);
    }
    
    $sql .= ") as categories ON instructions.id = categories.ins_id ";
    $sql .= "ORDER BY instructions.name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// A D M I N S

function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

?>