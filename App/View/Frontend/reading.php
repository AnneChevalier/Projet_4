<?php

use JFFram\Session;

?>

<div class="row">
	<aside class="col-md-2 bg-light fixed-left sidebar-sticky position-fixed">
		<?php if(Session::getInstance()->read('auth')) {

			echo'
			<form method="post" action="./index.php?controller=bookmark&action=mark">
				<input type="hidden" name="userId" value="' . Session::getInstance()->getValue("auth")->id . '"/>
				<input type="hidden" name="chapterId" value="' . $_GET["id"] . '"/>
				<input type="submit" class="btn">
			</form>
			<div>marque page</div>';
			
		} ?>
	</aside>
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<?php ReadingController::displayChapter($_GET['id']); ?>
		<div>
			<?php if(Session::getInstance()->read('auth')) { ?>

				<form method="post" action="./index.php?controller=reading&action=addComment" class="row">
					<h4 class="col-md-7">Laissez un commentaire</h4>
					<input type="text" name="title" placeholder="titre du commentaire" required class="form-control" />
					<input type="hidden" name="userId" value="<?php echo Session::getInstance()->getValue("auth")->id; ?>"/>
					<input type="hidden" name="chapterId" value="<?=$_GET["id"]?>"/>
					<textarea name="content" placeholder="Ecrivez votre commentaire ici." required class="form-control"></textarea>
					<button type="submit" class="btn">Valider</button>
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
		<?php ReadingController::displayComments($_GET['id']); ?>
	</div>
</div>
