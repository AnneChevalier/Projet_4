<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\CommentManager;

class EditCommentController extends Controller {

	/* On récupère le commentaire */
	static function getComment($id) {

		$db = Manager::getDatabase();
		$commentManager = new CommentManager();

		if ($commentManager->idExist($db, $id)) {
			
			return $commentManager->getComment($db, $id);
		}
	}
	
	/* On enregistre la modification du commentaire */
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

		$hiddenChapterId = Str::encrypt($chapterId);
		header('Location: ./index.php?controller=reading&id=' . $hiddenChapterId);

	}

}