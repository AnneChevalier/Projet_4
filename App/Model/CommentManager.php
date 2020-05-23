<?php

namespace Model;

use JFFram\Manager;
use Entity\Comment;

class CommentManager extends Manager {
	
	public function add($db, $userId, $chapterId, $title, $content) {

		$db->query("INSERT INTO comments SET userId = ?, chapterId = ?, title = ?, content = ?, creationDate = NOW()", [$userId, $chapterId, $title, $content]);

	}

	static function getComments($db, $chapterId) {

		$req = $db->query('SELECT * FROM comments WHERE chapterId = ?', [$chapterId]);
		$comments = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$comment = new Comment($data);
			array_push($comments, $comment);

		}

		return $comments;

	}

	static function getComment($db, $id) {

		$data = $db->query('SELECT * FROM comments WHERE id = ?', [$id])->fetch(\PDO::FETCH_ASSOC);
		$comment = new Comment($data);

		return $comment;
	}

	public function getReportedComments($db) {

		$req = $db->query('SELECT * FROM comments WHERE status = ?', ['reported']);
		$comments = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$comment = new Comment($data);
			array_push($comments, $comment);

		}

		return $comments;
	}

	public function getNewComments($db) {

		$req = $db->query('SELECT * FROM comments WHERE status = ?', ['notreported']);
		$comments = [];

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			
			$comment = new Comment($data);
			array_push($comments, $comment);

		}

		return $comments;
	}

	public function update($db, $id, $title, $content) {

		$db->query("UPDATE comments SET title = ?, content = ? WHERE id = ?", [$title, $content, $id]);
	}

	public function report($db, $id) {

		$db->query("UPDATE comments SET status = ? WHERE id = ?", ['reported', $id]);
		
	}

	public function validate($db, $id) {

		$db->query("UPDATE comments SET status = ? WHERE id = ?", ['valid', $id]);

	}

	public function delete($db, $id) {

		$db->query("DELETE FROM comments WHERE id = ?", [$id]);

	}

	public function idExist($db, $id) {

		return $db->query('SELECT id FROM comments WHERE id = ?', [$id])->fetch();
		
	}
}