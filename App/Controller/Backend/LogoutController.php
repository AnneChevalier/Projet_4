<?php

use JFFram\Session;
use JFFram\Controller;
use Model\UserManager;

class LogoutController extends Controller {

	public function logout() {

		$manager = new UserManager();
		$manager->logout();

		Session::getInstance()->setFlash('success', "Vous êtes déconnecté.");

		header('Location: ./backindex.php');

	}
	

}