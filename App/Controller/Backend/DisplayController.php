<?php

use JFFram\Controller;
use JFFram\Manager;
use Model\ChapterManager;

class DisplayController extends Controller {
	
	static function displayChapter($id) {

		/*verifier que l'id existe bien*/

		$db = Manager::getDatabase();
		$manager = new ChapterManager();
		$chapter = $manager->getChapter($db, $id);
		$content = html_entity_decode($chapter->content());

		echo "<h3>" . $chapter->title() . "</h3>" . $content;

	}
}