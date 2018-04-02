<?php
//server information
$servername = "handsomemengzeng.com";
$username = "cmpe272";
$password = "123456";
$dbname = "cmpe272project";

extract($_POST);

//receive variable rate from product.php
$review = $_POST['review'];

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
  if(strlen($review) > 500){
    die("text is more than its limit, please try again with a text less than 500 character.");
  }
  else{
    //check if the user already rated or reviewed this product
    $checkUser_sql = "SELECT COUNT(*) AS n FROM ProductReview WHERE userId = $userId AND productId = $productId AND companyId = $companyId";
    $checkUser_result = mysqli_query($checkUser_sql, $con);
    $row = mysqli_fetch_row($checkUser_result);

    //now decide to insert or update, based on availability of the userId in the table
    if($row[0] == 0){
      $sql = "INSERT INTO ProductReview (productId, companyId, userId, review) VALUES ($productId, $companyId, $userId, $review)";
    }
    else{
      $sql = "UPDATE ProductReview SET review = $review WHERE userId = $userId AND productId = $productId AND companyId = $companyId";
    }

    //send the query
    mysqli_query($sql, $con);
  }
}

//close the database
mysqli_close($con);
?>
