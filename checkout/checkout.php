<?php include '../connect/connect.php' ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="checkout.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Checkout</title>

    <script type="text/javascript">
        function removeItem(comId, prodId) {
            $(function () {
                console.log(prodId);
                $.post("removeItem.php", {comId: comId, prodId: prodId}, function (result) {
                    console.log(result);
                    location.reload();
                });
            });
        }
    </script>

</head>
<body>

<!-------------this is temp code to test paypal payment --------------------->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th> </th>
                    <th> </th>
                    <th class="text-center">Price</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $sub_total = 0;
                $products = array();
                foreach ($_SESSION['cart'] as $index => $item) {
                    ?>
                    <tr>
                        <td class="col-sm-12 col-md-10">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                              src="<?php echo($item[4]) ?>"
                                                                              style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo($item[2]) ?></h4>
                                    <h5 class="media-heading"><?php echo($item[3]) ?></h5>
                                </div>
                            </div>
                        </td>

                        <td class="col-sm-1 col-md-1"></td>
                        <td class="col-sm-1 col-md-1"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo($item[5]) ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                            <button type="button"
                                    onclick="removeItem(<?php echo($item[0]); ?>, <?php echo($item[1]); ?>)"
                                    class="btn btn-danger">
                                <i class="glyphicon glyphicon-remove"></i>Remove
                            </button>
                        </td>
                    </tr>

                    <?php
                    $sub_total += $item[5];
                    $prod_item = array('companyId' => $item[0], 'id' => $item[1], 'name' => $item[2], 'des' => $item[3], 'price' => $item[5]);
                    array_push($products, $prod_item);
                }

                $tax = $sub_total * 7.5 / 100;
                $total = $sub_total + $tax;
                ?>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td><h5>Subtotal</h5></td>
                    <td class="text-right"><h5><strong>$<?php echo($sub_total) ?></strong></h5></td>
                </tr>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td><h5>Tax</h5></td>
                    <td class="text-right"><h5><strong>$<?php echo(round($tax, 2)) ?></strong></h5></td>
                </tr>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>$<?php echo(round($total, 2)) ?></strong></h3></td>
                </tr>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>
                        <a href="../index.php" type="button" class="btn btn-default">
                            <i class="glyphicon glyphicon-shopping-cart"></i>Continue Shopping
                        </a>
                    </td>
                    <td>
                        <a href="CreatePaymentUsingPaypal.php">
                            <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"/>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$_SESSION['products_to_checkout'] = $products;
$_SESSION['products_to_checkout_tax'] = $tax;
$_SESSION['products_to_checkout_subtotal'] = $sub_total;
$_SESSION['products_to_checkout_total'] = $total;
?>

<?php

//$query = "SELECT * FROM ProductAverageRating ";
//$result = $conn->query($query);
//
//if ($result->num_rows > 0) {
//    while ($row = $result->fetch_assoc()) {
//        echo('-------' . $row);
//    }
//}

//print_r($_SESSION['prod_list'][0]);

?>

</body>
</html>