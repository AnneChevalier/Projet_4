<?php

namespace JFFram;

use \Exception;

abstract class Controller {

	private $action;
	protected $request;
	
	public function setRequest($request) {
		
		$this->request = $request;

	}

	public function executeAction($action, $app) {

		if (method_exists($this, $action)) {
			
			$this->action = $action;
			$this->{$this->action}($app);

		} else {

			$controllerClass = get_class($this);
			throw new Exception("L'action '$action' n'est pas définie dans la classe '$controllerClass'.");
			
		}
	}

	public function show($app) {
		
		$this->generateView($app);

	}

	protected function generateView($app, $dataView = array()) {

		$controllerClass = get_class($this);
		$controller = str_replace("Controller", "", $controllerClass);

		$view = new View($this->action, $controller, $app);
		$view->generate($dataView, $app);
	}

	public function contactForm() {

		$email = 'Message de ' . $_POST['pseudo'] . '(' . $_POST['email'] . ')<br/>' . $_POST['content'];

		$retour = mail('anne.chevalier@iso.fr', 'Envoi depuis la page Contact', $email);

    	if ($retour) {

    		Session::getInstance()->setFlash('success', "Votre message a bien été envoyé.");

				header('Location: ./index.php');

    	}
	}
}