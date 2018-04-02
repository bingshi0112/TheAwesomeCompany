<?php
session_start();

$servername = "handsomemengzeng.com";
$username = "cmpe272";
$password = "123456";
$dbname = "cmpe272project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>