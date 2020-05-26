<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\BookManager;
use Model\ChapterManager;

class BasketController extends Controller {

	/* On récupère les éléments dont le statut est en corbeille */
	static function getlist() {

		$db = Manager::getDatabase();
		$bookManager = new BookManager();
		$deletedBooks = $bookManager->getDeletedBooks($db);
		$chapterManager = new chapterManager();
		$deletedChapters = $chapterManager->getDeletedChapters($db);

		/* Pour chaque livre de la corbeille on affiche un bouton restaurer et supprimer */
		foreach ($deletedBooks as $deletedBook) {
			
			echo
				'<tr>
					<td>' . Str::secured($deletedBook->title()) . ' crée le ' . $deletedBook->creationDate() . '</td>
					<td>
						<form method="post" action="./backindex.php?controller=basket&action=restore">
							<input type="hidden" name="entity" value="book"/> 
							<input type="hidden" name="id" value="' . $deletedBook->id() . '"/>
							<button type="submit" class="btn">Restaurer</button>
						</form>
					</td>
					<td>
						<form method="post" action="./backindex.php?controller=basket&action=delete">
							<input type="hidden" name="entity" value="book"/>
							<input type="hidden" name="id" value="' . $deletedBook->id() . '"/>
							<button type="submit" class="btn">Supprimer</button>
						</form>
					</td>
				</div>';
		}

		/* pour chaque chapitre de la corbeille on affiche un bouton restaurer et supprimer */
		foreach ($deletedChapters as $deletedChapter) {
			
			echo
				'<tr>
					<td>' . Str::secured($deletedChapter->title()) . ' crée le ' . $deletedChapter->creationDate() . '</td>
					<td>
						<form method="post" action="./backindex.php?controller=basket&action=restore">
							<input type="hidden" name="entity" value="chapter"/>
							<input type="hidden" name="id"  value="' . $deletedChapter->id() . '"/>
							<button type="submit" class="btn">Restaurer</button>
						</form>
					</td>
					<td>
						<form method="post" action="./backindex.php?controller=basket&action=delete">
							<input type="hidden" name="entity" value="chapter"/>
							<input type="hidden" name="id"  value="' . $deletedChapter->id() . '"/>
							<button type="submit" class="btn">Supprimer</button>
						</form>
					</td>
				</tr>';
		}
	}

	public function restore() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];
		$entity = $_POST['entity'];

		if ($entity == "book") {
			
			$manager = new BookManager();
			$manager->changeStatus($db, $id);

		} elseif ($entity == "chapter") {
			
			$manager = new ChapterManager();
			$manager->changeStatus($db, $id);
		}

		header('Location: ./backindex.php?controller=basket');

	}

	public function delete() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];
		$entity = $_POST['entity'];

		if ($entity == "book") {
			
			$manager = new BookManager();
			$manager->delete($db, $id);

		} elseif ($entity == "chapter") {
			
			$manager = new ChapterManager();
			$manager->delete($db, $id);
		}

		header('Location: ./backindex.php?controller=basket');

	}

	public function restoreAll() {

		$db = Manager::getDatabase();
		$bookManager = new BookManager();
		$chapterManager = new ChapterManager();
		$bookManager->restore($db);
		$chapterManager->restore($db);

		header('Location: ./backindex.php?controller=basket');

	}

	public function deleteAll() {

		$db = Manager::getDatabase();
		$bookManager = new BookManager();
		$chapterManager = new ChapterManager();
		$bookManager->deleteAll($db);
		$chapterManager->deleteAll($db);

		header('Location: ./backindex.php?controller=basket');

	}

}