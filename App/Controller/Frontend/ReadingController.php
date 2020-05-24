<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use JFFram\Session;
use Model\UserManager;
use Model\ChapterManager;
use Model\CommentManager;

class ReadingController extends Controller {
	
	static function displayChapter($id) {

		$db = Manager::getDatabase();
		$chapterManager = new ChapterManager();

		if ($chapterManager->idExist($db, $id)) {

			$chapter = $chapterManager->getChapter($db, $id);
			$content = html_entity_decode($chapter->content());

			echo "<h3>" . $chapter->title() . "</h3>" . $content;

		}

	}

	static function displayComments($chapterId) {

		$db = Manager::getDatabase();
		$commentManager = new CommentManager();
		$comments = $commentManager->getComments($db, $chapterId);

		foreach ($comments as $comment) {

			$userId = $comment->userId();
			$userManager = new UserManager();
			
			echo'
				<div class="row comment">
					<p class="col-md-8">' . $comment->creationDate() . ' par ' . $userManager->getPseudo($db, $userId) . '</p>
					<div class="col-md-4 navbar-right">';

					if (Session::getInstance()->read('auth')) {

						if (Session::getInstance()->read('auth')->pseudo != $userManager->getPseudo($db, $userId)) {

							if ($comment->status() != 'valid' && $comment->userId() != 11) {
								
								echo '<form method="post" action="./index.php?controller=reading&action=report" class="float-right">
										<input type="hidden" name="chapterId" value="' . $chapterId . '"/>
										<input type="hidden" name="commentId" value="' . $comment->id() . '"/>
										<button type="submit" class="float-right"><i class="fas fa-flag"></i></button>
									</form>';
							}

						} else {

							echo '<div class="row float-right">';

							if ($comment->status() != 'valid') {
								echo '
										<form method="post" action="./index.php?controller=editComment">
											<input type="hidden" name="chapterId" value="' . $chapterId . '"/>
											<input type="hidden" name="commentId" value="' . $comment->id() . '"/>
											<button type="submit"><i class="fas fa-pencil-alt"></i></button>
										</form>';
							}

							echo '
									<form method="post" action="./index.php?controller=reading&action=delete">
										<input type="hidden" name="chapterId" value="' . $chapterId . '"/>
										<input type="hidden" name="commentId" value="' . $comment->id() . '"/>
										<button type="submit"><i class="fas fa-times"></i></button>
									</form>
								</div>';
						}
					}
						
			echo 	'</div>
					<h4 class="col-md-10">' . $comment->title() . '</h4>
					<p class="col-md-12">' . $comment->content() . '</p>
				</div>';

		}

	}

	public function addComment() {

		$db = Manager::getDatabase();

		$title = $_POST['title'];
		$content = $_POST['content'];
		$userId = (int) $_POST['userId'];
		$chapterId = (int) $_POST['chapterId'];

		if (!empty($title) && !empty($content) && !empty($userId) && !empty($chapterId)) {
			
			$title = Str::secured($_POST['title']);
			$content = Str::secured($_POST['content']);
			$userManager = new UserManager();
			$chapterManager = new ChapterManager();

			if ($userManager->idExist($db, $userId) && $chapterManager->idExist($db, $chapterId)) {
				
				$commentManager = new CommentManager();
				$commentManager->add($db, $userId, $chapterId, $title, $content);
			}
		}

		header('Location: ./index.php?controller=reading&id=' . $chapterId);
	}

	public function report() {

		$db = Manager::getDatabase();
		$commentId = (int) $_POST['commentId'];
		$commentManager = new CommentManager();

		if($commentManager->idExist($db, $commentId)) {

			$commentManager->report($db, $commentId);
		}

		header('Location: ./index.php?controller=reading&id=' . $chapterId);
		
	}

	public function delete() {

		$db = Manager::getDatabase();
		$commentId = (int) $_POST['commentId'];
		$chapterId = (int) $_POST['chapterId'];
		$commentManager = new CommentManager();

		if ($commentManager->idExist($db, $commentId)) {
			
			$commentManager->delete($db, $commentId);
		}

		header('Location: ./index.php?controller=reading&id=' . $chapterId);

	}

	static function check($id) {

		$db = Manager::getDatabase();
		$manager = new ChapterManager();
		
		return $manager->isPublished($db, $id);
	}

}