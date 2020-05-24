<?php

namespace Model;

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

		$req = $db->query('SELECT * FROM chapters WHERE bookId = ? AND status = ? ORDER BY publicationDate', [$bookId, 'online']);
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

		$req = $db->query("SELECT id FROM chapters WHERE status = ?", ['basket']);

		$ids = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$id = $data['id'];
			array_push($ids, $id);

		}

		foreach ($ids as $id) {

			$db->query("DELETE FROM comments WHERE chapterId = ?", [$id]);
			$db->query("DELETE FROM bookmarks WHERE chapterId = ?", [$id]);
		}

		$db->query("DELETE FROM chapters WHERE status = ?", ['basket']);
	}

	public function delete($db, $id) {

		$db->query("DELETE FROM comments WHERE chapterId = ?", [$id]);
		$db->query("DELETE FROM bookmarks WHERE chapterId = ?", [$id]);

		$db->query("DELETE FROM chapters WHERE id = ?", [$id]);

	}

	public function idExist($db, $id) {

		return $db->query('SELECT id FROM chapters WHERE id = ?', [$id])->fetch();
		
	}

	static function getBookId($db, $id) {

		$req = $db->query('SELECT bookId FROM chapters WHERE id = ?', [$id])->fetch();

		return $req->bookId;

	}

	public function isPublished($db, $id) {

		return $db->query('SELECT id FROM chapters WHERE id = ? AND status = ?', [$id, "online"])->fetch();
	}
}