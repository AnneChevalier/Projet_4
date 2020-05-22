<?php
$comment = EditCommentController::getComment($_POST['commentId']);
?>

<form method="post" action="./index.php?controller=editComment&action=edit" class="row">
	<h4 class="col-md-7">Modifiez votre commentaire</h4>
	<input type="text" name="title" required class="form-control hmargin" value="<?=$comment->title()?>"/>
	<input type="hidden" name="chapterId" value="<?=$_POST['chapterId']?>"/>
	<input type="hidden" name="commentId" value="<?=$_POST['commentId']?>"/>
	<textarea name="content" required class="form-control hmargin vmargin"><?=$comment->content()?></textarea>
	<button type="submit" class="btn hmargin vmargin">Valider</button>
	<a href="./index.php?controller=reading&id=<?=$_POST['chapterId']?>"><button type="button" class="btn hmargin vmargin">Annuler</button></a>
</form>