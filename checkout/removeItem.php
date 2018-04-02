<?php
include '../connect/connect.php';

extract($_POST);
foreach ($_SESSION['cart'] as $index => $item) {

    if ($comId == $item[0] && $prodId == $item[1]) {
        unset($_SESSION['cart'][$index]);
    }
}