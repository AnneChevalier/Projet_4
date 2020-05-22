<?php

namespace Model;

use JFFram\Manager;
use JFFram\Str;
use JFFram\Session;

class UserManager extends Manager {


	public function updatePassword($db, $password, $id) {

		$db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$password, $id]);

	}

	public function getUser($db, $user_id, $token) {

		return $db->query('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->fetch();

	}

	public function getUpdatedUser($db, $id) {

		return $db->query('SELECT * FROM users WHERE id = ?', [$id])->fetch();
	}

	public function register($db, $pseudo, $email, $password) {

		$password = Str::hashPassword($password);

		$db->query("INSERT INTO users SET pseudo = ?, password = ?, email = ?", [$pseudo, $password, $email]);

	}

	public function resetPassword($db, $email) {

		$user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

		if ($user) {

			$reset_token = Str::random(60);

			$db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?', [$reset_token, $user->id]);

			/* Attention : il faudra changer le chemin lors de la mise en production */
			mail($_POST['email'], 'Réinitialisation de votre mot de passe' , 'Pour réinitialiser votre mot de passe, merci de cliquer sur le lien :\n\nhttp://localhost/projet_4/App/Frontend/Modulesr/eset.php?id={$user->id}&token=$reset_token');

			return $user;

		}

		return false;

	}

	

	public function login($db, $email, $password) {

		$user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

		if (password_verify($password, $user->password)) {
				
			$this->connect($user);

			return $user;

		} else {

			return false;

		}

	}

	public function backlogin($db, $pseudo, $password) {

		$user = $db->query('SELECT * FROM users WHERE pseudo = ?', [$pseudo])->fetch();

		if (password_verify($password, $user->password) && $user->admin == 1) {
				
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

	public function idExist($db, $id) {

		return $db->query('SELECT id FROM users WHERE id = ?', [$id])->fetch();
		
	}

	public function getPseudo($db, $id) {

		$req = $db->query('SELECT pseudo FROM users WHERE id = ?', [$id])->fetch();
		return $req->pseudo;
	}

	public function updatePseudo($db, $id, $pseudo) {

		$db->query('UPDATE users SET pseudo = ? WHERE id = ?', [$pseudo, $id]);

	}

	public function updateEmail($db, $id, $email) {

		$db->query('UPDATE users SET email = ? WHERE id = ?', [$email, $id]);
	}

	public function delete($db, $id) {

		$db->query("DELETE FROM comments WHERE userId = ?", [$id]);
		$db->query("DELETE FROM bookmarks WHERE userId = ?", [$id]);

		$db->query("DELETE FROM users WHERE id = ?", [$id]);

	}
	
}