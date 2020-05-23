<?php

namespace JFFram;

class Autoloader {
	
	static function autoload($className) {

		$parts = explode('\\', $className);
		$class = end($parts) . '.php';

		if ($parts[0] == 'JFFram') {

			if (file_exists($file = __DIR__ . '\\' . $class)) {
				
				require $file;

			} else {

				echo "Le fichier " . $file . " n'existe pas.";
			}

		} elseif ($parts[0] == 'Model') {

			if (file_exists($file = "./App/Model/" . $class)) {
				
				require $file;

			} else {

				echo "Le fichier " . $file . " n'existe pas.";
			}
			
		} elseif ($parts[0] == 'Entity') {

			if (file_exists($file = "./lib/Entity/" . $class)) {
				
				require $file;

			} else {

				echo "Le fichier " . $file . " n'existe pas.";
			}
			
		} else {

			echo "Le namespace " . $parts[0] . " n'est pas défini.";
		}
		
    	

	}

	static function register() {
		
		spl_autoload_register(array("JFFram\Autoloader", 'autoload'));
	}
}