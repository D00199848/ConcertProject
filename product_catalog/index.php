<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
} 

if ($action == 'list_products') {
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    $band = get_bands();
    $band_name = get_band_name($band_id);
    $gigs = get_gigs_by_band($band_id);

    include('product_list.php');
} else if ($action == 'view_product') {
    $gig_id = filter_input(INPUT_GET, 'gig_id', 
            FILTER_VALIDATE_INT);   
    if ($gig_id == NULL || $gig_id == FALSE) {
        $error = 'Missing or incorrect product id.';
        include('../errors/error.php');
    } else {
        $band = get_bands();
        $gig = get_gig($gig_id);

        // Get product data
        $code = $gig['productCode'];
        $name = $gig['productName'];
        $list_price = $gig['listPrice'];
        $seat = $gig['seat'];

        // Calculate discounts
        $discount_percent = 30;  // 30% off for all web orders
        $discount_amount = round($list_price * ($discount_percent/100.0), 2);
        $unit_price = $list_price - $discount_amount;

        // Format the calculations
        $discount_amount_f = number_format($discount_amount, 2);
        $unit_price_f = number_format($unit_price, 2);

        // Get image URL and alternate text
        $image_filename = '../images/' . $code . '.png';
        $image_alt = 'Image: ' . $code . '.png';

        include('product_view.php');
    }
}
?>