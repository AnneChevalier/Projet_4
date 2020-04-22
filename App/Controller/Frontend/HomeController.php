<?php

/*namespace Controller\Frontend;*/

require './App/Model/BookManager.php';
require './App/Model/ChapterManager.php';

use JFFram\Controller;
use JFFram\Manager;
use Model\BookManager;
use Model\ChapterManager;

class HomeController extends Controller {

	static function lastBookDetails() {

		$db = Manager::getDatabase();
		$bookManager = new BookManager();
		$lastBookId = $bookManager->getLastBookId($db);
		$book = $bookManager->getBook($db, $lastBookId);
		$chapterManager = new ChapterManager();
		$chapters = $chapterManager->getPublishedChapters($db, $lastBookId);

		if ($book->id() != 0) {
			echo '
				<div class="row">
					<div class="col-md-2">
						<div class="row">
							<div>
								<img class="bookcover" src="./Web/images/covers/' . $book->cover() . '"/>
							</div>
							<p>par : ' . $book->author() . '</p>
						</div>
					</div>
					<div class="col-md-10">
						<h3 class="col-md-5">' . $book->title() .'</h3>
						<p class="col-md-12">' . $book->resume() .'</p>
						<button type="button" data-toggle="collapse" data-target="#chapters' . $book->id() . '" aria-expanded="false" aria-controls="chapters' . $book->id() . '">
							<i class="fab fa-readme"></i>
						</button>
					</div>
					<div class="col-md-12 collapse" id="chapters' . $book->id() . '">
						<h5>Chapitre(s) Disponible(s)</h5>';

						foreach ($chapters as $chapter) {

						echo '
						<ol>	
							<li>
								<div class="row">
									<div class="col-md-4">' . $chapter->title() . ' publié le ' . $chapter->publicationDate() . '</div>
									
									<form method="post" action="./index.php?controller=reading" class="col-md-2">
										<input type="hidden" name="id" value="' . $chapter->id() . '"/>
										<button type="submit" class="btn">Lire</button>
									</form>
								</div>
							</li>
						</ol>';
						}

					echo 

					'</div>
				</div>
			';
		}
	}

	static function booksDetails() {

		$db = Manager::getDatabase();
		$bookManager = new BookManager();
		$chapterManager = new ChapterManager();
		$lastBookId = $bookManager->getLastBookId($db);

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

				$chapters = $chapterManager->getPublishedChapters($db, $book->id());

				if ($book->status() == 'online' && $book->id() != $lastBookId) {
					
					echo 

					'<div class="row">
						<div class="col-md-2">
							<div class="row">
								<div>
									<img class="bookcover" src="./Web/images/covers/' . $book->cover() . '"/>
								</div>
								<p>par : ' . $book->author() . '</p>
							</div>
						</div>
						<div class="col-md-10">
							<h3 class="col-md-6">' . $book->title() .'</h3>
							<p class="col-md-12">' . $book->resume() .'</p>
							<button type="button" data-toggle="collapse" data-target="#chapters' . $book->id() . '" aria-expanded="false" aria-controls="chapters' . $book->id() . '">
								<i class="fab fa-readme"></i>
							</button>
						</div>
						<div class="col-md-12 collapse" id="chapters' . $book->id() . '">
							<h5>Chapitre(s) Disponible(s)</h5>';

							foreach ($chapters as $chapter) {

							echo '
							<ol>	
								<li>
									<div class="row">
										<div class="col-md-4">' . $chapter->title() . ' publié le ' . $chapter->publicationDate() . '</div>
										
										<form method="post" action="./index.php?controller=reading" class="col-md-2">
											<input type="hidden" name="id" value="' . $chapter->id() . '"/>
											<button type="submit" class="btn">Lire</button>
										</form>
									</div>
								</li>
							</ol>';
							}

						echo 
						'	</div>
						</div>';
				}
				
			 }

		}

	}
	

}