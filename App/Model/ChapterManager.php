<?php

namespace Model;

use JFFram\Manager;

class ChapterManager extends Manager {
	
	public function add($db, $bookId, $title, $content) {

		$db->query("INSERT INTO chapters SET title = ?, bookId = ?, content = ?, creationDate = NOW()", [$title, $bookId, $content]);

	}
}