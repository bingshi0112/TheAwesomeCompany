
<?php
session_start();
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://handsomemengzeng.com/cmpe272/product_info.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content=curl_exec($ch);
$companyID1 = 1;
foreach(preg_split('~[\r\n]+~', $content) as $line){
	list($id, $prodectName,$image, $description, $price) = explode("~!", $line);
	if($id>0){
	$company1[] = [$companyID1,$id,$prodectName,$image, $description, $price];
	}
}
curl_close ($ch);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://www.theblingbling.us/CMPE272/lab11122016/CURL/allproducts.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content=curl_exec($ch);
$companyID2 = 2;
foreach(preg_split('~[\r\n]+~', $content) as $line){
	list($id, $prodectName,$image1,$image2,$image3 ,$description, $price) = explode("~!", $line);
	if($id>0){
	$company2[] = [ $companyID2,$id,$prodectName,$image1,$description, $price, $image2,$image3];
	}
}
curl_close ($ch);

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://cmpe272.cmpe285.com/all_products.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content=curl_exec($ch);
$companyID3 = 3;
foreach(preg_split('~[\r\n]+~', $content) as $line){
	list($id, $prodectName,$image1, $image2,$image3,$description, $price) = explode("~!", $line);
	if($id>0){
	$company3[] = [ $companyID3,$id,$prodectName,$image1,$description, $price, $image2,$image3];
	}
}
curl_close ($ch);
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://myarchitecturedesign.com/co/ProductFormat.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content=curl_exec($ch);
$companyID4 = 4;
foreach(preg_split('~[\r\n]+~', $content) as $line){
	list($id, $prodectName,$image1,$image2,$image3, $description, $price) = explode("~!", $line);
	if($id>0){
	$company4[] = [ $companyID4,$id,$prodectName,$image1,$description, $price, $image2,$image3];
	}
}
curl_close ($ch);
if (empty($_SESSION['prod_list'])) {
    $_SESSION['prod_list'] = [
       $company1,$company2,$company3,$company4
    ];
}
//foreach($company2 as $value){
	//foreach($value as $key){
		//echo "$key\n";
	//}
//}		
?>