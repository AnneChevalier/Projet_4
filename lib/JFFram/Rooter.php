<?php

namespace JFFram;

use \Exception;

class Rooter {

	private $app;

	public function __construct($app) {

		$this->app = $app; 
	}

	public function executeRequest() {

		try {

			$request = new Request(array_merge($_GET, $_POST));

			$controller = $this->createController($request);
			$action = $this->createAction($request);

			$controller->executeAction($action, $this->app);

		} catch (Exception $e) {

			$this->handleError($e);

		}
	}

	private function createController(Request $request) {

		if ($this->app == 'Frontend') {
			
			$controller = "Home";

		} elseif ($this->app == 'Backend') {

			$controller = "Login";

		} else {

			throw new Exception("L'application n'est pas définie.");

		}
		

		if ($request->existeParam('controller')) {
			
			$controller = $request->getParam('controller');
			$controller = ucfirst(strtolower($controller));
		}

		$controllerClass = $controller . "Controller";

		if ($controllerClass == 'LoginController') {
			
			Session::getInstance()->delete('auth');
		}

		$controllerFile = "./App/Controller/" . $this->app . "/" . $controllerClass . ".php";

		if (file_exists($controllerFile)) {
			
			require $controllerFile;
			$controller = new $controllerClass();
			$controller->setRequest($request);

			return $controller;

		} else {

			throw new Exception("Le fichier '$controllerFile' est introuvable.");
			
		}

	}

	private function createAction(Request $request) {

		$action = "show";

		if ($request->existeParam('action')) {
			
			$action = $request->getParam('action');

		}

		return $action;

	}

	private function handleError(Exception $exception) {



		$view = new View('show', 'error');

		$view->generate(array('ErrorMsg' => $exception->getMessage()));

	}

}