<?php
$comment = EditCommentController::getComment($_POST['commentId']);
?>

<form method="post" action="./index.php?controller=editComment&action=edit" class="row">
	<h4 class="col-md-7">Modifiez votre commentaire</h4>
	<input type="text" name="title" required class="form-control" value="<?=$comment->title()?>"/>
	<input type="hidden" name="chapterId" value="<?=$_POST['chapterId']?>"/>
	<input type="hidden" name="commentId" value="<?=$_POST['commentId']?>"/>
	<textarea name="content" required class="form-control"><?=$comment->content()?></textarea>
	<button type="submit" class="btn">Valider</button>
	<a href="./index.php?controller=reading&id=<?=$_POST['chapterId']?>"><button type="button" class="btn">Annuler</button></a>
</form>