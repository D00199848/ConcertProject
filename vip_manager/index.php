<img src="../images/vip2.png" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>

<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_vips';
    }
}

if ($action == 'list_vips') {
    // Get the current category ID
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    
    // Get product and category data
    $band_name = get_band_name($band_id);
    $bands = get_bands();
    $vips = get_vips_by_vip($vip_id);

    // Display the vip list
    include('product_list.php');
} else if ($action == 'show_edit_form') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    if ($vip_id == NULL || $vip_id == FALSE) {
        $error = "Missing or incorrect gig id.";
        include('../errors/error.php');
    } else { 
        $vip = get_vip($vip_id);
        include('product_edit.php');
    }
} else if ($action == 'update_vip') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $vip_code = filter_input(INPUT_POST, 'vipcode');
    $band_name = filter_input(INPUT_POST, 'bandname');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate the inputs
    if ($vip_id == NULL || $vip_id == FALSE || $band_id == NULL || 
            $band_id == FALSE || $vip_code == NULL || $band_name == NULL || 
            $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_vip($vip_id, $band_id, $vip_code, $band_name, $price);

        // Display the Product List page for the current category
        header("Location: .?band_id=$band_id");
    }
} else if ($action == 'delete_vip') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE ||
            $vip_id == NULL || $vip_id == FALSE) {
        $error = "Missing or incorrect gig id or band id.";
        include('../errors/error.php');
    } else { 
        delete_vip($vip_id);
        header("Location: .?band_id=$band_id");
    }
} else if ($action == 'show_add_form') {
    $bands = get_bands();
    include('product_add.php');
} else if ($action == 'add_vip') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $vip_code = filter_input(INPUT_POST, 'vip_code');
    $band_name = filter_input(INPUT_POST, 'band_name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
  
    if ($band_id == NULL || $band_id == FALSE || $vip_code == NULL || 
            $band_name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_vip($band_id, $vip_code, $band_name, $price);
        header("Location: .?band_id=$band_id");
    }
} else if ($action == 'list_bands') {
    $bands = get_bands();
    include('category_list.php');
} else if ($action == 'add_band') {
    $band_name = filter_input(INPUT_POST, 'band_name');

    // Validate inputs
    if ($band_name == NULL) {
        $error = "Invalid band name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_band($band_name);
        header('Location: .?action=list_bands');  // display the Category List page
    }
} else if ($action == 'delete_band') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    delete_band($band_id);
    header('Location: .?action=list_bands');      // display the Category List page
}
?>