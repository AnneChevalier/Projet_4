<?php

use JFFram\Validator;
use JFFram\Session;
use JFFram\Controller;
use JFFram\Manager;
use Model\UserManager;
use JFFram\Str;

class ResetController extends Controller {
	
	/* vérification du token pour réinitialiser le mot de passe après un oubli */
	public function reset() {

		if(isset($_GET['id']) && isset($_GET['token'])) {

			$db = Manager::getDatabase();

			$manager = new UserManager();

			$user = $manager->getUser($db, $_GET['id'], $_GET['token']);

			if ($user) {

				if (!empty($_POST)) {

					$validator = new Validator($_POST);

					$validator->isConfirmed('password', 'confpassword');

					if ($validator->isValid()) {
						
						$password = Str::hashPassword($_POST['password']);

						$id = $_GET['id'];

						$manager->updatePassword($db, $password, $id);

						$manager->connect($user);

						Session::getInstance()->setFlash('success', "Le mot de passe a bien été modifié.");

						header('Location: ./index.php?controller=account');

					}

				}
				
			} else {

				Session::getInstance()->setFlash('danger', "Ce token n'est pas valide");


				header('Location: ./index.php?controller=login');

			}


		} else {

			header('Location: ./index.php?controller=login');

		}
	}
}

?>