<?php

/*namespace Controller\Frontend;*/

require './App/Model/UserManager.php';

use JFFram\Session;
use JFFram\Controller;
use Model\UserManager;
use JFFram\Manager;

class LoginController extends Controller {
	
	public function login() {

		$db = Manager::getDatabase();
		$manager = new UserManager();

		if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {

			$user = $manager->login($db, $_POST['email'], $_POST['password']);

			$session = Session::getInstance();

			if($user) {

				$session->setFlash('success', "Vous êtes connecté.");

				header('Location: ./index.php');

			} else {

				$session->setFlash('danger', "Identifiant ou mot de passe incorrecte.");

			}
			
		}
	}


	public function user() {

		if (!$this->session->read('auth')) {

			return false;

		}

		return $this->session->read('auth');

	}

}

?>