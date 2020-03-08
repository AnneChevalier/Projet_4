<?php

namespace JFFram;

class Str {
	
	static function random($length) {

		$alphabet = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";

		return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
		
	}

	static function hashPassword($password) {

		return password_hash($password, PASSWORD_BCRYPT);

	}
}