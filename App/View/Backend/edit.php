<div class="row">
	<div id="booklist">
		<?php

		EditController::showbookcover();
		
		?>
	</div>
	<button id="createbook" class="btn" type="button" data-toggle="collapse" data-target="#addbook" aria-expanded="false" aria-controls="addbook">
		<i class="fas fa-plus"></i>
	</button>
</div>

<div id="addbook" class="collapse col-md-12">
	<form id="formAddBook" action="./backindex.php?controller=edit&action=createbook" method="post" enctype="multipart/form-data" class="row well">

		<div class="col-md-2">
			<div class="row">
				<div id="coverImg">
					<img id="cover" class="preview" alt="couverture par défaut" src="./Web/images/covers/default_cover.jpg"/>
				</div>
				<input type="file" name="cover" class="col-md-12 form-group" data-preview=".preview"/>
			</div>
			<input type="text" name="author" value="Jean Forteroche" class="col-md-12 form-group" />
		</div>
		
		<div class="col-md-10">
			<input type="text" name="title" placeholder="Titre" class="col-md-5 form-group" />
			<textarea id="resume" placeholder="Note de présentation du livre." name="resume" class="col-md-12 form-group"></textarea>
			<button type="submit" class="col-md-1 form-group btn">Valider</button>
		</div>

	</form>
</div>

<div id="bookdetails" class="col-md-12">

	<?php EditController::showbookdetails(); ?>
	
</div>

<div id="corbeille">
	<a href="./backindex.php?controller=basket"><button type="button" class="btn">Corbeille</button></a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="./Web/js/preview.js"></script>