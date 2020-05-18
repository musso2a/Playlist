<?php
 require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<?= $message ?><br>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<h2>ici la liste complète des albums : </h2>

<a href="index.php?controller=albums&action=new">Ajouter un nouvel album</a>

<?php foreach($albums as $album): ?>
	<p><?=  htmlspecialchars($album['name']) ?>
	<a href="index.php?controller=albums&action=edit&id=<?= $album['id'] ?>">modifier</a>
	<a href="index.php?controller=albums&action=delete&id=<?= $album['id'] ?>">supprimer</a></p>
<?php endforeach; ?>
