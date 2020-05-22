<?php

use JFFram\Session;

?>

<h1>Paramètres du compte d'administration</h1>

<?php

if (Session::getInstance()->read('auth')->admin) {?>
	
	<h3>Informations :</h3>

	<p>Pseudo : <?php echo Session::getInstance()->read('auth')->pseudo; ?></p>
	<p>Adresse Email : <?php echo Session::getInstance()->read('auth')->email; ?></p>

	<h4>Modifier mes informations : </h4>

	<form method="post" action="./backindex.php?controller=setting&action=updatePseudo">
		<div class="form-group">
			<label>Changer mon pseudo :</label>
			<input type="text" name="pseudo" class="form-control"/>
			<button type="submit" class="btn vmargin">Valider</button>
		</div>
	</form>
	<form method="post" action="./backindex.php?controller=setting&action=updateEmail">
		<div class="form-group">
			<label>Changer mon adresse email :</label>
			<input type="email" name="email" class="form-control"/>
			<button type="submit" class="btn vmargin">Valider</button>
		</div>
	</form>

	<h4>Changer mon mot de passe :</h4>

	<form action="./backindex.php?controller=setting&action=changePassword" method="post">

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

<?php
}

?>