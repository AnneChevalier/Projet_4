<?php

namespace Model;

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

	public function delete($db, $bookId) {

		$req = $db->query("SELECT id FROM chapters WHERE bookId = ?", [$bookId]);

		$chaptersIds = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$chapterId = $data['id'];
			array_push($chaptersIds, $chapterId);

		}

		foreach ($chaptersIds as $chapterId) {

			$db->query("DELETE FROM comments WHERE chapterId = ?", [$chapterId]);
			$db->query("DELETE FROM bookmarks WHERE chapterId = ?", [$chapterId]);

		}

		$db->query("DELETE FROM chapters WHERE bookId = ?", [$bookId]);

		$db->query("DELETE FROM books WHERE id = ?", [$bookId]);

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

	/* Suppression de tous les livres en corbeille */
	public function deleteAll($db) {

		$req = $db->query("SELECT id FROM books WHERE status = ?", ['basket']);

		$booksIds = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$bookId = $data['id'];
			array_push($booksIds, $bookId);

		}

		foreach ($booksIds as $bookId) {

			$req = $db->query("SELECT id FROM chapters WHERE bookId = ?", [$bookId]);

			$chaptersIds = [];

			while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
				
				$chapterId = $data['id'];
				array_push($chaptersIds, $chapterId);

			}

			foreach ($chaptersIds as $chapterId) {

				$db->query("DELETE FROM comments WHERE chapterId = ?", [$chapterId]);
				$db->query("DELETE FROM bookmarks WHERE chapterId = ?", [$chapterId]);

			}

			$db->query("DELETE FROM chapters WHERE bookId = ?", [$bookId]);
		}

		$db->query("DELETE FROM books WHERE status = ?", ['basket']);
	}

	/* Récupère l'id du dernier livre en ligne */
	public function getLastBookId($db) {

		$req = $db->query("SELECT MAX(id) FROM books WHERE status = 'online'")->fetch(\PDO::FETCH_ASSOC);
		$lastId = $req['MAX(id)'];

		return $lastId;
	}
}