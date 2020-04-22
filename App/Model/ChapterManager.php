<?php

namespace Model;

require './lib/Entity/Chapter.php';

use JFFram\Manager;
use Entity\Chapter;

class ChapterManager extends Manager {
	
	public function add($db, $bookId, $title, $content) {

		$db->query("INSERT INTO chapters SET title = ?, bookId = ?, content = ?, creationDate = NOW()", [$title, $bookId, $content]);

	}

	static function getAllChapters($db, $bookId) {

		$req = $db->query('SELECT * FROM chapters WHERE bookId = ? AND status != ?', [$bookId, 'basket']);
		$chapters = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$chapter = new Chapter($data);
			array_push($chapters, $chapter);

		}

		return $chapters;

	}

	static function getPublishedChapters($db, $bookId) {

		$req = $db->query('SELECT * FROM chapters WHERE bookId = ? AND status = ?', [$bookId, 'online']);
		$chapters = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$chapter = new Chapter($data);
			array_push($chapters, $chapter);

		}

		return $chapters;

	}

	static function getDeletedChapters($db) {

		$req = $db->query('SELECT * FROM chapters WHERE status = ?', ['basket']);
		$chapters = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$chapter = new Chapter($data);
			array_push($chapters, $chapter);

		}

		return $chapters;

	}

	static function getChapter($db, $id) {

		$data = $db->query('SELECT * FROM chapters WHERE id = ?', [$id])->fetch(\PDO::FETCH_ASSOC);
		$chapter = new Chapter($data);

		return $chapter;
	}

	public function update($db, $id, $title, $content) {

		$db->query("UPDATE chapters SET title = ?, content = ?, modificationDate = NOW() WHERE id = ?", [$title, $content, $id]);
	}

	public function inBasket($db, $id) {

		$db->query("UPDATE chapters SET status = ? WHERE id = ?", ['basket', $id]);
	}

	public function changeStatus($db, $id) {

		$req = $db->query("SELECT status FROM chapters WHERE id = ?", [$id])->fetch(\PDO::FETCH_ASSOC);
		$status = $req['status'];

		if ($status == 'offline') {
			
			$db->query("UPDATE chapters SET status = ?, publicationDate = NOW();  WHERE id = ?", ['online', $id]);

		} else {

			$db->query("UPDATE chapters SET status = ? WHERE id = ?", ['offline', $id]);
		}
		
	}

	public function restore($db) {

		$db->query("UPDATE chapters SET status = ? WHERE status = ?", ['offline', 'basket']);

	}

	public function deleteAll($db) {

		$db->query("DELETE FROM chapters WHERE status = ?", ['basket']);
	}

	public function delete($db, $id) {

		$db->query("DELETE FROM chapters WHERE id = ?", [$id]);

	}
}