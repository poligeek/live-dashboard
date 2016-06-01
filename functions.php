<?php
	
$members = array('adhumi', 'borosch', 'captainliban', 'ooalex');

function mainRow($token, $user)
{
	$wantToSpeak = "Je veux intervenir.";
	$next = "Il faut enchainer.";
	
	return "<div class=\"panel panel-primary\">
				<div class=\"panel-heading\">
					<h3 class=\"panel-title\">$user</h3>
				</div>
				<div class=\"panel-body\">
					<div class=\"row\">
						<div class=\"col-md-4 col-md-offset-2\"><a class=\"btn btn-success btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=".$user."&a=beer&m=$wantToSpeak\" role=\"button\">Je veux intervenir</a></div>
						<div class=\"col-md-4\"><a class=\"btn btn-danger btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=".$user."&a=beer&m=$next\" role=\"button\">Il faut enchainer</a></div>
						
					</div>
				</div>
			</div>";
}

function adminRow($token)
{
	global $members;

    return "<div class=\"panel panel-danger\">
				<div class=\"panel-heading\">
					<h3 class=\"panel-title\">Prochaine intervention</h3>
				</div>
				<div class=\"panel-body\">
					<div class=\"row\">
						<div class=\"col-md-3\"><a class=\"btn btn-info btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=Modérateur&a=soon&m=".nextSpeakerMessage($members[0])."\" role=\"button\">$members[0]</a></div>
						<div class=\"col-md-3\"><a class=\"btn btn-info btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=Modérateur&a=soon&m=".nextSpeakerMessage($members[1])."\" role=\"button\">$members[1]</a></div>
						<div class=\"col-md-3\"><a class=\"btn btn-info btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=Modérateur&a=soon&m=".nextSpeakerMessage($members[2])."\" role=\"button\">$members[2]</a></div>
						<div class=\"col-md-3\"><a class=\"btn btn-info btn-lg btn-block btn-xlg\" href=\"/send.php?t=".urlencode($token)."&u=Modérateur&a=soon&m=".nextSpeakerMessage($members[3])."\" role=\"button\">$members[3]</a></div>
					</div>
				</div>
			</div>";
}

function nextSpeakerMessage($user)
{
	return "<@" . $user . "> prend la parole après cette intervention.";
}

function sendToSlack($token, $user, $avatar, $message)
{
	$url = 'https://hooks.slack.com/services/'.$token;
	$ch = curl_init($url);
	
	$payload = array(
		'username' => $user,
		'icon_emoji' => ':'.$avatar.':',
		'text' => $message
	);
	
	$jsonDataEncoded = json_encode($payload);
	
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
	
	$result = curl_exec($ch);
}

?>
