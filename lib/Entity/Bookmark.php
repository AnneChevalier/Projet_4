<?php

namespace Entity;

class Bookmark {

	protected $id;
	protected $userId;
	protected $bookId;
	protected $chapterId;
	
	 public function __construct($data)
	{
		$this->setId($data['id']);
		$this->setUserId($data['userId']);
		$this->setBookId($data['bookId']);
		$this->setChapterId($data['chapterId']);
	}

	public function setId($id) {

		$this->id = (int) $id;

	}

	public function setUserId($userId) {

		$this->userId = (int) $userId;

	}

	public function setBookId($bookId) {

		$this->bookId = (int) $bookId;

	}

	public function setChapterId($chapterId) {

		$this->chapterId = (int) $chapterId;

	}

	public function id() {

		return $this->id;

	}

	public function userId() {

		return $this->userId;

	}

	public function bookId() {

		return $this->bookId;

	}

	public function chapterId() {

		return $this->chapterId;

	}
}