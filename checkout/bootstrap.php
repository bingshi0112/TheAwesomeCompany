<?php
$composerAutoload = '../lib/PayPal-PHP-SDK/autoload.php';
require $composerAutoload;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

date_default_timezone_set(@date_default_timezone_get());

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Replace these values by entering your own ClientId and Secret by visiting https://developer.paypal.com/developer/applications/
// Account: lam.hillsdale-facilitator@hotmail.com
$clientId = 'Ab3CkqACD2qwtF8m-EXGOLB4j1FiHozniCYbKidFUFESeeRYW6l2LgVPSIMIZyNixw_N7fvFosHdaFuw';
$clientSecret = 'EFAY5VC83zVpdtuWfel9kYHDTSNarFriIjiYBdZ42ksXyQJFDjBZcLXqpixSwYane2gqTnn5Euuivdjf';

/** @var \Paypal\Rest\ApiContext $apiContext */
$apiContext = getApiContext($clientId, $clientSecret);

return $apiContext;

/**
 * Helper method for getting an APIContext for all calls
 * @param string $clientId Client ID
 * @param string $clientSecret Client Secret
 * @return PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret)
{

    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG',
            'cache.enabled' => true,
        )
    );

    return $apiContext;
}