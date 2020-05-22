<div class="loginForm">

	<form class="form" action="./backindex.php?controller=login&action=login" method="post">

		<div class="form-group title">

			<h1>Jean Forteroche</h1>

			<p>Connexion à l'administration</p>

		</div>

		<div class="form-group">
					
			<label for="user_name">Nom d'utilisateur :</label>

			<input class="form-control" type="text" name="user_name" id="user_name" />

		</div>

		<div class="form-group">
					
			<label for="mdp">Mot de passe :</label>

			<input class="form-control" type="password" name="password" id="mdp" />

		</div>

		<button type="submit" class="btn btn-primary">Connexion</button>

		<p><a href="./index.php?controller=forget">Mot de passe oublié ?</a></p>

	</form>

</div>