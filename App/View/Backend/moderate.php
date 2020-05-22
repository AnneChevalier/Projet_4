<div class="card border-danger vmargin">
	<div class="card-header border-danger">
		<h3 class="card-title text-danger">Les commentaires signalés</h3>
	</div>
	<div class="card-body">
		<?php ModerateController::displayReportedComments(); ?>
	</div>
</div>
<div class="card border-primary vmargin">
	<div class="card-header border-primary">
		<h3 class="card-title text-blue">Les nouveaux commentaires</h3>
	</div>
	<div class="card-body">
		<?php ModerateController::displayNewComments(); ?>
	</div>
</div>
