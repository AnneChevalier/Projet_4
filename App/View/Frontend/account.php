<?php

use JFFram\Session;

?>

<div class="hmargin">

	<h1>Mon Compte</h1>

	<p>Bonjour <?php echo Session::getInstance()->read('auth')->pseudo; ?> !</p>

	<h3>Mes informations :</h3>

	<p>Pseudo : <?php echo Session::getInstance()->read('auth')->pseudo; ?></p>
	<p>Adresse Email : <?php echo Session::getInstance()->read('auth')->email; ?></p>

	<h4>Modifier mes informations : </h4>

	<form method="post" action="./index.php?controller=account&action=updatePseudo">
		<div class="form-group">
			<label>Changer mon pseudo :</label>
			<input type="text" name="pseudo" class="form-control"/>
			<button type="submit" class="btn vmargin">Valider</button>
		</div>
	</form>
	<form method="post" action="./index.php?controller=account&action=updateEmail">
		<div class="form-group">
			<label>Changer mon adresse email :</label>
			<input type="email" name="email" class="form-control"/>
			<button type="submit" class="btn vmargin">Valider</button>
		</div>
	</form>

	<h4>Changer mon mot de passe :</h4>

	<form action="./index.php?controller=account&action=changePassword" method="post">

		<div class="form-group">
			<label>Ancien mot de passe :</label>
			<input type="password" name="oldpassword" class="form-control"/>
		</div>

		<div class="form-group">
			<label>Nouveau mot de passe :</label>
			<input type="password" name="password" class="form-control"/>
		</div>

		<div class="form-group">
			<label>Confirmation du nouveau mot de passe :</label>
			<input type="password" name="confpassword" class="form-control"/>
		</div>
		<button type="submit" class="btn">Valider</button>
		
	</form>

	<?php if (!Session::getInstance()->read('auth')->admin) {?>

		<a href="./index.php?controller=account&action=delete"><button type="button" class="btn vmargin">Supprimer mon compte</button></a>
	<?php } ?>

</div>