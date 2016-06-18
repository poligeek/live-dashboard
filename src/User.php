<?php

class User {
	var $handle;
	var $isModerator;
	
	function __construct($handle, $isModerator = false) {
        $this->handle = $handle;
        $this->isModerator = $isModerator;
    }
    
    function avatarURL() {
	    return 'http://dashboard.live.poligeek.fr/assets/' . $this->handle . '.jpg';
    }
}
	
?>
