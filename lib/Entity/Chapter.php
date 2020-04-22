<?php

namespace Entity;

class Chapter {

	protected $id;
	protected $bookId;
	protected $title;
	protected $content;
	protected $creationDate;
	protected $modificationDate;
	protected $publicationDate;
	protected $status;
	
	function __construct($data)
	{
		$this->setId($data['id']);
		$this->setBookId($data['bookId']);
		$this->setTitle($data['title']);
		$this->setContent($data['content']);
		$this->setCreationDate($data['creationDate']);
		$this->setModificationDate($data['modificationDate']);
		$this->setPublicationDate($data['publicationDate']);
		$this->setStatus($data['status']);
	}

	public function setId($id) {

		$this->id = (int) $id;

	}

	public function setBookId($bookId) {

		$this->bookId = (int) $bookId;

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

	public function setModificationDate($modificationDate) {

		$this->modificationDate = $modificationDate;

	}

	public function setPublicationDate($publicationDate) {

		$this->publicationDate = $publicationDate;

	}

	public function setStatus($status) {

		$this->status = $status;
	}

	public function id() {

		return $this->id;

	}

	public function bookId() {

		return $this->bookId;

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

	public function modificationDate() {

		return $this->modificationDate;

	}

	public function publicationDate() {

		return $this->publicationDate;

	}

	public function status() {

		return $this->status;
	}
}