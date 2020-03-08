<?php

namespace Model;

use JFFram\Manager;
use JFFram\Str;
use JFFram\Session;

class UserManager extends Manager {


	public function delete() {

	}

	public function updatePassword($db, $password, $id) {

		$db->query('UPDATE userstest SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$password, $id]);

	}

	public function getUser($db, $user_id, $token) {

		return $db->query('SELECT * FROM userstest WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->fetch();

	}

	public function register($db, $pseudo, $email, $password) {

		$password = Str::hashPassword($password);

		$db->query("INSERT INTO userstest SET pseudo = ?, password = ?, email = ?", [$pseudo, $password, $email]);

	}

	public function resetPassword($db, $email) {

		$user = $db->query('SELECT * FROM userstest WHERE email = ?', [$email])->fetch();

		if ($user) {

			$reset_token = Str::random(60);

			$db->query('UPDATE userstest SET reset_token = ?, reset_at = NOW() WHERE id = ?', [$reset_token, $user->id]);

			/* Attention : il faudra changer le chemin lors de la mise en production */
			mail($_POST['email'], 'Réinitialisation de votre mot de passe' , 'Pour réinitialiser votre mot de passe, merci de cliquer sur le lien :\n\nhttp://localhost/projet_4/App/Frontend/Modulesr/eset.php?id={$user->id}&token=$reset_token');

			return $user;

		}

		return false;

	}

	

	public function login($db, $email, $password) {

		$user = $db->query('SELECT * FROM userstest WHERE email = ?', [$email])->fetch();

		if (password_verify($password, $user->password)) {
				
			$this->connect($user);

			return $user;

		} else {

			return false;

		}

	}

	public function backlogin($db, $pseudo, $password) {

		$user = $db->query('SELECT * FROM userstest WHERE pseudo = ?', [$pseudo])->fetch();

		if (password_verify($password, $user->password)) {
				
			$this->connect($user);

			return $user;

		} else {

			return false;

		}

	}

	public function connect($user) {

		$session = Session::getInstance();

		$session->write('auth', $user);

	}

	public function logout() {

		$session = Session::getInstance();

		$session->delete('auth');

	}
	
	
}