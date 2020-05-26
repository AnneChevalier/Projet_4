<?php

use JFFram\Validator;
use JFFram\Session;
use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\UserManager;

class RegisterController extends Controller {
	
	/* vérifications et ajout d'un nouvel utilisateur */
	public function register() {


		if (!empty($_POST['pseudo'])) {
	
			$errors = array();

			$db = Manager::getDatabase();

			$validator = new Validator($_POST);

			$validator->isAlpha('pseudo', "Votre pseudo n'est pas valide. Veuillez entrer un pseudo alphanumérique.");

			if ($validator->isValid()) {
				
				$validator->isUnique('pseudo', $db,'users', 'Ce pseudo est déjà pris.');

			}

			$validator->isEmail('email', "Votre email n'est pas valide.");

			if ($validator->isValid()) {
				
				$validator->isUnique('email', $db,'users', "Un compte a déjà été créé avec cet email.");

			}

			$validator->isConfirmed('password', 'confpassword', "Votre mot de passe n'est pas valide.");



			if ($validator->isValid()) {

				$manager = new UserManager();
				$pseudo = Str::secured($_POST['pseudo']);
				$manager->register($db, $pseudo, $_POST['email'], $_POST['password']);

				Session::getInstance()->setFlash('success', "Votre compte a bien été créé.");

				header("Location: ./index.php?controller=login");


			} else {

				$errors = $validator->getErrors();
				
				foreach ($errors as $error) {

					Session::getInstance()->setFlash('danger', $error);
					header("Location: ./index.php?controller=register");
				}
				
			}

		}

	}
}

?>