<?php

/*namespace Controller\Frontend;*/

require './App/Model/UserManager.php';

use JFFram\Controller;
use JFFram\Manager;
use Model\UserManager;
use JFFram\Str;
use JFFram\Session;

class AccountController extends Controller {

	public function show() {

		$this->restrict();
		
		$this->generateView();

	}
	
	public function changePassword() {

		$session = Session::getInstance();

		if (!empty($_POST)) {
	
			if (empty($_POST['password']) || $_POST['password'] !== $_POST['confpassword']) {
				
				$session->setFlash('danger', "Les mots de passe ne correspondent pas.");


			} else {				

				$id = $session->read('auth')->id;

				$db = Manager::getDatabase();

				$password = Str::hashPassword($_POST['password']);
				
				$manager = new UserManager();
				$manager->updatePassWord($db, $password, $id);

				$_SESSION['flash']['success'] = "Le mot de passe a bien été mis à jour";

				header('Location: ./index.php');

			}

		}		
	}

	public function restrict() {

		$session = Session::getInstance();

		if (!$session->read('auth')) {
			
			$session->setFlash('danger', 'Vous n\'avez pas accès à cette page.');

			header('Location: ./index.php?controller=login');

			exit();

		}

	}
}

?>