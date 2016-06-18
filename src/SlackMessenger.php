<?php

class SlackMessenger {
	const BASE_URL = 'https://hooks.slack.com/services/';
	
	var $token;
	var $user;
	
	function __construct($token, $user) {
        $this->token = $token;
        $this->user = $user;
    }
    
    function hookURL() {
	    return $this::BASE_URL . $this->token;
    }
	
	function sendUserMessage($message) {
		$payload = array(
			'username' => $this->user->handle,
			'icon_url' => $this->user->avatarURL(),
			'text' => $message
		);
	
		$this->sendPayload($payload);
	}
	
	function sendGenericMessage($message, $username, $emoji) {
		$payload = array(
			'username' => $username,
			'icon_emoji' => ":" . $emoji . ":",
			'text' => $message
		);
	
		$this->sendPayload($payload);
	}
	
	private function sendPayload($payload) {	
		$ch = curl_init($this->hookURL());
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_exec($ch);
	}
}
	
?>