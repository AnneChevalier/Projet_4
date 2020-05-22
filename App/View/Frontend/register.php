<h1 class="vmargin hmargin">S'inscrire</h1>

<?php if (!empty($errors)) { ?>

	<div class="alert alert-danger">
		<p>Vous n'avez pas rempli le formulaire correctement</p>
		<ul>
		<?php foreach($errors as $error) { ?>
			
			<li><?= $error; ?></li>

		<?php }; ?>
		</ul>
	</div>

<?php } ?>


<form action="./index.php?controller=register&action=register" method="post" class="vmargin hmargin">

	<div class="form-group">
		<label for="pseudo">Pseudo</label>
		<input type="text" name="pseudo" id="pseudo" class="form-control" required/>
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" class="form-control" required/>
	</div>

	<div class="form-group">
		<label for="mdp">Mot de Passe</label>
		<input type="password" name="password" id="mdp" class="form-control" required/>
	</div>

	<div class="form-group">
		<label for="confmdp">Confirmer votre mot de passe</label>
		<input type="password" name="confpassword" id="confmdp" class="form-control" required/>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">M'inscrire</button>
	</div>
</form>