<?php

use JFFram\Session;

?>

<h1>Votre Compte</h1>

<p>Bonjour <?php echo Session::getInstance()->read('auth')->pseudo; ?></p>

<form action="./index.php?controller=account&action=changePassword" method="post">

	<div class="form-group">
		<input type="password" name="password" placeholder="Changer de mot de passe" class="form-control"/>
	</div>

	<div class="form-group">
		<input type="password" name="confpassword" placeholder="Confirmation du mot de passe" class="form-control"/>
	</div>
	<button type="submit" class="btn btn-primary">Changer le mot de passe</button>
	
</form>