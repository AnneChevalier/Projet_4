<h1 class="vmargin hmargin">Se connecter</h1>

<form action="./index.php?controller=login&action=login" method="post" class="vmargin hmargin">

	<div class="form-group">

		<label for="email">Email</label>

		<input type="email" name="email" id="email" class="form-control" required/>

	</div>

	<div class="form-group">

		<label for="mdp">Mot de Passe</label>

		<input type="password" name="password" id="mdp" class="form-control" required/>

	</div>

	<div class="form-group">

		<button type="submit" class="btn btn-primary">Se Connecter</button>

	</div>

</form>

<p class="vmargin hmargin"><a href="./index.php?controller=forget">Mot de passe oublié</a></p>