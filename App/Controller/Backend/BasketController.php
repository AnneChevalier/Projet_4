<?php
/*namespace Controller\Backend;*/

require './App/Model/BookManager.php';

use JFFram\Controller;
use JFFram\Manager;
use Model\BookManager;

class BasketController extends Controller {
	
	static function getlist() {

		$db = Manager::getDatabase();
		$manager = new BookManager();
		$deletedBooks = $manager->getDeletedBooks($db);

		foreach ($deletedBooks as $deletedBook) {
			
			echo
				'<div class="row">
					<div class="col-md-6">' . $deletedBook->title() . ' crée le ' . $deletedBook->creationDate() . '</div>
					<form method="post" action="./backindex.php?controller=basket&action=restore" class="col-md-2">
						<input type="hidden" name="id"  value="' . $deletedBook->id() . '"/>
						<button type="submit" class="btn">Restaurer</button>
					</form>
					<form method="post" action="./backindex.php?controller=basket&action=delete" class="col-md-2">
						<input type="hidden" name="id"  value="' . $deletedBook->id() . '"/>
						<button type="submit" class="btn">Supprimer</button>
					</form>
				</div>';
		}
	}

	public function restore() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new BookManager();
		$manager->changeStatus($db, $id);

		header('Location: ./backindex.php?controller=basket');

	}

	public function delete() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new BookManager();
		$manager->delete($db, $id);

		header('Location: ./backindex.php?controller=basket');

	}

	public function restoreAll() {

		$db = Manager::getDatabase();
		$manager = new BookManager();
		$manager->restore($db);

		header('Location: ./backindex.php?controller=basket');

	}

	public function deleteAll() {

		$db = Manager::getDatabase();
		$manager = new BookManager();
		$manager->deleteAll($db);

		header('Location: ./backindex.php?controller=basket');

	}

}