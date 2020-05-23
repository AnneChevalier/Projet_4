<?php

use JFFram\Session;
use JFFram\Manager;
use Model\UserManager;
use JFFram\Controller;


class LoginController extends Controller {

	public function login() {

		$db = Manager::getDatabase();
		$manger = new UserManager();

		if (!empty($_POST) && !empty($_POST['user_name']) && !empty($_POST['password'])) {

			$user = $manger->backlogin($db, $_POST['user_name'], $_POST['password']);

			$session = Session::getInstance();

			if($user && $user->admin == 1) {

				$session->setFlash('success', "Bienvenue dans l'espace administration.");

				header('Location: ./backindex.php?controller=dashboard');

			} else {

				$session->setFlash('danger', "Identifiant ou mot de passe incorrecte.");

				header('Location: ./backindex.php');

			}

			
		}

	}
	

}

 ?>