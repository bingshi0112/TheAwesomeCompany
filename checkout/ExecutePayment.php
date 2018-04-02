<?php
include '../connect/connect.php';
$success = $_GET['success'];
$paymentId = $_GET['paymentId'];
$token = $_GET['token'];
$PayerID = $_GET['PayerID'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="checkout.css" rel="stylesheet">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>The Awesome Company</title>
</head>

<body>
<?php
if ($success == 'true') {
        if (!isset($_SESSION['products_to_checkout'])) {
            header('Location: ../index.php');
        }

    ?>
    <div class="container">
        <div class="row text-size">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 ">
                        <strong>Payment Method:</strong><br>
                        Paypal<br>
                        jsmith@email.com
                    </div>
                    <div class="col-xs-6 text-right">
                        <strong>Order Date:</strong><br>
                        <?php
                        date_default_timezone_set('America/Los_Angeles');
                        echo(date("m d Y")) ?><br><br>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $sub_total = 0;
                                $products = array();
                                foreach ($_SESSION['products_to_checkout'] as $index => $item) {
                                    ?>

                                    <tr>
                                        <td><?php echo($item['name']) ?></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">$<?php echo($item['price']) ?></td>
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
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="thick-line text-right">
                                        $<?php echo($_SESSION['products_to_checkout_subtotal']) ?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Tax</strong></td>
                                    <td class="no-line text-right">
                                        $<?php echo($_SESSION['products_to_checkout_tax']) ?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">
                                        $<?php echo($_SESSION['products_to_checkout_total']) ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="text-size" href="../index.php">Return to home</a>
    </div>

    <?php
    unset($_SESSION['products_to_checkout']);
    unset($_SESSION['products_to_checkout_tax']);
    unset($_SESSION['products_to_checkout_subtotal']);
    unset($_SESSION['products_to_checkout_total']);

} else {
    header('Location: checkout.php');
}


function send_success_email($email, &$content, &$total_price)
{
    $content .= "\n \n ------------------------------------------------------------------
                  \n \t TOTAL:\t$" . $total_price;

    $api_key = "api:key-a4cd97c25f2f104df2d30dadf7a2546c";
    $ch = curl_init('https://api.mailgun.net/v3/sandbox3f14c1c2637040feaa5e6f03380863db.mailgun.org/messages');
    curl_setopt($ch, CURLOPT_USERPWD, $api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'from' => 'Awesome Market Place <admin@awesomemarket.com>',
        'to' => '<' . $email . '>',
        'subject' => 'Awesome Market Place Confirmation',
        'text' => "You already purchase: \n" . $content
    ));

    $content = null;
    curl_exec($ch);
    curl_close($ch);
}

?>
</body>
</html>

