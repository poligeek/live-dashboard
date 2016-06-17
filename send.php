<?php

include 'functions.php';

$token = $_GET["t"];
$user = $_GET["u"];
$avatar = urldecode($_GET["a"]);
$message = $_GET["m"];

sendToSlack($token, $user, $avatar, $message);

?>
