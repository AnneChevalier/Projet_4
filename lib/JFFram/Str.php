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

	static function formatFileName($file) {

		$file = strtr($file,
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$date = date("Y-m-d_H:i:s");
		$file = $date . $file;
		$file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);

		return $file;
	}

	static function secured($data) {

		return htmlspecialchars($data);
	}

	static function encrypt($data) {

		return openssl_encrypt($data, "AES-128-ECB", "alaska");

	}

	static function decrypt($data) {

		return openssl_decrypt($data, "AES-128-ECB", "alaska");
	}
}