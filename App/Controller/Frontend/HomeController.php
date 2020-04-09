<?php

/*namespace Controller\Frontend;*/

require './App/Model/BookManager.php';

use JFFram\Controller;
use JFFram\Manager;
use Model\BookManager;

class HomeController extends Controller {

	static function lastBookDetails() {

		$db = Manager::getDatabase();
		$manager = new BookManager();
		$lastBookId = $manager->getLastBookId($db);
		$book = $manager->getBook($db, $lastBookId);

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
						<h5>Chapitre(s) Disponible(s)</h5>
					</div>
				</div>
			';
		}
	}

	static function booksDetails() {

		$db = Manager::getDatabase();
		$manager = new BookManager();
		$lastBookId = $manager->getLastBookId($db);

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

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
							<h5>Chapitre(s) Disponible(s)</h5>
						</div>
					</div>';
				}
				
			 }

		}

	}
	

}