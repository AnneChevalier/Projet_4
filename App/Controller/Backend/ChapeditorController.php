<?php

/*namespace Controller\Backend;*/

require './App/Model/ChapterManager.php';

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
			$content = Str::secured($_POST['resume']);

			$manager = new ChapterManager();
			$manager->add($db, $bookId, $title, $content);

			header('Location: ./backindex.php?controller=edit');
			
		}
	}
}