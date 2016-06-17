<?php

$members = array('adhumi', 'borosch', 'captainliban', 'ooalex');

function mainRow($token, $user)
{
	$wantToSpeak = ":raising_hand: Je veux intervenir.";
	$next = ":warning: Il faut enchainer.";

	return "<div class=\"panel panel-default\">
				<div class=\"panel-heading\">
					<h3 class=\"panel-title\">$user</h3>
				</div>
				<div class=\"panel-body\">
					<div class=\"row\">
						<div class=\"col-md-4 col-md-offset-2\"><a class=\"btn btn-success btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?t=".urlencode($token)."&u=".$user."&a=beer&m=$wantToSpeak')\" role=\"button\">Je veux intervenir</a></div>
						<div class=\"col-md-4\"><a class=\"btn btn-danger btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?t=".urlencode($token)."&u=".$user."&a=beer&m=$next')\" role=\"button\">Il faut enchainer</a></div>
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
						<div class=\"col-md-3\">".nextSpeakerButton($members[0], $token)."</div>
						<div class=\"col-md-3\">".nextSpeakerButton($members[1], $token)."</div>
						<div class=\"col-md-3\">".nextSpeakerButton($members[2], $token)."</div>
						<div class=\"col-md-3\">".nextSpeakerButton($members[3], $token)."</div>
					</div>
				</div>
			</div>";
}

function nextSpeakerButton($user, $token)
{
	return "<a class=\"btn btn-default btn-lg btn-block btn-xlg\" href=\"javascript:void(0)\" onClick=\"$.ajax('/send.php?t=".urlencode($token)."&u=Modérateur&a=soon&m=".nextSpeakerMessage($user)."')\" role=\"button\">$user</a>";
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
