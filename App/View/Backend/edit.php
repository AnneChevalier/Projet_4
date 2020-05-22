<div class="row vmargin">
	<div>
		<?php

		EditController::showbookcover();
		
		?>
	</div>
	<button id="createbook" class="btn" type="button" data-toggle="collapse" data-target="#addbook" aria-expanded="false" aria-controls="addbook">
		<i class="fas fa-plus"></i>
	</button>
</div>

<div id="addbook" class="collapse col-md-12 vmargin hmargin">
	<form id="formAddBook" action="./backindex.php?controller=edit&action=createbook" method="post" enctype="multipart/form-data" class="row well">

		<div class="col-lg-2">
			<div class="row">
				<div id="coverImg col-md-12">
					<img id="cover" class="preview" alt="couverture par défaut" src="./Web/images/covers/default_cover.jpg"/>
				</div>
				<input type="file" name="cover" class="col-md-12 form-group center" data-preview=".preview" required/>
			</div>
			<input type="text" name="author" value="Jean Forteroche" class="col-md-12 form-group" required/>
		</div>
		
		<div class="col-lg-10">
			<input type="text" name="title" placeholder="Titre" class="col-md-5 form-group vmargin" required/>
			<textarea id="resume" placeholder="Note de présentation du livre." name="resume" class="col-md-12 form-group vmargin" required></textarea>
			<button type="submit" class="form-group btn">Valider</button>
		</div>

	</form>
</div>

<div id="bookdetails" class="col-md-12 vmargin">

	<?php EditController::showbookdetails(); ?>
	
</div>

<div id="corbeille" class="vmargin">
	<a href="./backindex.php?controller=basket"><button type="button" class="btn basketbtn">Corbeille</button></a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="./Web/js/preview.js"></script>