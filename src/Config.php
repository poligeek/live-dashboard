<?php

require_once 'User.php';

class Config {
	static function users () {
		return [
			'adhumi' 		=> new User('adhumi', true), 
			'borosch' 		=> new User('borosch'), 
			'captainliban' 	=> new User('captainliban'), 
			'ooalex' 		=> new User('ooalex')
		];
	}
}
	
?>