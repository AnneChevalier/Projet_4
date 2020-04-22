<?php

namespace Model;

require './lib/Entity/Book.php';

use JFFram\Manager;
use Entity\Book;
use JFFram\Str;


class BookManager extends Manager {
	
	public function add($db, $title, $author, $resume, $file) {

		$cover = basename($file['cover']['name']);
		$dossier = './Web/images/covers/';

		$cover = Str::formatFileName($cover);

		move_uploaded_file($_FILES['cover']['tmp_name'], $dossier . $cover);

		$db->query("INSERT INTO books SET title = ?, author = ?, resume = ?, cover = ?, creationDate = NOW()", [$title, $author, $resume, $cover]);
		

	}

	public function update($db, $id, $title, $author, $resume, $file = null) {

		if ($file != null) {
			
			$cover = basename($file['cover']['name']);
			$dossier = './Web/images/covers/';

			$cover = Str::formatFileName($cover);

			move_uploaded_file($_FILES['cover']['tmp_name'], $dossier . $cover);

			$db->query("UPDATE books SET title = ?, author = ?, resume = ?, cover = ?, modificationDate = NOW() WHERE id = ?", [$title, $author, $resume, $cover, $id]);

		} else {

			$db->query("UPDATE books SET title = ?, author = ?, resume = ?, modificationDate = NOW() WHERE id = ?", [$title, $author, $resume, $id]);
		}

	}

	public function delete($db, $id) {

		$db->query("DELETE FROM chapters WHERE bookId = ?", [$id]);

		$db->query("DELETE FROM books WHERE id = ?", [$id]);

	}

	public function getBook($db, $id) {

		$data = $db->query('SELECT * FROM books WHERE id = ?', [$id])->fetch(\PDO::FETCH_ASSOC);
		$book = new Book($data);
		return $book;

	}

	static function getBooks($db) {

		$req = $db->query('SELECT * FROM books WHERE status != ? ORDER BY id', ['basket']);
		$books = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$book = new Book($data);
			array_push($books, $book);

		}

		return $books;

	}

	public function getDeletedBooks($db) {

		$req = $db->query('SELECT * FROM books WHERE status = ?', ['basket']);
		$deletedBooks = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$book = new Book($data);
			array_push($deletedBooks, $book);

		}

		return $deletedBooks;

	}

	public function changeStatus($db, $id) {

		$req = $db->query("SELECT status FROM books WHERE id = ?", [$id])->fetch(\PDO::FETCH_ASSOC);
		$status = $req['status'];

		if ($status == 'offline') {
			
			$db->query("UPDATE books SET status = ? WHERE id = ?", ['online', $id]);

		} else {

			$db->query("UPDATE books SET status = ? WHERE id = ?", ['offline', $id]);
		}
		
	}

	public function inBasket($db, $id) {

		$db->query("UPDATE books SET status = ? WHERE id = ?", ['basket', $id]);

	}

	public function restore($db) {

		$db->query("UPDATE books SET status = ? WHERE status = ?", ['offline', 'basket']);

	}

	public function deleteAll($db) {

		$req = $db->query("SELECT id FROM books WHERE status = ?", ['basket']);

		$ids = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$id = $data['id'];
			array_push($ids, $id);

		}

		foreach ($ids as $id) {

			$db->query("DELETE FROM chapters WHERE bookId = ?", [$id]);
		}

		$db->query("DELETE FROM books WHERE status = ?", ['basket']);
	}

	public function getLastBookId($db) {

		$req = $db->query("SELECT MAX(id) FROM books WHERE status = 'online'")->fetch(\PDO::FETCH_ASSOC);
		$lastId = $req['MAX(id)'];

		return $lastId;
	}
}