<?php

namespace JFFram;

class User {

	protected $id;
	protected $pseudo;
	protected $email;
	protected $password;
	protected $role;
	protected $reset_token;
	protected $reset_at;


	public function setId($id) {

		$this->id = (int) $id;

	}
	public function setPseudo($pseudo) {

		$this->pseudo = $pseudo;

	}
	public function setEmail($email) {

		$this->email = $email;

	}
	public function setPassword($password) {

		$this->password = $password;

	}
	public function setRole($role) {

		$this->role = $role;

	}
	public function setResetToken($reset_token) {

		$this->reset_token = $reset_token;

	}
	public function setResetAt($reset_at) {

		$this->reset_at = $reset_at;

	}

	public function id() {

		return $this->id;

	}
	public function pseudo() {

		return $this->pseudo;
		
	}
	public function email() {

		return $this->email;
		
	}
	public function password() {

		return $this->password;
		
	}
	public function role() {

		return $this->role;
		
	}
	public function resetToken() {

		return $this->reset_token;
		
	}
	public function resetAt() {

		return $this->reset_at;
		
	}
}