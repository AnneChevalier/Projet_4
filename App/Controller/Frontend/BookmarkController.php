<?php

use JFFram\Controller;
use JFFram\Manager;
use Model\ChapterManager;
use Model\UserManager;
use Model\BookmarkManager;

class BookmarkController extends Controller {
	
	public function mark() {

		if (!empty($_POST['userId'])) {

			$userId = (int) $_POST['userId'];
			$chapterId = (int) $_POST['chapterId'];

			$db = Manager::getDatabase();
			$userManager = new UserManager();
			$bookmarkManager = new BookmarkManager();
			$chapterManager = new ChapterManager();

			$bookId = (int) ChapterManager::getBookId($db, $chapterId);

			if ($userManager->idExist($db, $userId) && $chapterManager->idExist($db, $chapterId)) {

				if ($data = $bookmarkManager->bookmarkInBook($db, $userId, $bookId)) {

					$bookmarkId = $data->id;
					
					$bookmarkManager->update($db, $bookmarkId, $chapterId);

				} else {

					$bookmarkManager->add($db, $userId, $bookId, $chapterId);

				}
				
			}

		}

		header('Location: ./index.php?controller=reading&id=' . $chapterId);

	}

}