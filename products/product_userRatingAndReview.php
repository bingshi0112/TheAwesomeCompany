<?php

//server information
$servername = "handsomemengzeng.com";
$username = "cmpe272";
$password = "123456";
$dbname = "cmpe272project";

//receive variable rate from product_userRating.js
$rate = $_POST['rate'];

//receive productId, companyId, and userId from product_session.php
$productId = $_GET['productId'];
$companyId = $_GET['companyId'];
$userId = $_GET['userId'];

//connecting to server
$con = mysqli_connect($servername, $username, $password, $dbname);

//check if its connected
if(!$con){
  die("connection to the server error!");
}
else{
  //check if the user already rated or reviewed this product
  $checkUser_sql = "SELECT COUNT(*) AS n FROM ProductReview WHERE userId = $userId AND productId = $productId AND companyId = $companyId";
  $checkUser_result = mysqli_query($checkUser_sql, $con);
  $row = mysqli_fetch_row($checkUser_result);

  //now decide to insert or update, based on availability of the userId in the table
  if($row[0] == 0){
    $sql = "INSERT INTO ProductReview (productId, companyId, userId, rating) VALUES ($productId, $companyId, $userId, $rate)";
  }
  else{
    $sql = "UPDATE ProductReview SET rating = $rate WHERE userId = $userId AND productId = $productId AND companyId = $companyId";
  }

  //send the query
  mysqli_query($sql, $con);
}

//calculate the average rating for a specific product
$avgRating_sql = "SELECT AVG(rating) AS average FROM ProductReview WHERE productId = $productId AND companyId = $companyId";
$avgRating_result = mysqli_query($avgRating_sql, $con);

//Delete the current rating average for this specific product
$deleteCurrentRating_sql = "DELETE FROM ProductAverageRating WHERE productId = $productId AND companyId = $companyId";

//read the average rating from ProductReview table and then insert it in ProductAverageRating table
$row_avgRating = mysqli_fetch_row($avgRating_result);

//update the ProductAverageRating table
$sql_avg = "INSERT INTO ProductAverageRating (productId, companyId, averageRating) VALUES ($productId, $companyId, $row_avgRating[0])";

//send the query
mysqli_query($sql_avg, $con);

//close the database
mysqli_close($con);
?>
