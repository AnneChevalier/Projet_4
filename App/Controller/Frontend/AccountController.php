<?php

use JFFram\Controller;
use JFFram\Manager;
use Model\UserManager;
use JFFram\Str;
use JFFram\Session;
use JFFram\Validator;

class AccountController extends Controller {
	
	public function changePassword() {

		$session = Session::getInstance();
		$oldpassword = Str::hashPassword($_POST['oldpassword']);
		echo $oldpassword;
		echo $session->read('auth')->password;

		if (!$session->read('auth')->admin && password_verify($_POST['oldpassword'], $session->read('auth')->password)) {
			
			if (empty($_POST['password']) || $_POST['password'] !== $_POST['confpassword']) {
				
				$session->setFlash('danger', "Les mots de passe ne correspondent pas.");
				header('Location: ./index.php?controller=account');

			} else {				

				$id = $session->read('auth')->id;

				$db = Manager::getDatabase();

				$password = Str::hashPassword($_POST['password']);
				
				$manager = new UserManager();
				$manager->updatePassWord($db, $password, $id);

				$_SESSION['flash']['success'] = "Le mot de passe a bien été mis à jour";

				header('Location: ./index.php?controller=account');

			}

		} else {

			$session->setFlash('danger', "Vous n'avez pas l'autorisation de changer ce mot de passe.");
			header('Location: ./index.php?controller=account');

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

	public function updatePseudo() {

		$session = Session::getInstance();
		$id = $session->read('auth')->id;

		if (!empty($_POST['pseudo'])) {
	
			$errors = array();
			$db = Manager::getDatabase();

			$validator = new Validator($_POST);
			$validator->isAlpha('pseudo', "Votre pseudo n'est pas valide. Veuillez entrer un pseudo alphanumérique.");

			if ($validator->isValid()) {
				
				$validator->isUnique('pseudo', $db,'users', 'Ce pseudo est déjà pris.');

			}

			if ($validator->isValid()) {

				$manager = new UserManager();

				$pseudo = Str::secured($_POST['pseudo']);

				$manager->updatePseudo($db, $id, $pseudo);
				$user = $manager->getUpdatedUser($db, $id);

				Session::getInstance()->setFlash('success', "Votre pseudo a bien été modifié.");
				$session->write('auth', $user);

				header("Location: ./index.php?controller=account");


			} else {

				$errors = $validator->getErrors();

			}

		} else {

			Session::getInstance()->getFlashes('danger', "Entrez un pseudo.");
			header('Location: ./index.php?controller=account');
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
				
				$validator->isUnique('email', $db,'users', "Un compte a déjà été créé avec cet email.");

			}

			if ($validator->isValid()) {

				$manager = new UserManager();

				$manager->updateEmail($db, $id, $_POST['email']);
				$user = $manager->getUpdatedUser($db, $id);

				Session::getInstance()->setFlash('success', "Votre adresse email a bien été modifiée.");
				$session->write('auth', $user);

				header("Location: ./index.php?controller=account");


			} else {

				$errors = $validator->getErrors();

			}

		} else {

			Session::getInstance()->getFlashes('danger', "Entrez votre adresse email.");
			header('Location: ./index.php?controller=account');
		}

	}

	public function delete() {

		$session = Session::getInstance();
		$id = $session->read('auth')->id;

		if ($session->read('auth')->admin) {

			Session::getInstance()->getFlashes('danger', "Vous ne pouvez pas supprimer ce compte.");
			header('Location: ./index.php?controller=account');
			
		} else {

			$db = Manager::getDatabase();
			$manager = new UserManager();
			$manager->delete($db, $id);
			$session->delete('auth');

			Session::getInstance()->getFlashes('success', "Votre compte a bien été supprimé.");
			header("Location: ./index.php");

		}

	}

}