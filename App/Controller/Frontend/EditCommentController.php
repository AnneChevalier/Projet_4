<?php

/*namespace Controller\Frontend;*/

require './App/Model/CommentManager.php';

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\CommentManager;

class EditCommentController extends Controller {

	static function getComment($id) {

		$db = Manager::getDatabase();
		$commentManager = new CommentManager();

		if ($commentManager->idExist($db, $id)) {
			
			return $commentManager->getComment($db, $id);
		}
	}
	
	public function edit() {

		$db = Manager::getDatabase();

		$title = $_POST['title'];
		$content = $_POST['content'];
		$commentId = (int) $_POST['commentId'];
		$chapterId =  (int) $_POST['chapterId'];

		if (!empty($title) && !empty($content) && !empty($commentId)) {
			
			$title = Str::secured($_POST['title']);
			$content = Str::secured($_POST['content']);
			
			$commentManager = new CommentManager();

			if ($commentManager->idExist($db, $commentId)) {
				
				$commentManager->update($db, $commentId, $title, $content);
			}
		}

		header('Location: ./index.php?controller=reading&id=' . $chapterId);

	}

}