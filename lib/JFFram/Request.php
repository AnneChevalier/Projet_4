<?php

namespace JFFram;

use \Exception;

class Request {

	private $params;
	
	public function __construct($params) {
		
		$this->params = $params;

	}

	// Renvoie true si le parametre existe dans la requete
	public function existeParam($param) {

		return (isset($this->params[$param]) && $this->params[$param] != "");

	}

	// Renvoie la valeur du parmetre
	public function getParam($param) {

		if($this->existeParam($param)){

			return $this->params[$param];

		} else {

			throw new Exception("Paramètre $param absent de la requête");
			
		}
	}
}