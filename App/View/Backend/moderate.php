<div id="reportedCom" class="row">
	<div class="alert alert-block alert-danger col-md-11">
		<h3>Les commentaires signalés</h3>
	</div>
	<div class="col-md-11">
		<?php ModerateController::displayReportedComments(); ?>
	</div>
</div>
<div id="newCom" class="row">
	<div class="alert alert-block alert-primary col-md-11">
		<h3>Les nouveaux commentaires</h3>
	</div>
	<div class="col-md-11">
		<?php ModerateController::displayNewComments(); ?>
	</div>
</div>
