<h2>Corbeille</h2>
<div>
	<?php BasketController::getlist(); ?>
</div>
<div>
	<button type="button" class="btn"><a href="./backindex.php?controller=basket&action=restoreAll">Tout Restaurer</a></button>	
	<button type="button" class="btn"><a href="./backindex.php?controller=basket&action=deleteAll">Tout Supprimer</a></button>
</div>