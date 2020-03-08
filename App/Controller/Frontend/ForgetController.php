<?php

/*namespace Controller\Frontend;*/

require './App/Model/UserManager.php';

use JFFram\Session;
use JFFram\Controller;
use JFFram\Manager;
use Model\UserManager;

class ForgetController extends Controller {
	
	public function forget() {

		if (!empty($_POST) && !empty($_POST['email'])) {

			$db = Manager::getDatabase();

			$manager = new UserManager();

			$session = Session::getInstance();

			if ($manager->resetPassword($db, $_POST['email'])) {
				
				$session->setFlash('success', "Un email vous a été envoyé.");

				header('Location: ./index.php?controller=login');

			} else {

				$session->setFlash('danger', "Aucun compte ne correspond à cet email.");

			}

		}
	}

}

?>