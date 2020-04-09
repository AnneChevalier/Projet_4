<?php

namespace JFFram;

class Validator {

	private $data;
	private $errors = [];
	
	public function __construct($data) {
		
		$this->data = $data;

	}

	private function getField($field) {

		if (!isset($this->data[$field])) {
			
			return null;
		}

		return $this->data[$field];

	}

	public function isAlpha($field, $error_message) {

		if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->getField($field))) {

			$this->errors[$field] = $error_message;

		}

	}

	public function isImage($field, $error_message) {

		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['cover']['name'], '.');
		
		if(!in_array($extension, $extensions)) {

			$this->errors[$field] = $error_message;

		}
	}

	public function isUnique($field, $db, $table, $error_message) {

		$record = $db->query("SELECT id FROM $table WHERE $field = ?", [$this->getField($field)])->fetch();

		if ($record) {

			$this->errors[$field] = $error_message;
		}

	}

	public function isEmail($field, $error_message) {

		if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
			
			$this->$errors[$field] = $error_message;

		}

	}

	public function isConfirmed($field, $fieldConf, $error_message = '') {

		$value = $this->getField($field);

		if (empty($value) || $value !== $this->getField($fieldConf)) {
			
			$this->$errors[$field] = $error_message;

		}
	}

	public function isValid() {

		return empty($this->errors);

	}

	public function getErrors() {

		return $this->errors;

	}

}