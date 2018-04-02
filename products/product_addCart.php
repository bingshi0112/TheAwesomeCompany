<?php
include '../connect/connect.php';

extract($_POST);

if (empty($_SESSION['cart'])) {
    // if cart's empty, create cart
    $_SESSION['cart'] = [];
}

array_push($_SESSION['cart'], array($company_id, $prod_id, $prod_name, $prod_description, $prod_image_url, $prod_price));

//foreach ($_SESSION['cart'] as $item) {
//    print_r($item[0] . '--------------------');
//}
//print_r($company_id.  $prod_name . '--------------------');