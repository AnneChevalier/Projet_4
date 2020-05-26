<?php

namespace Model;

use JFFram\Manager;
use Entity\Bookmark;

class BookmarkManager extends Manager {
	
	public function add($db, $userId, $bookId, $chapterId) {

		$db->query("INSERT INTO bookmarks SET userId = ?, bookId = ?, chapterId = ?", [$userId, $bookId, $chapterId]);
		
	}

	public function update($db, $id, $chapterId) {

		$db->query("UPDATE bookmarks SET chapterId = ? WHERE id = ?", [$chapterId, $id]);

	}

	public function delete($db, $id) {

		$db->query("DELETE FROM bookmarks WHERE id = ?", [$id]);

	}

	static function getBookmarks($db, $userId) {

		$req = $db->query('SELECT * FROM bookmarks WHERE userId = ? ORDER BY id', [$userId]);
		$bookmarks = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$bookmark = new Bookmark($data);
			array_push($bookmarks, $bookmark);

		}

		return $bookmarks;

	}

	public function getBookmark($db, $id) {

		$data = $db->query('SELECT * FROM bookmarks WHERE id = ?', [$id])->fetch(\PDO::FETCH_ASSOC);
		$bookmark = new Bookmark($data);
		return $bookmark;

	}

	/* Vérifie si l'utilisateur a déjà un marque page dans ce livre */
	public function bookmarkInBook($db, $userId, $bookId) {

		return $db->query('SELECT id FROM bookmarks WHERE userId = ? AND bookId = ?', [$userId, $bookId])->fetch();

	}
}