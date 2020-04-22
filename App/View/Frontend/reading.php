<div class="row">
	<aside class="col-md-2 bg-light fixed-left sidebar-sticky position-fixed">
		<?php if(!Session::getInstance()->read('auth')) { ?>
			<div>marque page</div>
		<?php } ?>
	</aside>
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<?php ReadingController::displayChapter($_POST['id']) ?>
	</div>
</div>
