<form method="post" action="./backindex.php?controller=chapeditor&action=save">
	<input type="text" name="title" value="Titre du chapitre" />
	<textarea class="tinymce" name="content"></textarea>
	<input type="hidden" name="id" value=<?php echo '"' . $_GET['id'] . '"' ?>/>
	<button class="btn" type="submit">Enregister le chapitre</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="./Web/js/tinymce/tinymce.min.js"></script>
<script src="./Web/js/init_tinymce.js"></script>