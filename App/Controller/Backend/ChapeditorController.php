<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\ChapterManager;

class ChapeditorController extends Controller {

	
	public function save() {
		
		if (!empty($_POST)) {

			$errors = array();

			$db = Manager::getDatabase();

			$bookId = $_POST['id'];
			$title = Str::secured($_POST['title']);
			$content = Str::secured($_POST['content']);

			$manager = new ChapterManager();
			$manager->add($db, $bookId, $title, $content);

			header('Location: ./backindex.php?controller=edit');
			
		}
	}

	static function editChapter($chapid) {

		$db = Manager::getDatabase();

		$chapter = ChapterManager::getChapter($db, $chapid);

		echo '
		<form method="post" action="./backindex.php?controller=chapeditor&action=edit">
			<input type="text" name="title" value="' . $chapter->title() . '"/>
			<textarea class="tinymce" name="content">' . $chapter->content() . '</textarea>
			<input type="hidden" name="id" value="' . $chapter->id() . '"/>
			<button class="btn" type="submit">Modifier le chapitre</button>
			<button class="btn"><a href="./backindex.php?controller=edit">Annuler</a></button>
		</form>
		';

		

	}

	public function edit() {

		$db = Manager::getDatabase();

		if (!empty($_POST)) {

			$errors = array();

			$title = Str::secured($_POST['title']);
			$content = Str::secured($_POST['content']);
			$id = $_POST['id'];

			$manager = new ChapterManager();
			$manager->update($db, $id, $title, $content);

			header('Location: ./backindex.php?controller=edit');
		
		}
	}

	public function basket() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new ChapterManager();
		$manager->inBasket($db, $id);

		header('Location: ./backindex.php?controller=edit');

	}

	public function display() {

	}

	public function online() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new ChapterManager();
		$manager->changeStatus($db, $id);

		header('Location: ./backindex.php?controller=edit');
	}
}