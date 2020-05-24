<?php

namespace JFFram;

use \PDO;

class Database {

	private $pdo;

	public function __construct($login, $password, $database_name, $host = 'localhost') {

		try {
			$this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);

			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

		} catch(Exception $e) {

			echo $e->errorMessage();
		}

	}
	
	public function query($query, $params = []) {

		$req = $this->pdo->prepare($query);

		$req->execute($params);

		return $req;

	}

}