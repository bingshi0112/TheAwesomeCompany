<?php
session_start();

$servername = "handsomemengzeng.com";
$username = "cmpe272";
$password = "123456";
$dbname = "cmpe272project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cookie_most_visited = "cmpe272_most_visited";
$cookie_recent_visited = "cmpe272_recent_visited";

$cookie_most_visited_2 = "cmpe272_most_visited_2";
$cookie_recent_visited_2 = "cmpe272_recent_visited_2";


if (!empty($_SESSION['prod_list'])) {
    return;
}

$product_list = array();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://handsomemengzeng.com/cmpe272/product_info.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
$companyID1 = 1;
foreach (preg_split('~[\r\n]+~', $content) as $line) {
    list($id, $prodectName, $image, $description, $price) = explode("~!", $line);
    if ($id > 0) {
        array_push($product_list, [$companyID1, $id, $prodectName, $description, $image, $price]);
    }
}
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.theblingbling.us/CMPE272/lab11122016/CURL/allproducts.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
$companyID2 = 2;
foreach (preg_split('~[\r\n]+~', $content) as $line) {
    list($id, $prodectName, $image1, $image2, $image3, $description, $price) = explode("~!", $line);
    if ($id > 0) {
        array_push($product_list, [$companyID2, $id, $prodectName, $description, $image1, $price, $image2, $image3]);
    }
}
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://cmpe272.cmpe285.com/all_products.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
$companyID3 = 3;
foreach (preg_split('~[\r\n]+~', $content) as $line) {
    list($id, $prodectName, $image1, $description, $price) = explode("~!", $line);
    if ($id > 0) {
        array_push($product_list, [$companyID3, $id, $prodectName, $description, $image1, $price]);
    }
}
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://myarchitecturedesign.com/co/ProductFormat.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
$companyID4 = 4;
foreach (preg_split('~[\r\n]+~', $content) as $line) {
    list($id, $prodectName, $image1, $image2, $image3, $description, $price) = explode("~!", $line);
    if ($id > 0) {
        array_push($product_list, [$companyID4, $id, $prodectName, $description, $image1, $price]);
    }
}
curl_close($ch);

$_SESSION['prod_list'] = $product_list;

//foreach($company2 as $value){
//foreach($value as $key){
//echo "$key\n";
//}
//}		
