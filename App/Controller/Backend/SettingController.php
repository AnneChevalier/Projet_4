<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Session;
use JFFram\Validator;
use Model\UserManager;
use JFFram\Str;

class SettingController extends Controller {
	
	public function updatePseudo() {

		$session = Session::getInstance();
		$id = $session->read('auth')->id;

		if (!empty($_POST['pseudo'])) {
	
			$errors = array();
			$db = Manager::getDatabase();

			$validator = new Validator($_POST);
			$validator->isAlpha('pseudo', "Votre pseudo n'est pas valide. Veuillez entrer un pseudo alphanumérique.");

			if ($validator->isValid()) {
				
				$validator->isUnique('pseudo', $db,'userstest', 'Ce pseudo est déjà pris.');

			}

			if ($validator->isValid()) {

				$manager = new UserManager();

				$manager->updatePseudo($db, $id, $_POST['pseudo']);
				$user = $manager->getUpdatedUser($db, $id);

				Session::getInstance()->setFlash('success', "Votre pseudo a bien été modifié.");
				$session->write('auth', $user);

				header("Location: ./backindex.php?controller=setting");


			} else {

				$errors = $validator->getErrors();

			}

		} else {

			Session::getInstance()->getFlashes('danger', "Entrez un pseudo.");
			header("Location: ./backindex.php?controller=setting");
		}

	}

	public function updateEmail() {

		$session = Session::getInstance();
		$id = $session->read('auth')->id;

		if (!empty($_POST['email'])) {
	
			$errors = array();
			$db = Manager::getDatabase();

			$validator = new Validator($_POST);
			$validator->isEmail('email',"Votre email n'est pas valide.");

			if ($validator->isValid()) {
				
				$validator->isUnique('email', $db,'userstest', "Un compte a déjà été créé avec cet email.");

			}

			if ($validator->isValid()) {

				$manager = new UserManager();

				$manager->updateEmail($db, $id, $_POST['email']);
				$user = $manager->getUpdatedUser($db, $id);

				Session::getInstance()->setFlash('success', "Votre adresse email a bien été modifiée.");
				$session->write('auth', $user);

				header("Location: ./backindex.php?controller=setting");


			} else {

				$errors = $validator->getErrors();

			}

		} else {

			Session::getInstance()->getFlashes('danger', "Entrez votre adresse email.");
			header("Location: ./backindex.php?controller=setting");
		}

	}

	public function changePassword() {

		$session = Session::getInstance();
		$oldpassword = Str::hashPassword($_POST['oldpassword']);
		echo $oldpassword;
		echo $session->read('auth')->password;

		if (password_verify($_POST['oldpassword'], $session->read('auth')->password)) {
			
			if (empty($_POST['password']) || $_POST['password'] !== $_POST['confpassword']) {
				
				$session->setFlash('danger', "Les mots de passe ne correspondent pas.");
				header("Location: ./backindex.php?controller=setting");

			} else {				

				$id = $session->read('auth')->id;

				$db = Manager::getDatabase();

				$password = Str::hashPassword($_POST['password']);
				
				$manager = new UserManager();
				$manager->updatePassWord($db, $password, $id);

				$_SESSION['flash']['success'] = "Le mot de passe a bien été mis à jour";

				header("Location: ./backindex.php?controller=setting");

			}

		} else {

			$session->setFlash('danger', "Vous n'avez pas l'autorisation de changer ce mot de passe.");
			header("Location: ./backindex.php?controller=setting");

		}
		
	}
}