<?php include './connect/connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <title>The Awesome Company</title>
</head>
<body>
<nav lass="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <ul class="menu">
            <li><a class="iconic home" href="./index.php">The Awesome Company</a></li>
            <li>
                <?php
                $companyPage = "company/company.php";
                ?>
                <a>Company A<span class="iconic"></span></a>
                <ul>
                    <?php
                    $companyInfo = $companyPage . "?companyId=1&";
                    ?>
                    <li><a href="<?php echo $companyInfo . 'sorting=1' ?>">Best Seller</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=2' ?>">Highest Rated</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=3' ?>">Most visited</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=4' ?>">Recent visited</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=5' ?>">All Products</a></li>
                </ul>
            </li>
            <li>
                <a>Company B<span class="iconic"></span></a>
                <ul>
                    <?php
                    $companyInfo = $companyPage . "?companyId=2&";
                    ?>
                    <li><a href="<?php echo $companyInfo . 'sorting=1' ?>">Best Seller</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=2' ?>">Highest Rated</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=3' ?>">Most visited</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=4' ?>">Recent visited</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=5' ?>">All Products</a></li>
                </ul>
            </li>
            <li>
                <a>Company C<span class="iconic"></span></a>
                <ul>
                    <?php
                    $companyInfo = $companyPage . "?companyId=3&";
                    ?>
                    <li><a href="<?php echo $companyInfo . 'sorting=1' ?>">Best Seller</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=2' ?>">Highest Rated</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=3' ?>">Most visited</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=4' ?>">Recent visited</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=5' ?>">All Products</a></li>
                </ul>
            </li>
            <li>
                <a>Company D<span class="iconic"></span></a>
                <ul>
                    <?php
                    $companyInfo = $companyPage . "?companyId=4&";
                    ?>
                    <li><a href="<?php echo $companyInfo . 'sorting=1' ?>">Best Seller</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=2' ?>">Highest Rated</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=3' ?>">Most visited</a></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=4' ?>">Recent visited</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $companyInfo . 'sorting=5' ?>">All Products</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <a href="checkout/checkout.php">
                <img class="nav-cart" src="http://mir-lamp.com.ua/img/cart.png" alt="cart"/>
            </a>
            <!-- facebook login -->
        </ul>
    </div>
</nav>

<!--<div class="header">-->
<!--    <p>The Awesome Company</p>-->
<!--</div>-->

<div class="container-fluid main-content">
    <div class="container-fluid">
        <!-- Rolling best selling product image -->
        <?php
        $query = "SELECT companyId, productId, COUNT(*) AS sellingCount FROM Order Group by companyId, productId Order by sellingCount DESC limit 5";
        $result = mysqli_query($conn, $query);
        $productDetailPage = "products/product.php";
        ?>
        <div class="col-xs-12 col-md-9 main-section">
            <div id="myCarousel" class="carousel slide news" data-ride="carousel" ng-controller="paginationCtrl">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php
                    // default bestSellProduct
                    $bestSellProduct = [
                        $_SESSION['prod_list'][0],
                        $_SESSION['prod_list'][1],
                        $_SESSION['prod_list'][2],
                        $_SESSION['prod_list'][3],
                        $_SESSION['prod_list'][4]
                    ];
                    for ($counter = 0; $row = mysqli_fetch_assoc($result); $counter++) {
                        $bestSellProduct[$counter] = [$row[companyId], $row[productId]];
                    }
                    for ($i = 0; $i < 5; $i++) {
                        for ($j = 0; $j < 40; $j++) {
                            if (($bestSellProduct[$i][0] == $_SESSION['prod_list'][$j][0]) && ($bestSellProduct[$i][1] == $_SESSION['prod_list'][$j][1])) {
                                $bestSellProduct[$i] = $_SESSION['prod_list'][$j];
                            }
                        }
                    }

                    for ($s = 0; $s < 5; $s++) {
                        if ($s == 0) {
                            echo "<div class = 'item active'>";
                            $productLink = $productDetailPage . '?companyId=' . $bestSellProduct[$s][0] . '&productId=' . $bestSellProduct[$s][1];
                            echo "<a href = '$productLink' >";
                            ?>
                            <img src='<?php echo $bestSellProduct[$s][4] ?>'
                                 alt='<?php echo $bestSellProduct[$s][2] ?>'/>
                            <?php
                            echo "</a>";
                            echo "<div class = 'news-title-concise'>";
                            ?>
                            <h1><?php echo $bestSellProduct[$s][2] ?> ($<?php echo $bestSellProduct[$s][5] ?>)</h1>
                            <?php
                            echo "</div>";
                            echo "</div>";

                        } else {
                            echo "<div class = 'item'>";
                            $productLink = $productDetailPage . '?companyId=' . $bestSellProduct[$s][0] . '&productId=' . $bestSellProduct[$s][1];
                            echo "<a href = '$productLink' >";
                            ?>
                            <img src='<?php echo $bestSellProduct[$s][4] ?>'
                                 alt='<?php echo $bestSellProduct[$s][2] ?>'/>
                            <?php
                            echo "</a>";
                            echo "<div class = 'news-title-concise'>";
                            ?>
                            <h1><?php echo $bestSellProduct[$s][2] ?> ($<?php echo $bestSellProduct[$s][5] ?>)</h1>
                            <?php
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- worst selling products -->
            <?php
            $query2 = "SELECT productId, companyId, COUNT(*) AS sellingCount FROM Order Group by productId, companyId Order by sellingCount ASC limit 5";
            $result = mysqli_query($conn, $query2);
            $productDetailPage = "products/product.php";
            ?>
            <div class="product-row">
                <span>Our featured products</span>
                <div>
                    <?php
                    // default worstSellProduct
                    $worstSellProduct = [
                        $_SESSION['prod_list'][0],
                        $_SESSION['prod_list'][1],
                        $_SESSION['prod_list'][2],
                        $_SESSION['prod_list'][3],
                        $_SESSION['prod_list'][4]
                    ];
                    for ($counter = 0; $row = mysqli_fetch_assoc($result); $counter++) {
                        $worstSellProduct[$counter] = [$row[companyId], $row[productId]];
                    }
                    for ($i = 0; $i < 5; $i++) {
                        for ($j = 0; $j < 40; $j++) {
                            if (($worstSellProduct[$i][0] == $_SESSION['prod_list'][$j][0]) && ($worstSellProduct[$i][1] == $_SESSION['prod_list'][$j][1])) {
                                $worstSellProduct[$i] = $_SESSION['prod_list'][$j];
                            }
                        }
                    }

                    for ($s = 0; $s < 5; $s++) {
                        echo "<div class = 'row-block'>";
                        $productLink = $productDetailPage . '?companyId=' . $worstSellProduct[$s][0] . '&productId=' . $worstSellProduct[$s][1];
                        echo "<a href = '$productLink' >";
                        ?>
                        <img src='<?php echo $worstSellProduct[$s][4] ?>' alt='<?php echo $worstSellProduct[$s][2] ?>'/>
                        <span><?php echo $worstSellProduct[$s][2] ?>($<?php echo $worstSellProduct[$s][5] ?>)</span>
                        <?php
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <!-- most viewed products -->
            <div class="product-row">
                <?php
                // default mostViewedProduct
                $mostViewedProduct = [
                    $_SESSION['prod_list'][0],
                    $_SESSION['prod_list'][1],
                    $_SESSION['prod_list'][2],
                    $_SESSION['prod_list'][3],
                    $_SESSION['prod_list'][4]
                ];
                $mostViewedProduct = json_decode($_COOKIE[$cookie_most_visited], true);
                arsort($mostViewedProduct);
                $mostViewedProduct = array_slice($mostViewedProduct, 0, 5, true);
                $product_key = 0;
                foreach ($mostViewedProduct as $index => $value) {
                    $mostViewedProduct[$product_key] = substr($index, 2);
                    $product_key++;
                }

                foreach ($mostViewedProduct as $key => $value) {
                    $productInfo = explode("_", $value);
                    for ($j = 0; $j < 40; $j++) {
                        if ($productInfo[0] == $_SESSION['prod_list'][$j][0] && $productInfo[1] == $_SESSION['prod_list'][$j][1]) {
                            $recentViewedProduct[$key] = $_SESSION['prod_list'][$j];
                        }
                    }
                }


                //        $count = 0;
                //        foreach($cookie as $key => $value)
                //        {
                //          if ( is_numeric ($value))
                //          {
                //            if($count < 5) {
                //              for($j = 0; $j < 40; $j++) {
                //                if ($key == $_SESSION['prod_list'][$j][2]) {
                //                  $mostViewedProduct[$count] = $_SESSION['prod_list'][$j];
                //                }
                //              }
                //            }
                //            else
                //              break;
                //            $count++;
                //          }
                //        }
                ?>
                <span>Most visited products</span>
                <div>
                    <?php
                    for ($s = 0;
                         $s < 5;
                         $s++) {
                        echo "<div class = 'row-block'>";
                        $productLink = $productDetailPage . '?companyId=' . $mostViewedProduct[$s][0] . '&productId=' . $mostViewedProduct[$s][1];
                        echo "<a href = '$productLink' >";
                        ?>
                        <img src='<?php echo $mostViewedProduct[$s][4] ?>'
                             alt='<?php echo $mostViewedProduct[$s][2] ?>'/>
                        <span><?php echo $mostViewedProduct[$s][2] ?>($<?php echo $mostViewedProduct[$s][5] ?>)</span>
                        <?php
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <!-- recent viewed products -->
            <div class="product-row">
                <?php
                // default mostViewedProduct
                $recentViewedProduct = [$_SESSION['prod_list'][0],
                    $_SESSION['prod_list'][1],
                    $_SESSION['prod_list'][2],
                    $_SESSION['prod_list'][3],
                    $_SESSION['prod_list'][4]];
                $recentViewedProduct = json_decode($_COOKIE[$cookie_recent_visited], false);
                //            $recentviews = array_reverse($recentviews);
                foreach ($recentViewedProduct as $key => $value) {
                    $productInfo = explode("_", $value);
                    for ($j = 0;
                         $j < 40;
                         $j++) {
                        if ($productInfo[0] == $_SESSION['prod_list'][$j][0] && $productInfo[1] == $_SESSION['prod_list'][$j][1]) {
                            $recentViewedProduct[$key] = $_SESSION['prod_list'][$j];
                        }
                    }
                }
                ?>
                <span>Recent visited products</span>
                <div>
                    <?php
                    for ($s = 0;
                         $s < 5;
                         $s++) {
                        echo "<div class = 'row-block'>";
                        $productLink = $productDetailPage . '?companyId=' . $recentViewedProduct[$s][0] . '&productId=' . $recentViewedProduct[$s][1];
                        echo "<a href = '$productLink' >";
                        ?>
                        <img src='<?php echo $recentViewedProduct[$s][4] ?>'
                             alt='<?php echo $recentViewedProduct[$s][2] ?>'/>
                        <span><?php echo $recentViewedProduct[$s][2] ?>($<?php echo $recentViewedProduct[$s][5] ?>
                            )</span>
                        <?php
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- right bar highest rated product -->
        <div class="col-xs-12 col-md-3 product-column">
            <span>Highest rated products</span>
            <?php
            $query3 = "SELECT productId, companyId FROM ProductAverageRating Order by averageRating DESC limit 5";
            $result = mysqli_query($conn, $query3);
            $productDetailPage = "products/product.php";
            // default highestRatedProduct
            $highestRatedProduct = [$_SESSION['prod_list'][0],
                $_SESSION['prod_list'][1],
                $_SESSION['prod_list'][2],
                $_SESSION['prod_list'][3],
                $_SESSION['prod_list'][4]];
            for ($counter = 0;
                 $row = mysqli_fetch_assoc($result);
                 $counter++) {
                $highestRatedProduct[$counter] = [$row[companyId], $row[productId]];
            }
            for ($i = 0;
                 $i < 5;
                 $i++) {
                for ($j = 0;
                     $j < 40;
                     $j++) {
                    if (($highestRatedProduct[$i][0] == $_SESSION['prod_list'][$j][0]) && ($highestRatedProduct[$i][1] == $_SESSION['prod_list'][$j][1])) {
                        $highestRatedProduct[$i] = $_SESSION['prod_list'][$j];
                    }
                }
            }

            for ($s = 0;
                 $s < 5;
                 $s++) {
                echo "<div class = 'image-block'>";
                $productLink = $productDetailPage . '?companyId=' . $highestRatedProduct[$s][0] . '&productId=' . $highestRatedProduct[$s][1];
                echo "<a href = '$productLink' >";
                ?>
                <img src='<?php echo $highestRatedProduct[$s][4] ?>' alt='<?php echo $highestRatedProduct[$s][2] ?>'/>
                <span><?php echo $highestRatedProduct[$s][2] ?>($<?php echo $highestRatedProduct[$s][5] ?>)</span>
                <?php
                echo "</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Footer section -->
<footer class="footer">
    <div class="container-fluid col-xs-12 col-md-12">
        <div class="row">
            <?php
            $query4 = "SELECT * FROM Company Order by conpanyId ASC";
            $result = mysqli_query($conn, $query4);
            // default companyInfo
            $companyInfo = [['company1', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                ['company2', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                ['company3', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg'],
                ['company4', 'http://ekladata.com/hK-Z6Etp4SF1Fo8JUL2_BeCAkj0@640x486.jpg']];
            for ($counter = 0;
                 $row = mysqli_fetch_assoc($result);
                 $counter++) {
                $companyInfo[$counter] = [$row[companhName], $row[companyLink]];
            }
            for ($s = 0;
            $s < 4;
            $s++)
            {
            echo "<div class = 'col-xs-6 col-md-3'>";
            ?>
            <h5><?php echo $companyInfo[$s][0] ?></h5>
            <ul>
                <li><a href='<?php echo $companyInfo[$s][1] ?>'>Link to <?php echo $companyInfo[$s][0] ?></a></li>
            </ul>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="copyright">
        <h5>Copyright @ 2016 Mengzeng Rao, Adel Sadrolgharavi, Bing Shi, Lam Tran</h5>
    </div>
</footer>

</body>
</html>
