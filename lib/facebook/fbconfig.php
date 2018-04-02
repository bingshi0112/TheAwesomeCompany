<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
//require_once 'functions.php';
//require_once 'dbconfig.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '219632221809156','2a4aaed1bc3c39da2862f4b94f2a47e5' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://market.handsomemengzeng.com/facebook/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
//$request = new FacebookRequest( $session, 'GET', '/me' );
  $request = new FacebookRequest( $session, 'GET', '/me?fields=name,email' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	  $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	   $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
       $_SESSION['FULLNAME'] = $fbfullname;
	$_SESSION['EMAIL'] =  $femail;
	
	//checkuser($fbid,$fbfullfname,$femail);
	//session_start();
$servername = "handsomemengzeng.com";
$username = "cmpe272";
$password = "123456";
$dbname = "cmpe272project";
$database = mysqli_connect($servername, $username, $password, $dbname);
	if (! $database ) {
		echo "open database error.";
	}
$sql_store = "INSERT INTO cmpe272project.USER (userId,userName,userEmail) VALUES ('$fbid','$fbfullname','$femail')";
//echo "$sql_store";
if(mysqli_query($database, $sql_store)){
	header("Location:index.php");
}
  header("Location:index.php");
} else {
 $loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
 header("Location: ".$loginUrl);
}
		
?>