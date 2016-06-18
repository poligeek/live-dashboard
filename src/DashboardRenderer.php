<?php

require_once 'Config.php';

class DashboardRenderer {
	var $user;
	var $token;
	
	function __construct($get) {
		if (empty($get["u"])) {
			throw new Exception('Missing user');
		}
		if (!array_key_exists($get["u"], Config::users())) {
			throw new Exception('Unknown user "' . $get["u"] . '"');
		}
		if (empty($get["t"])) {
			throw new Exception('Missing token');
		}
		
		$this->user = Config::users()[$get["u"]];
		$this->token = $get["t"];
	}
	
	function dashboard() {
		$content = $this->mainRow();
		if ($this->user->isModerator) {
			$content .= $this->hostRow();
		}
		return $content;
	}
	
	function mainRow() {
		$wantToSpeak = ":raising_hand: Je veux intervenir.";
		$next = ":warning: Il faut enchainer.";
	
		return "<div class=\"panel panel-default\">
					<div class=\"panel-heading\">
						<h3 class=\"panel-title\">" . $this->user->handle . "</h3>
					</div>
					<div class=\"panel-body\">
						<div class=\"row\">
							<div class=\"col-md-4 col-md-offset-2\"><a class=\"btn btn-success btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?type=user&token=".urlencode($this->token)."&user=".$this->user->handle."&message=".$wantToSpeak."')\" role=\"button\">Je veux intervenir</a></div>
							<div class=\"col-md-4\"><a class=\"btn btn-danger btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?type=user&token=".urlencode($this->token)."&user=".$this->user->handle."&message=$next')\" role=\"button\">Il faut enchainer</a></div>
						</div>
					</div>
				</div>";
	}
	
	function hostRow() {
	    $row = "<div class=\"panel panel-danger\">
				<div class=\"panel-heading\">
					<h3 class=\"panel-title\">Prochaine intervention</h3>
				</div>
				<div class=\"panel-body\">
					<div class=\"row\">";
		
		foreach (Config::users() as $key => $user) {
			$row .= "<div class=\"col-md-3\">".$this->nextSpeakerButton($user)."</div>";
		}
		
		$row .= "				</div>
				</div>
			</div>";
			
		return $row;
	}
	
	private function nextSpeakerButton($user) {
		return "<a class=\"btn btn-default btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?type=generic&token=" . urlencode($this->token) . "&username=Modérateur&emoji=soon&user=" . $this->user->handle . "&message=<@" . $user->handle . "> prend la parole après cette intervention.')\" role=\"button\">" . $user->handle . "</a>";
	}

	static function exception_handler($exception) {
		echo "<!DOCTYPE html>
<html>
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">

		<title>Dashboard Poligeek</title>

		<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
		<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
		<link rel=\"stylesheet\" href=\"css/animated.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
	</head>
	<body>
		<div class=\"container-fluid\">
			<div class=\"row\">
				<div class=\"col-md-12\">
					<h1>Access denied</h1>
					<p>" . $exception->getMessage() . "</p>
				</div>
			</div>
		</div>
	</body>
</html>";
	}
}
	
?>
	