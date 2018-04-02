<?php include '../connect/connect.php' ?>
<?php
include '../connect/Cookie_Utils.php';
$companyId = (int)$_GET['companyId'];
$product_id = (int)$_GET['productId'];
setCookie($companyId, $product_id, $cookie_most_visited, $cookie_recent_visited);
if ($companyId == 2) {
    setCookie($companyId, $product_id, $cookie_most_visited_2, $cookie_recent_visited_2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-U   A-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Product Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!--creating different sections using bootstrap grid system-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2"><h1>cookies should go here, there is no code yet!</h1></div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-9">
                    <div class="productImg">
                        <!--read the product description and its image url from SESSION and then write it on top of product review form-->
                        <?PHP
                        // $con = mysqli_connect("handsomemengzeng.com", "cmpe272", "123456", "cmpe272project");

                        //receive productId and companyId from product_session.php
                        $productId = $_GET['productId'];
                        $companyId = $_GET['companyId'];

                        //get all the product list as a 2D array from SESSION
                        $prod_list = $_SESSION['prod_list'];

                        //loop through this array and find the respective productId and companyId
                        for ($i = 0; $i < count($prod_list); $i++) {
                            if ($prod_list[$i][0] == $companyId && $prod_list[$i][1] == $productId) {
                                print("<p><img src = " . $prod_list[$i][4] . " width='250' height='250' style=\"float: left; text-align: center; margin: 0.5em; padding: 0.5em;\" />" . $prod_list[$i][3] . "</p>");
                            }
                        }

                        //close the database
                        // mysqli_close($con);
                        ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-xs-12"></div>
                        <div class="col-xs-12">
                            <h1 class="name">
                                <!--read the product name and its price from SESSION and then write it on top of add to cart button-->
                                <?PHP
                                // $con = mysqli_connect("handsomemengzeng.com", "cmpe272", "123456", "cmpe272project");

                                //receive productId and companyId from product_session.php
                                $productId = $_GET['productId'];
                                $companyId = $_GET['companyId'];

                                //get all the product list as a 2D array from SESSION
                                $prod_list = $_SESSION['prod_list'];

                                //loop through this array and find the respective productId and companyId
                                for ($i = 0; $i < count($prod_list); $i++) {
                                    if ($prod_list[$i][0] == $companyId && $prod_list[$i][1] == $productId) {
                                        print($prod_list[$i][2]);
                                        print("<br>");
                                        print($prod_list[$i][5] . " USD");
                                    }
                                }

                                //close the database
                                // mysqli_close($con);
                                ?>
                            </h1>
                        </div>
                        <div class="col-xs-12"><br>
                            <button class="btn btn-primary btn-sm" type="submit" value="Add" id="addCart">
                                <span class="glyphicon glyphicon-shopping-cart" id="shoppingCart"></span><span>Add to cart</span>
                                <!--sending all the information of the product as an array to product_addCart.js-->
                                <?PHP
                                //receive productId and companyId from product_session.php
                                $productId = $_GET['productId'];
                                $companyId = $_GET['companyId'];

                                //get all the product list as a 2D array from SESSION
                                $prod_list = $_SESSION['prod_list'];

                                //loop through this array and find the respective productId and companyId
                                for ($i = 0; $i < count($prod_list); $i++) {
                                    if ($prod_list[$i][0] == $companyId && $prod_list[$i][1] == $productId) {
                                        $company_id = $prod_list[$i][0];
                                        $prod_id = $prod_list[$i][1];
                                        $prod_name = $prod_list[$i][2];
                                        $prod_description = $prod_list[$i][3];
                                        $prod_image_url = $prod_list[$i][4];
                                        $prod_price = $prod_list[$i][5];
                                    }
                                }
                                //test
                                /*$company_id = 1;
                                $prod_id = 2;
                                $prod_name = 3;
                                $prod_description = 4;
                                $prod_image_url = 5;
                                $prod_price = 6;*/
                                ?>
                            </button>
                            <script type="text/javascript">
                                var company_id = "<?PHP echo $company_id; ?>";
                                var prod_id = "<?PHP echo $prod_id; ?>";
                                var prod_name = "<?PHP echo $prod_name; ?>";
                                var prod_description = "<?PHP echo $prod_description; ?>";
                                var prod_image_url = "<?PHP echo $prod_image_url; ?>";
                                var prod_price = "<?PHP echo $prod_price; ?>";
                            </script>
                            <script src="script/product_addCart.js" type="text/javascript"></script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <form method="post" action="product_review.php">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="user ID" required><br>
                            <textarea class="form-control" name="review" cols="40" rows="5" required
                                      placeholder="Write your review up to 500 characters"></textarea>
                        </div>
                        <input class="btn btn-primary btn-md" type="submit" value="Submit Review">
                    </form>
                </div>
                <div class="col-sm-5"><h1>How Many Stars You Give Me?</h1>
                    <div>
                        <span class="glyphicon glyphicon-star" id="r6"></span>
                        <span class="glyphicon glyphicon-star" id="r7"></span>
                        <span class="glyphicon glyphicon-star" id="r8"></span>
                        <span class="glyphicon glyphicon-star" id="r9"></span>
                        <span class="glyphicon glyphicon-star" id="r10"></span>
                    </div>
                    <div><h4 class="rateSlideDown"></h4></div>
                    <div>
                        <input class="btn btn-primary btn-lg" id="btnRate" type="submit" value="Rate">
                    </div>
                    <script src="script/product_userRating.js" type="text/javascript"></script>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
        </div>
        <div class="col-xs-2">
            <label for="comment">Reviews:</label>
            <textarea class="form-control" rows="30" id="comment">
            <?PHP
            $con = mysqli_connect("handsomemengzeng.com", "cmpe272", "123456", "cmpe272project");

            //receive productId and companyId from product_session.php
            $productId = $_GET['productId'];
            $companyId = $_GET['companyId'];

            //check if its connected
            if (!$con) {
                die("connection to the server error!");
            } else {
                //query all reviews about this product
                $product_sql = "SELECT userId, rating, review FROM ProductReview WHERE productId = $productId AND companyId = $companyId";
                $product_result = mysqli_query($con, $product_sql);
                for ($counter = 0; $row = mysqli_fetch_row($product_result); $counter++) {
                    foreach ($row as $key => $value) {
                        print("$value");
                        print("<br>");
                    }
                    print("<br>");
                }
            }
            //close the database
            mysqli_close($con);
            ?>
          </textarea>
        </div>
    </div>
</div>
</body>
</html>
