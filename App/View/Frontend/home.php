<?php

use JFFram\Session;

?>

<div class="home">

	<div class="banner">
		<div class="title">
			<h1>Jean Forteroche Website</h1>
			<h2>Billet simple pour l'Alaska</h2>
		</div>
			
	</div>

	<?php if(Session::getInstance()->read('auth')) { ?>

		<div class="resume bg-light hmargin">

			<?php HomeController::listBookmarks(Session::getInstance()->getValue("auth")->id) ?>

		</div>

	<?php } ?>

	<div id="lastBook" class="lastBook">

		<?php HomeController::lastBookDetails() ?>
		
	</div>

	<div id="author" class="author row bg-light">
		<div class="col-md-10">
			<h2>Jean Forteroche</h2>
			<p class="text-justify">Quibus ita sceleste patratis Paulus cruore perfusus reversusque ad principis castra multos coopertos paene catenis adduxit in squalorem deiectos atque maestitiam, quorum adventu intendebantur eculei uncosque parabat carnifex et tormenta. et ex is proscripti sunt plures actique in exilium alii, non nullos gladii consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum.</p>
			<p class="text-justify">Batnae municipium in Anthemusia conditum Macedonum manu priscorum ab Euphrate flumine brevi spatio disparatur, refertum mercatoribus opulentis, ubi annua sollemnitate prope Septembris initium mensis ad nundinas magna promiscuae fortunae convenit multitudo ad commercanda quae Indi mittunt et Seres aliaque plurima vehi terra marique consueta.</p>
		</div>
		<div class="col-md-2">
			<img class="jfPortrait" src="./Web/images/jf_portrait.jpg">
		</div>
	</div>

	<?php if(!Session::getInstance()->read('auth')) { ?>

		<div class="calltoaction row vmargin hmargin">
			<p class="hmargin">Inscrivez-vous pour ne rater aucun nouveau chapitre !</p>
			<button type="button" class="btn hmargin btnregister">
				<a href="./index.php?controller=register">S'inscrire</a>
			</button>
		</div>

	<?php } ?>

	<div class="books vmargin">

		<?php HomeController::booksDetails() ?>
		
	</div>

</div>