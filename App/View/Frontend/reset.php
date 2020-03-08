<h1>Réinitialiser le mot de passe</h1>

<form action="./index.php?controller=reset&action=reset" method="post">

	<div class="form-group">

		<label for="mdp">Nouveau mot de passe</label>

		<input type="password" name="password" id="mdp" class="form-control" required/>

	</div>

	<div class="form-group">

		<label for="confmdp">Confirmer votre nouveau mot de passe</label>

		<input type="password" name="confpassword" id="confmdp" class="form-control" required/>

	</div>

	<div class="form-group">

		<button type="submit" class="btn btn-primary">Réinitialiser</button>

	</div>

</form>