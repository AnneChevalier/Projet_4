<?php

namespace Entity;

class Book {
	
	protected $id;
	protected $author;
	protected $title;
	protected $resume;
	protected $creationDate;
	protected $modificationDate;
	protected $cover;
	protected $status;

	public function __construct($data) {

		$this->setId($data['id']);
		$this->setAuthor($data['author']);
		$this->setTitle($data['title']);
		$this->setResume($data['resume']);
		$this->setCreationDate($data['creationDate']);
		$this->setModificationDate($data['modificationDate']);
		$this->setCover($data['cover']);
		$this->setStatus($data['status']);
	}

	public function setId($id) {

		$this->id = (int) $id;

	}

	public function setAuthor($author) {

		$this->author = $author;

	}

	public function setTitle($title) {

		$this->title = $title;

	}

	public function setResume($resume) {

		$this->resume = $resume;

	}

	public function setCreationDate($creationDate) {

		$this->creationDate = $creationDate;

	}

	public function setModificationDate($modificationDate) {

		$this->modificationDate = $modificationDate;

	}

	public function setCover($cover) {

		$this->cover = $cover;

	}

	public function setStatus($status) {

		$this->status = $status;
	}

	public function id() {

		return $this->id;

	}

	public function author() {

		return $this->author;

	}

	public function title() {

		return $this->title;

	}

	public function resume() {

		return $this->resume;

	}

	public function creationDate() {

		return $this->creationDate;

	}

	public function modificationDate() {

		return $this->modificationDate;

	}
	public function cover() {

		return $this->cover;

	}

	public function status() {

		return $this->status;
	}
}