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

		$ciphering = "AES-128-CTR";
		$encryption_key = "Alaska";
		$options = 0;
		$encryption_iv = '1234567891011121';
		
		$encryption = openssl_encrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);

		return $encryption;

	}

	static function decrypt($data) {

		$ciphering = "AES-128-CTR";
		$decryption_key = "Alaska";
		$options = 0;
		$decryption_iv = '1234567891011121';
		
		$decryption = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);

		return $decryption;

	}
}