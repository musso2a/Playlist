<!doctype html>
<html>
<head>

</head>
<body>

<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<?= $message ?><br>
		<?php endforeach;?>
	</div>
<?php endif;?>

ici formulaire de l'album<br><br>

- nom (champ text)<br>
- artist <br><br>
- année <br>


<form action="index.php?controller=albums&action=<?= isset($album) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

	<label for="name">Nom :</label>
	<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($album) ? $album['name'] : '' ?>" /><br>

	<label for="artist_id">Artist :</label>
	<select name="artist_id" id="artist_id">

		<?php foreach($artists as $artist): ?>
			<option value="<?= $artist['id']; ?>" <?php if(isset($album) && $album['artist_id'] == $artist['id']): ?>selected="selected"<?php endif; ?>><?= $artist['name']; ?></option>
		<?php endforeach; ?>

	</select><br>

	<label for="year">Année :</label>
	<input value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['biography'] : '' ?><?= isset($album) ? $album['year'] : '' ?>" name="year" id="year"><br>


	<input type="submit" value="Enregistrer" />

</form>

</body>

</html>