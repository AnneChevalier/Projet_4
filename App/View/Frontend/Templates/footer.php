<footer>
			<div class="row">
				<div class="col-md-4 vmargin text-center">
					<h4><a href="./index.php?controller=notice">Mentions Légales</a></h4>
				</div>
				<div class="col-md-4 vmargin text-center">
					<h4>Réseaux sociaux</h4>
					<a href=""><i class="fab fa-facebook-square"></i></a>
					<a href=""><i class="fab fa-twitter-square"></i></a>
					<a href=""><i class="fab fa-instagram"></i></a>
					<a href=""><i class="fab fa-linkedin"></i></a>
				</div>
				<div class="col-md-4 vmargin">
					<form method="post" action="./index.php?controller=contact&action=contactForm">
						<h4 class="text-center">Contact</h4>
						<div class="form-group">
							<label for="pseudo">Votre Nom/Pseudo :</label>
							<input type="text" name="pseudo" id="pseudo" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="email">Votre adresse email :</label>
							<input type="email" name="email" id="email" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="content">Votre message :</label>
							<textarea name="content" id="content" class="form-control"></textarea>
						</div>
						<button type="submit" class="btn">Envoyer</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					Ceci est un site étudiant
				</div>
			</div>
</footer>