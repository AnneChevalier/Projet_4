<?php

/*namespace Controller\Frontend;*/

require './App/Model/UserManager.php';

use JFFram\Validator;
use JFFram\Session;
use JFFram\Controller;
use JFFram\Manager;
use Model\UserManager;

class RegisterController extends Controller {
	
	public function register() {


		if (!empty($_POST['pseudo'])) {
	
			$errors = array();

			$db = Manager::getDatabase();

			$validator = new Validator($_POST);

			$validator->isAlpha('pseudo', "Votre pseudo n'est pas valide. Veuillez entrer un pseudo alphanumérique.");

			if ($validator->isValid()) {
				
				$validator->isUnique('pseudo', $db,'userstest', 'Ce pseudo est déjà pris.');

			}

			$validator->isEmail('email',"Votre email n'est pas valide.");

			if ($validator->isValid()) {
				
				$validator->isUnique('email', $db,'userstest', "Un compte a déjà été créé avec cet email.");

			}

			$validator->isConfirmed('password', 'confpassword',"Votre mot de passe n'est pas valide.");



			if ($validator->isValid()) {

				$manager = new UserManager();
				$manager->register($db, $_POST['pseudo'], $_POST['email'], $_POST['password']);

				Session::getInstance()->setFlash('success', "Votre compte a bien été créé.");

				header("Location: ./index.php?controller=login");


			} else {

				$errors = $validator->getErrors();

			}

		}

	}
}

?>