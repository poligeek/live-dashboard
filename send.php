<?php

require_once 'src/SlackMessenger.php';
require_once 'src/Config.php';

$user = Config::users()[$_GET["user"]];
$messenger = new SlackMessenger($_GET["token"], $user);
$type = $_GET["type"];

if ($type == 'user') {
	$message = $_GET["message"];
	$messenger->sendUserMessage($message);
} elseif ($type == 'generic') {
	$emoji = urldecode($_GET["emoji"]);
	$username = $_GET["username"];
	$message = $_GET["message"];
	$messenger->sendGenericMessage($message, $username, $emoji);
}

?>
