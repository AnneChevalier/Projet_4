<?php

namespace JFFram;

class Autoloader {
	
	static function autoload($className) {

		$parts = explode('\\', $className);
    	$class = end($parts) . '.php';

		if (file_exists($file = __DIR__ . '\\' . $class)) {
			
			require $file;
		}

	}

	static function register() {
		
		spl_autoload_register(array("JFFram\Autoloader", 'autoload'));
	}
}