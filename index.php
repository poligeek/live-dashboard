<?php

include 'functions.php';

$hookToken = !empty($_GET["t"]) ? $_GET["t"] : "-1" ;
$isModerator = empty($_GET["admin"]) ? false : $_GET["admin"];
$user = !empty($_GET["u"]) ? $_GET["u"] : "-1";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="robots" content="noindex, nofollow">

		<title>Dashboard Poligeek</title>

		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="css/animated.css" type="text/css" media="screen" charset="utf-8">
		
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container-fluid">
		<?php
		if ($hookToken == -1 || $user == -1) {
			http_response_code(401);
		?>
			Access denied
		<?php
			} else {
				echo(mainRow($hookToken, $user));

				if ($isModerator) {
					echo(adminRow($hookToken));
				}
			}
		?>
		</div>
	</body>
</html>
