<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\CommentManager;
use Model\UserManager;

class ModerateController extends Controller {
	
	/* Affichage des commentaires signalés */
	static function displayReportedComments() {

		$db = Manager::getDatabase();
		$commentManager = new CommentManager();
		$comments = $commentManager->getReportedComments($db);

		if(!empty($comments)) {

			foreach ($comments as $comment) {

				$userId = $comment->userId();
				$userManager = new UserManager();
				
				echo'
					<div class="card border-danger">
						<p class="col-md-8">' . $comment->creationDate() . ' par ' . Str::secured($userManager->getPseudo($db, $userId)) . '</p>
						<h4 class="col-md-10">' . Str::secured($comment->title()) . '</h4>
						<p class="col-md-12">' . Str::secured($comment->content()) . '</p>
						<form method="post" action="./backindex.php?controller=moderate&action=validate">
							<input type="hidden" name="commentId" value="' . $comment->id() . '" />
							<button type="submit" class="btn">Valider le commentaire</button>
							<a href="./backindex.php?controller=moderate&action=delete&id=' . $comment->id() . '"><button type="button" class="btn">Supprimer le commentaire</button></a>
						</form>
					</div>';

			}

		} else {

			echo '
				<div class="card">
					Aucun commentaire n\'a été signalé.
				</div>';

		}

		
	}

	/* Affichage des nouveaux commentaires */
	static function displayNewComments() {

		$db = Manager::getDatabase();
		$commentManager = new CommentManager();
		$comments = $commentManager->getNewComments($db);

		if (!empty($comments)) {
			
			foreach ($comments as $comment) {

				$userId = $comment->userId();
				$userManager = new UserManager();
				
				echo'
					<div class="card border-primary">
						<p class="col-md-8">' . $comment->creationDate() . ' par ' . Str::secured($userManager->getPseudo($db, $userId)) . '</p>
						<h4 class="col-md-10">' . Str::secured($comment->title()) . '</h4>
						<p class="col-md-12">' . Str::secured($comment->content()) . '</p>
						<form method="post" action="./backindex.php?controller=moderate&action=validate">
							<input type="hidden" name="commentId" value="' . $comment->id() . '" />
							<button type="submit" class="btn">Valider le commentaire</button>
							<a href="./backindex.php?controller=moderate&action=delete&id=' . $comment->id() . '"><button type="button" class="btn">Supprimer le commentaire</button></a>
						</form>
					</div>';

			}

		} else {

			echo '
				<div class="card">
					Pas de nouveau commentaire.
				</div>';

		}

		
	}

	/* Validation d'un commentaire */
	public function validate() {

		$db = Manager::getDatabase();
		$commentId = (int) $_POST['commentId'];
		$commentManager = new CommentManager();

		if ($commentManager->idExist($db, $commentId)) {
			
			$commentManager->validate($db, $commentId);
		}

		header('Location: ./backindex.php?controller=moderate');
	}

	/* Suppression d'un commentaire */
	public function delete() {
		
		$db = Manager::getDatabase();
		$commentId = (int) $_GET['id'];
		$commentManager = new CommentManager();

		var_dump($commentManager->idExist($db, $commentId));

		if ($commentManager->idExist($db, $commentId)) {
			
			$commentManager->delete($db, $commentId);
		}

		header('Location: ./backindex.php?controller=moderate');
	}
}