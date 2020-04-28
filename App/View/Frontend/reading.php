<?php

use JFFram\Session;

?>

<div class="row">
	<aside class="col-md-2 bg-light fixed-left sidebar-sticky position-fixed">
		<?php if(Session::getInstance()->read('auth')) {

			echo'
			<form method="post" action="./index.php?controller=bookmark&action=mark">
				<input type="hidden" name="userId" value="' . Session::getInstance()->getValue("auth")->id . '"/>
				<input type="hidden" name="chapterId" value="' . $_POST["id"] . '"/>
				<input type="submit" class="btn">
			</form>
			<div>marque page</div>';
			
		} ?>
	</aside>
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<?php ReadingController::displayChapter($_POST['id']) ?>
	</div>
</div>
