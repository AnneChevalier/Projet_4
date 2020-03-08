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

		<div class="resume">
			<p>Reprendre au marque-page</p>
		</div>

	<?php } ?>

	<div class="lastBook">
		
	</div>

	<div class="author">
		<h2>Jean Forteroche</h2>
		<p>Quibus ita sceleste patratis Paulus cruore perfusus reversusque ad principis castra multos coopertos paene catenis adduxit in squalorem deiectos atque maestitiam, quorum adventu intendebantur eculei uncosque parabat carnifex et tormenta. et ex is proscripti sunt plures actique in exilium alii, non nullos gladii consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum.</p>
		<img src="">
	</div>

	<div class="books">
		
	</div>

</div>