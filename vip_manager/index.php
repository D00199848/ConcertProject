<img src="../images/vip.png" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>

<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_vip';
    }
}

if ($action == 'list_vip') {
    // Get the current band ID
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    
    // Get gig and band data
    $band_name = get_band_name($band_id);
    $bands = get_bands();
    $gigs = get_gigs_by_gig($band_id);

    // Display the vip list
    include('product_list.php');
} else if ($action == 'show_edit_form') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    if ($vip_id == NULL || $vip_id == FALSE) {
        $error = "Missing or incorrect vip id.";
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
    $vip_code = filter_input(INPUT_POST, 'vip_code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    

    // Validate the inputs
    if ($vip_id == NULL || $vip_id == FALSE || $band_id == NULL || 
            $band_id == FALSE || $vip_code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE) {
        $error = "Invalid vip data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_gig($vip_id, $band_id, $vip_code, $name, $price);

        // Display the vip List page for the current band
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
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    
    if ($band_id == NULL || $band_id == FALSE || $vip_code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_gig($band_id, $vip_code, $name, $price);
        header("Location: .?band_id=$band_id");
    }
} else if ($action == 'list_bands') {
    $bands = get_bands();
    include('category_list.php');
} else if ($action == 'add_band') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid band name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_band($name);
        header('Location: .?action=list_bands');  // display the Category List page
    }
} else if ($action == 'delete_band') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    delete_band($band_id);
    header('Location: .?action=list_bands');      // display the Category List page
}
?>