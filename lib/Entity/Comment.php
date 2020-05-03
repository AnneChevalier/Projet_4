<?php

namespace Entity;

class Comment {

	protected $id;
	protected $userId;
	protected $chapterId;
	protected $title;
	protected $content;
	protected $creationDate;
	protected $status;
	
	public function __construct($data) {
		
		$this->setId($data['id']);
		$this->setUserId($data['userId']);
		$this->setChapterId($data['chapterId']);
		$this->setTitle($data['title']);
		$this->setContent($data['content']);
		$this->setCreationDate($data['creationDate']);
		$this->setStatus($data['status']);
	}

	public function setId($id) {

		$this->id = (int) $id;

	}

	public function setUserId($userId) {

		$this->userId = (int) $userId;

	}

	public function setChapterId($chapterId) {

		$this->chapterId = (int) $chapterId;

	}

	public function setTitle($title) {

		$this->title = $title;

	}

	public function setContent($content) {

		$this->content = $content;

	}

	public function setCreationDate($creationDate) {

		$this->creationDate = $creationDate;

	}

	public function setStatus($status) {

		$this->status = $status;
	}

	public function id() {

		return $this->id;

	}

	public function userId() {

		return $this->userId;

	}

	public function chapterId() {

		return $this->chapterId;

	}

	public function title() {

		return $this->title;

	}

	public function content() {

		return $this->content;

	}

	public function creationDate() {

		return $this->creationDate;

	}

	public function status() {

		return $this->status;
	}
}