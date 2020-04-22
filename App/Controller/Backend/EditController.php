<?php

/*namespace Controller\Backend;*/

require './App/Model/BookManager.php';
require './App/Model/ChapterManager.php';

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use JFFram\Validator;
use Model\BookManager;
use Model\ChapterManager;

class EditController extends Controller {

	public function createbook() {
		
		if (!empty($_POST)) {

			$errors = array();

			$db = Manager::getDatabase();

			$title = Str::secured($_POST['title']);
			$author = Str::secured($_POST['author']);
			$resume = Str::secured($_POST['resume']);

			$validatorFile = new Validator($_FILES);
			$validatorFile->isImage('cover', "Le type de fichier n'est pas valide.");

			if($validatorFile->isValid()) {

				$manager = new BookManager();
				$manager->add($db, $title, $author, $resume, $_FILES);

				header('Location: ./backindex.php?controller=edit');

			} else {

				array_push($errors, $validatorPost->getErrors(), $validatorFile->getErrors());
			
			}
			
		}

	}

	static function showbookcover() {

		$db = Manager::getDatabase();

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

				echo 

				'<div>
					
						<button type="button" data-toggle="collapse" data-target="#bookdetails' . $book->id() . '" aria-expanded="false" aria-controls="bookdetails' . $book->id() . '">
							<img class="bookcover" src="./Web/images/covers/' . $book->cover() . '"/>
						</button>
					
				</div>';
				
			 }
		}

	}

	static function showbookdetails() {

		$db = Manager::getDatabase();

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

				$chapters = ChapterManager::getAllChapters($db, $book->id());

				echo 

					'<div id="bookdetails' . $book->id() . '" class="collapse row">
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

							<div class="row">
								<div class="bookdetailsbtn">
									<button class="btn"><a href="./backindex.php?controller=chapeditor&id=' . $book->id() . '">Nouveau Chapitre</a></button>
								</div>
								<form method="post" action="./backindex.php?controller=edit&action=online" class="bookdetailsbtn">
									<input type="hidden" name="id" value="' . $book->id() . '"/>
									<button class="btn" type="submit">';

									if ($book->status() == "offline") {
										echo "Mettre en ligne";
									} else {
										echo "Mettre hors ligne";
									}
									echo '</button>
								</form>

								<div class="bookdetailsbtn">
									<button id="btneditbook' . $book->id() .'" class="btn">Modifier</button>
								</div>

								<form method="post" action="./backindex.php?controller=edit&action=basket" class="bookdetailsbtn">
									<input type="hidden" name="id" value="' . $book->id() . '"/>
									<button class="btn">Supprimer</button>
								</form>
							</div>

						</div>
						<div class="row">';

					foreach ($chapters as $chapter) {

						echo '	
						
							<div class="col-md-4">' . $chapter->title() . ' crée le ' . $chapter->creationDate() . '</div>
							<form method="post" action="./backindex.php?controller=display" class="col-md-2">
								<input type="hidden" name="id" value="' . $chapter->id() . '"/>
								<button type="submit" class="btn">Visualiser</button>
							</form>
							<form method="post" action="./backindex.php?controller=chapeditor" class="col-md-2">
								<input type="hidden" name="id" value="' . $chapter->id() . '"/>
								<button type="submit" class="btn">Modifier</button>
							</form>
							<form method="post" action="./backindex.php?controller=chapeditor&action=online" class="col-md-2">
								<input type="hidden" name="id" value="' . $chapter->id() . '"/>
								<button class="btn" type="submit">';

								if ($chapter->status() == "offline") {
									echo "Mettre en ligne";
								} else {
									echo "Mettre hors ligne";
								}
								echo '</button>
							</form>
							
							<form method="post" action="./backindex.php?controller=chapeditor&action=basket" class="col-md-2">
								<input type="hidden" name="id" value="' . $chapter->id() . '"/>
								<button type="submit" class="btn">Supprimer</button>
							</form>
							';
					}

					echo '

						</div>
					</div>

					<div id="editbook' . $book->id() . '" class="col-md-12 formEditBook">
						<form id="formEditBook' . $book->id() . '" action="./backindex.php?controller=edit&action=editbook" method="post" enctype="multipart/form-data" class="row well">

							<div class="col-md-2">
								<div class="row">
									<div id="coverImg">
										<img id="cover" class="preview" alt="couverture par défaut" src="./Web/images/covers/' . $book->cover() . '"/>
									</div>
									<input type="file" name="cover" class="col-md-12 form-group" data-preview=".preview"/>
								</div>
								<input type="text" name="author" value="' . $book->author() . '" class="col-md-12 form-group" />
							</div>
							
							<div class="col-md-10">
								<input type="text" name="title" value="' . $book->title() .'" class="col-md-5 form-group" />
								<textarea id="resume" name="resume" class="col-md-12 form-group">' . $book->resume() . '</textarea>
								<input type="hidden" name="id" value="' . $book->id() . '"/>
								<button type="submit" class="col-md-2 form-group btn">Modifier</button>
							</div>

						</form>
					</div>'

				;

				echo 
					'<script>

						var editbnt' . $book->id() . ' = document.getElementById("btneditbook' . $book->id() . '");
						var editbook' . $book->id() . ' = document.getElementById("editbook' . $book->id() . '");
						editbook' . $book->id() . '.style.display = "none";

						editbnt' . $book->id() . '.addEventListener("click", function(e){

							if (editbook' . $book->id() . '.style.display == "none") {

								editbook' . $book->id() . '.style.display = "block";

							} else {

								editbook' . $book->id() . '.style.display = "none";
							}
						});
					
					</script>';
				
			 }
		}
		
	}

	public function editbook() {

		$db = Manager::getDatabase();

		if (!empty($_POST)) {

			$errors = array();

			$title = Str::secured($_POST['title']);
			$author = Str::secured($_POST['author']);
			$resume = Str::secured($_POST['resume']);
			$id = $_POST['id'];

			if (!empty($_FILES['cover']['name'])) {

				$validatorFile = new Validator($_FILES);
				$validatorFile->isImage('cover', "Le type de fichier n'est pas valide.");

				if($validatorFile->isValid()) {

					$manager = new BookManager();
					$manager->update($db, $id, $title, $author, $resume, $_FILES);

					header('Location: ./backindex.php?controller=edit');

				} else {

					array_push($errors, $validatorFile->getErrors());
				
				}

			} else {

				$manager = new BookManager();
				$manager->update($db, $id, $title, $author, $resume);
				header('Location: ./backindex.php?controller=edit');

			}
			
		}

	}

	public function online() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new BookManager();
		$manager->changeStatus($db, $id);

		header('Location: ./backindex.php?controller=edit');
	}

	public function basket() {

		$db = Manager::getDatabase();
		$id = $_POST['id'];

		$manager = new BookManager();
		$manager->inBasket($db, $id);

		header('Location: ./backindex.php?controller=edit');
	}

}