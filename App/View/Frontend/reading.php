<?php

use JFFram\Session;
use JFFram\Str;

$hiddenChapterId = $_GET["id"];
$chapterId = Str::decrypt($hiddenChapterId);

if (ReadingController::check($chapterId)) {?>
	<div class="row">
		<aside class="col-md-2 bg-light">
			<?php if(Session::getInstance()->read('auth')) {

				echo'
				<ul class="list-group row asiderow">
					<li class="list-group-item bg-light">
						<form method="post" action="./index.php?controller=bookmark&action=mark">
							<input type="hidden" name="userId" value="' . Session::getInstance()->getValue("auth")->id . '"/>
							<input type="hidden" name="chapterId" value="' . $chapterId . '"/>
							<button id="bmbtn" type="submit" class="bg-light row"><p class="btndetails">Marque page</p><i class="far fa-bookmark btnicon"></i></button>
						</form>
					</li>
				</ul>
				';
				
			} ?>
		</aside>
		<div class="col-md-10 vmargin">
			<?php ReadingController::displayChapter($chapterId); ?>
			<div>
				<?php if(Session::getInstance()->read('auth')) { ?>

					<form method="post" action="./index.php?controller=reading&action=addComment" class="row">
						<h4 class="col-md-7">Laissez un commentaire</h4>
						<input type="text" name="title" placeholder="titre du commentaire" required class="form-control" />
						<input type="hidden" name="userId" value="<?php echo Session::getInstance()->getValue("auth")->id; ?>"/>
						<input type="hidden" name="chapterId" value="<?=$_GET["id"]?>"/>
						<textarea name="content" placeholder="Ecrivez votre commentaire ici." required class="form-control vmargin"></textarea>
						<button type="submit" class="btn vmargin">Valider</button>
					</form>

				<?php } else { ?>

					<div>
						<p>Vous devez être connecté pour laisser un commentaire : </p>
						<button type="button" class="btn"><a href="./index.php?controller=login">Me connecter</a></button>
						<p>Je n'ai pas encore de compte : </p>
						<button type="button" class="btn"><a href="./index.php?controller=register">M'inscrire</a></button>
					</div>

				<?php } ?>
				
			</div>
			<?php ReadingController::displayComments($chapterId); ?>
		</div>
	</div>

<?php
} else {
	
	Session::getInstance()->setFlash('danger', "Ce chapitre n'est pas disponible.");
}


