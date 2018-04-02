<?php include '../connect/connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Company</title>
    <!-- read cookie -->
    <?php
    $cookie = $_COOKIE;
    $recentviews = $_COOKIE['recentviews'];
    $recentviews = json_decode ($recentviews, true);
    $companyPage = "company.php";
    $productDetailPage = "../products/product.php";
    ?>
</head>
<body>
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=219632221809156";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Top most nav bar -->
<nav lass="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Home</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <a href="../checkout/checkout.php">
                <img class="nav-cart"  src="http://mir-lamp.com.ua/img/cart.png" alt="cart"/>
            </a>
            <!-- facebook login -->
        </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- End of top most nav bar -->
<!-- company title -->
<div class="header">
    <p>Company <?php echo $_GET['companyId'] ?></p>
</div>
<div class="fb-like" data-href="http://market.handsomemengzeng.com" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
<div class="container-fluid main-content"><ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="active">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Company A<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                $companyInfo = $companyPage . "?companyId=1&";
                ?>
                <li><a href="<?php echo $companyInfo.'sorting=1'?>">Best Seller</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=2'?>">Highest Rated</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=3'?>">Most visited</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=4'?>">Recent visited</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $companyInfo.'sorting=5'?>">All Products</a></li>
            </ul>
        </li>

        <li role="presentation">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Company B<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                $companyInfo = $companyPage . "?companyId=2&";
                ?>
                <li><a href="<?php echo $companyInfo.'sorting=1'?>">Best Seller</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=2'?>">Highest Rated</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=3'?>">Most visited</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=4'?>">Recent visited</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $companyInfo.'sorting=5'?>">All Products</a></li>
            </ul>
        </li>
        <li role="presentation">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Company C<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                $companyInfo = $companyPage . "?companyId=3&";
                ?>
                <li><a href="<?php echo $companyInfo.'sorting=1'?>">Best Seller</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=2'?>">Highest Rated</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=3'?>">Most visited</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=4'?>">Recent visited</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $companyInfo.'sorting=5'?>">All Products</a></li>
            </ul>
        </li>
        <li role="presentation">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Company D<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                $companyInfo = $companyPage . "?companyId=4&";
                ?>
                <li><a href="<?php echo $companyInfo.'sorting=1'?>">Best Seller</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=2'?>">Highest Rated</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=3'?>">Most visited</a></li>
                <li><a href="<?php echo $companyInfo.'sorting=4'?>">Recent visited</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $companyInfo.'sorting=5'?>">All Products</a></li>
            </ul>
        </li>
    </ul>

    <div class="container-fluid">

        <div class="col-xs-12 col-md-8 main-section" >
             <!-- sorted products -->
            <?php
            $company = $_GET['companyId'];
            $sort = $_GET['sorting'];
            //default
            $products = [
                $_SESSION['prod_list'][0],
                $_SESSION['prod_list'][1],
                $_SESSION['prod_list'][2],
                $_SESSION['prod_list'][3],
                $_SESSION['prod_list'][4],
                $_SESSION['prod_list'][5],
                $_SESSION['prod_list'][6],
                $_SESSION['prod_list'][7],
                $_SESSION['prod_list'][8],
                $_SESSION['prod_list'][9]
            ];
            $counter = 10;
            ?>
            <div class = >
<!--            <div class = "product-row">-->
                <?php
                    switch($sort)
                    {
                        case 1:
                            echo "<span>Best Selling Products</span>";
                            echo "<div>";
                            $query = "SELECT productId, companyId, COUNT(*) AS sellingCount FROM Order Group WHERE companyId=$company by productId, companyId Order by sellingCount DESC limit 9";
                            $result = mysqli_query( $conn, $query );
                            for ( $counter = 0; $row = mysqli_fetch_assoc( $result ) ; $counter++ )
                            {
//                                print($counter . '--------' .$row[companyId]);
                                $products[$counter] = [$row[companyId],$row[productId]];
                            }
                            for ($i = 0; $i < 9; $i++)
                            {
                                for($j = 0; $j < 40; $j++)
                                {
                                    if(($products[$i][0]==$_SESSION['prod_list'][$j][0]) && ($products[$i][1]==$_SESSION['prod_list'][$j][1]))
                                    {
                                        $products[$i] = $_SESSION['prod_list'][$j];
                                    }
                                }
                            }
                            break;
                        case 2:
                            echo "<span>Highest Rated Products</span>";
                            echo "<div>";
                            $query = "SELECT productId, companyId FROM ProductAverageRating WHERE companyId=$company Order by averageRating DESC limit 9";
                            $result = mysqli_query( $conn, $query );
                            for ( $counter = 0; $row = mysqli_fetch_assoc( $result ) ; $counter++ )
                            {
                                $products[$counter] = [$row[companyId],$row[productId]];
                            }
                            for ($i = 0; $i < 9; $i++)
                            {
                                for($j = 0; $j < 40; $j++)
                                {
                                    if(($products[$i][0]==$_SESSION['prod_list'][$j][0]) && ($products[$i][1]==$_SESSION['prod_list'][$j][1]))
                                    {
                                        $products[$i] = $_SESSION['prod_list'][$j];
                                    }
                                }
                            }
                            break;
                        case 3:
                            echo "<span>Most Visited Products</span>";
                            echo "<div>";
                            arsort($cookie);
                            $counter = 0;
                            foreach($cookie as $key => $value)
                            {
                                if ( is_numeric ($value))
                                {
                                    if($counter < 9) {
                                        for($j = 0; $j < 40; $j++) {
                                            if (($key == $_SESSION['prod_list'][$j][2]) && ($_SESSION['prod_list'][$j][0] == $company)) {
                                                $products[$counter] = $_SESSION['prod_list'][$j];
                                            }
                                        }
                                    }
                                    else
                                        break;
                                    $counter++;
                                }
                            }
                            break;
                        case 4:
                            echo "<span>Recent Visited Products</span>";
                            echo "<div>";
                            $recentviews = array_reverse($recentviews);
                            foreach($recentviews as $key => $value)
                            {
                                for($j = 0; $j < 40; $j++) {
                                    if (($value == $_SESSION['prod_list'][$j][2])&& ($_SESSION['prod_list'][$j][0] == $company)) {
                                        $products[$key] = $_SESSION['prod_list'][$j];
                                    }
                                }
                            }
                            $counter = count($products);
                            break;
                        case 5:
                            echo "<span>All Products</span>";
                            echo "<div>";
                            $counter = 0;
//                            for ($i = 0; $i < 10; $i++)
//                            {
//                                for($j = 0; $j < 40; $j++)
//                                {
//                                    if($_SESSION['prod_list'][$j][0] == $company)
//                                    {
//                                        $products[$i] = $_SESSION['prod_list'][$j];
//                                    }
//
//                                }
//                            }
//                            $counter =$i;
//
                            for($j = 0; $j < 40 && $counter < 10; $j++)
                                {

                                    if($_SESSION['prod_list'][$j][0] == $company)
                                    {
                                        $products[$counter] = $_SESSION['prod_list'][$j];
                                        $counter++;
                                    }
                                }

                            break;
                    }
                    for($s = 0; $s < $counter; $s++)
                    {
                        echo "<div class = 'nine-block'>";
                        $productLink = $productDetailPage .'?companyId='.$products[$s][0] .'&productId=' .$products[$s][1];
                        echo "<a href = '$productLink' >";
                        ?>
                        <img src = '<?php echo $products[$s][4] ?>' alt = '<?php echo $products[$s][2] ?>'/>
                        <span><?php echo $products[$s][2] ?>($<?php echo $products[$s][5] ?>)</span>
                        <?php
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                ?>
            </div>

        </div>
        <!-- right bar highest rated product -->
        <div class="col-xs-12 col-md-2 product-column">
            <span>Highest rated products</span>
            <?php
            $query3 = "SELECT productId, companyId FROM ProductAverageRating Order by averageRating DESC limit 5";
            $result = mysqli_query( $conn, $query3 );
            $productDetailPage = "../products/product.php";
            // default highestRatedProduct
            $highestRatedProduct = [
                $_SESSION['prod_list'][0],
                $_SESSION['prod_list'][1],
                $_SESSION['prod_list'][2],
                $_SESSION['prod_list'][3],
                $_SESSION['prod_list'][4]
            ];
            for ( $counter = 0; $row = mysqli_fetch_assoc( $result ) ; $counter++ )
            {
                $highestRatedProduct[$counter] = [$row[productId],$row[companyId]];
            }
            for ($i = 0; $i < 5; $i++)
            {
                for($j = 0; $j < 40; $j++)
                {
                    if(($highestRatedProduct[$i][0]==$_SESSION['prod_list'][$j][0]) && ($highestRatedProduct[$i][1]==$_SESSION['prod_list'][$j][1]))
                    {
                        $highestRatedProduct[$i] = $_SESSION['prod_list'][$j];
                    }
                }
            }

            for($s = 0; $s < 5; $s++)
            {
                echo "<div class = 'image-block'>";
                $productLink = $productDetailPage . '?companyId='.$highestRatedProduct[$s][0] .'&productId=' .$highestRatedProduct[$s][1];
                echo "<a href = '$productLink' >";
                ?>
                <img src = '<?php echo $highestRatedProduct[$s][4] ?>' alt = '<?php echo $highestRatedProduct[$s][2] ?>'/>
                <span><?php echo $highestRatedProduct[$s][2] ?>($<?php echo $highestRatedProduct[$s][5] ?>)</span>
                <?php
                echo "</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <!-- Footer section -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <!-- footer col1 -->
                <?php
                $query4 = "SELECT * FROM Company Order by conpanyId ASC";
                $result = mysqli_query( $conn, $query4 );
                // default companyInfo
                $companyInfo = [
                    ['company1', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                    ['company2', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                    ['company3', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                    ['company4', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg']
                ];
                for ( $counter = 0; $row = mysqli_fetch_assoc( $result ) ; $counter++ )
                {
                    $companyInfo[$counter] = [$row[companhName],$row[companyLink]];
                }

                for($s = 0; $s < 4; $s++)
                {
                echo "<div class = 'col-xs-6 col-md-3'>";
                ?>
                <h5><?php echo $companyInfo[$s][0] ?></h5>
                <ul>
                    <li><a href = '<?php echo $companyInfo[$s][1] ?>'>Link to <?php echo $companyInfo[$s][0] ?></a></li>
                </ul>
            </div>
            <?php
            }
            ?>
            <div class="col-xs-12 col-md-12 copyright">
                <h5>Copyright</h5>
            </div>
        </div>
</div>
</footer>
</div>
</body>
</html>
