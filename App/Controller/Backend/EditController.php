<?php

use JFFram\Controller;
use JFFram\Manager;
use JFFram\Str;
use JFFram\Validator;
use JFFram\Session;
use Model\BookManager;
use Model\ChapterManager;

class EditController extends Controller {

	public function createbook() {
		
		if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['resume'])) {

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

				array_push($errors, $validatorFile->getErrors());
			
			}
			
		} else {

			Session::getInstance()->setFlash('danger', "Il manque une information pour enregister le livre.");
			header('Location: ./backindex.php?controller=edit');
		}

	}

	static function showbookcover() {

		$db = Manager::getDatabase();

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

				echo 

				'<button type="button" data-toggle="collapse" data-target="#bookdetails' . $book->id() . '" aria-expanded="false" aria-controls="bookdetails' . $book->id() . '">
							<img class="bookcover" src="./Web/images/covers/' . $book->cover() . '"/>
				</button>';
				
			 }
		}

	}

	static function showbookdetails() {

		$db = Manager::getDatabase();

		if(!empty($books = BookManager::getBooks($db))) {
			foreach ($books as $book) {

				$chapters = ChapterManager::getAllChapters($db, $book->id());
				$bookId = $book->id();
				$hiddenBookId = Str::encrypt($bookId);

				echo 

					'<div id="bookdetails' . $book->id() . '" class="collapse row vmargin">
						<div class="col-md-2">
							<div class="row vmargin">
								<div>
									<img class="bookcover" src="./Web/images/covers/' . $book->cover() . '"/>
								</div>
								<p>par : ' . Str::secured($book->author()) . '</p>
							</div>
						</div>
						<div class="col-md-10">
							<h3 class="col-md-6">' . Str::secured($book->title()) .'</h3>
							<p class="col-md-12">' . Str::secured($book->resume()) .'</p>

							<div class="row vmargin">

								<div class="bookdetailsbtn">
									<button class="btn gray">
										<a href="./backindex.php?controller=chapeditor&id=' . $hiddenBookId . '" class="flex">
											<div class="textbtn">Nouveau Chapitre</div>
											<i class="fas fa-file editicon"></i>
										</a>
									</button>
								</div>

								<form method="post" action="./backindex.php?controller=edit&action=online" class="bookdetailsbtn">
									<input type="hidden" name="id" value="' . $book->id() . '"/>
									<button class="btn flex" type="submit">';

									if ($book->status() == "offline") {
										echo '<div class="textbtn">Mettre en ligne</div><i class="fas fa-toggle-off editicon"></i>';
									} else {
										echo '<div class="textbtn">Mettre hors ligne</div><i class="fas fa-toggle-on editicon"></i>';
									}
									echo '</button>
								</form>

								<div class="bookdetailsbtn">
									<button id="btneditbook' . $book->id() .'" class="btn flex">
										<div class="textbtn">Modifier</div>
										<i class="fas fa-pencil-alt editicon"></i>
									</button>
								</div>

								<form method="post" action="./backindex.php?controller=edit&action=basket" class="bookdetailsbtn">
									<input type="hidden" name="id" value="' . $book->id() . '"/>
									<button class="btn flex">
										<div class="textbtn">Supprimer</div>
										<i class="fas fa-trash-alt editicon"></i>
									</button>
								</form>
							</div>

						</div>
						<div class="row">
							<table>';

					foreach ($chapters as $chapter) {

						echo '

								<tr>
									<td>
										<div>' . Str::secured($chapter->title()) . ' crée le ' . $chapter->creationDate() . '</div>
									</td>
									<td>
										<form method="post" action="./backindex.php?controller=display">
											<input type="hidden" name="id" value="' . $chapter->id() . '"/>
											<button type="submit" class="btn flex">
												<div class="textbtn">Visualiser</div>
												<i class="fas fa-eye editicon"></i>
											</button>
										</form>
									</td>
									<td>
										<form method="post" action="./backindex.php?controller=chapeditor">
											<input type="hidden" name="id" value="' . $chapter->id() . '"/>
											<button type="submit" class="btn flex gray">
												<div class="textbtn">Modifier</div>
												<i class="fas fa-pencil-alt editicon"></i>
											</button>
										</form>
									</td>
									<td>
										<form method="post" action="./backindex.php?controller=chapeditor&action=online">
											<input type="hidden" name="id" value="' . $chapter->id() . '"/>
											<button class="btn flex" type="submit">';

											if ($chapter->status() == "offline") {
												echo '<div class="textbtn">Mettre en ligne</div><i class="fas fa-toggle-off editiconout"></i>';
											} else {
												echo '<div class="textbtn">Mettre hors ligne</div><i class="fas fa-toggle-on editicon"></i>';
											}
											echo '</button>
										</form>
									</td>
									<td>
										<form method="post" action="./backindex.php?controller=chapeditor&action=basket">
											<input type="hidden" name="id" value="' . $chapter->id() . '"/>
											<button type="submit" class="btn flex">
												<div class="textbtn">Supprimer</div>
												<i class="fas fa-trash-alt editicon"></i>
											</button>
										</form>
									</td>
								</tr>';
					}

					echo '
							</table>
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
								<input type="text" name="author" value="' . Str::secured($book->author()) . '" class="col-md-12 form-group" />
							</div>
							
							<div class="col-md-10">
								<input type="text" name="title" value="' . Str::secured($book->title()) .'" class="col-md-5 form-group" />
								<textarea id="resume" name="resume" class="col-md-12 form-group">' . Str::secured($book->resume()) . '</textarea>
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