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
<?php endif; ?>

ici formulaire de la chanson<br><br>

- Title <br>
- Artiste <br>
- Album <br><br>


<form action="index.php?controller=songs&action=<?= isset($song) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

	<label for="name">Titre :</label>
	<input  type="text" name="title" id="title" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['title'] : '' ?><?= isset($song) ? $song['title'] : '' ?>" /><br>

	<label for="artist_id">Artist :</label>
	<select name="artist_id" id="artist_id">

		<?php foreach($artists as $artist): ?>
			<option value="<?= $artist['id']; ?>" <?php if(isset($song) && $song['artist_id'] == $artist['id']): ?>selected="selected"<?php endif; ?>><?= $artist['name']; ?></option>
		<?php endforeach; ?>

	</select><br>
    <label for="album_id">Album :</label>
    <select name="album_id" id="album_id">

        <?php foreach($albums as $album): ?>
            <option value="<?= $album['id']; ?>" <?php if(isset($song) && $song['artist_id'] == $album['id']): ?>selected="selected"<?php endif; ?>><?= $album['name']; ?></option>
        <?php endforeach; ?>

    </select><br>
	<input type="submit" value="Enregistrer" />

</form>

</body>

</html>