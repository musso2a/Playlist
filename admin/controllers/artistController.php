<?php 

require('models/Artist.php');
require('models/Label.php');

if($_GET['action'] == 'list'){
	$artists = getAllArtists();
	require('views/artistList.php');
}
elseif($_GET['action'] == 'new'){
	$labels = getAllLabels();
	require('views/artistForm.php');
}
elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['name']) || empty($_POST['label_id'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		if(empty($_POST['label_id'])){
			$_SESSION['messages'][] = 'Le champ label est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=artists&action=new');
		exit;
	}
	else{
		$resultAdd = add($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Artiste enregistré !' : "Erreur lors de l'enregistrement de l'artiste... :(";
		
		header('Location:index.php?controller=artists&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){
	
	if(!empty($_POST)){
		if(empty($_POST['name']) || empty($_POST['label_id'])){
		
			if(empty($_POST['name'])){
				$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
			}
			if(empty($_POST['label_id'])){
				$_SESSION['messages'][] = 'Le champ label est obligatoire !';
			}
			
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=artists&action=edit&id=' . $_GET['id']);
			exit;
		}
		else{
			$result = update($_GET['id'], $_POST);
			$_SESSION['messages'][] = $result ? 'Artiste mis à jour !' : 'Erreur lors de la mise à jour... :(';
			header('Location:index.php?controller=artists&action=list');
			exit;
		}
	}
	else{
		if(!isset($_SESSION['old_inputs'])){
			if(isset($_GET['id'])){
				$artist = getArtist($_GET['id']);
				if($artist == false){
					header('Location:index.php?controller=artists&action=list');
					exit;
				}
			}
			else{
				header('Location:index.php?controller=artists&action=list');
				exit;
			}
		}
		$labels = getAllLabels();
		require('views/artistForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	if(isset($_GET['id'])){
		$result = delete($_GET['id']);
	}
	else{
		header('Location:index.php?controller=artists&action=list');
		exit;
	}

	$_SESSION['messages'][] = $result ? 'Artiste supprimé !' : 'Erreur lors de la suppression... :(';
	
	header('Location:index.php?controller=artists&action=list');
	exit;
}

