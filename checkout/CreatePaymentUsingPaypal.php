<?php
include '../connect/connect.php';
require '../checkout/bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$products = $_SESSION['products_to_checkout'];

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$sub_total = $_SESSION['products_to_checkout_subtotal'];
$tax = $_SESSION['products_to_checkout_tax'];
$total = $_SESSION['products_to_checkout_total'];

$items = array();
foreach ($products as $index => $product) {
    $item = new Item();
    $item->setName($product['name'])
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku($product['id'])// Similar to `item_number` in Classic API
        ->setPrice($product['price']);
    array_push($items, $item);
}

$itemList = new ItemList();
$itemList->setItems($items);

$details = new Details();
$details->setShipping(0)
    ->setTax($tax)
    ->setSubtotal($sub_total);

$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

function getBaseUrl()
{
    if (PHP_SAPI == 'cli') {
        $trace = debug_backtrace();
        $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
        echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
        return "http://localhost" . $relativePath;
    }
    $protocol = 'http';
    $host = $_SERVER['HTTP_HOST'];
    $request = $_SERVER['PHP_SELF'];
    return dirname($protocol . '://' . $host . $request);
}

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
    ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($apiContext);
    $paypalRedirectUrls = $payment->links[1]->href;
    header('Location:' . $paypalRedirectUrls . ');');
} catch (Exception $ex) {
    print("Created Payment Using PayPal. Please visit the URL to Approve." . "Payment" . $request . $ex);
    exit(1);
}
