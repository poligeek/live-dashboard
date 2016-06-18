<?php
require_once 'src/DashboardRenderer.php';
set_exception_handler('DashboardRenderer::exception_handler');
$renderer = new DashboardRenderer($_GET);
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
			<? echo $renderer->dashboard() ?>
		</div>
	</body>
</html>
