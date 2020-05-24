<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use Model\ChapterManager;

class DisplayController extends Controller {
	
	static function displayChapter($id) {

		$db = Manager::getDatabase();
		$manager = new ChapterManager();

		if ($manager->idExist($db, $id)) {
			
			$chapter = $manager->getChapter($db, $id);
			$content = html_entity_decode($chapter->content());

			echo "<h3>" . Str::secured($chapter->title()) . "</h3>" . $content;

		} else {

			$session->setFlash('danger', "Oups... Ce chapitre n'existe pas encore...");

			header('Location: ./backindex.php?controller=edit');
		}
		

	}
}