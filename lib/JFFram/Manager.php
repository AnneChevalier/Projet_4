<?php

namespace JFFram;

class Manager {
	
	static $db = null;
	
	static function getDatabase() {

		if (!self::$db) {

			self::$db = new Database('root', '', 'jfwebsite');
		}

		return self::$db;

	}
}