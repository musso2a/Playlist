<?php


require('models/Artist.php');
require('models/Album.php');
require('models/Song.php');

if ($_GET['action'] == 'list') {
    $songs = getAllSongs();
    require('views/songList.php');
} elseif ($_GET['action'] == 'new') {
    $albums = getAllAlbums();
    $artists = getAllArtists();
    require('views/songForm.php');
} elseif ($_GET['action'] == 'add') {

    if (empty($_POST['title']) || empty($_POST['artist_id'])) {

        if (empty($_POST['title'])) {
            $_SESSION['messages'][] = 'Le champ title est obligatoire !';
        }
        if (empty($_POST['artist_id'])) {
            $_SESSION['messages'][] = 'Le champ artist est obligatoire !';
        }

        $_SESSION['old_inputs'] = $_POST;
        header('Location:index.php?controller=songs&action=new');
        exit;
    } else {
        $resultAdd = addSong($_POST);

        $_SESSION['messages'][] = $resultAdd ? 'Chanson enregistré !' : "Erreur lors de l'enregistrement de la chanson... :(";

        header('Location:index.php?controller=songs&action=list');
        exit;
    }
} elseif ($_GET['action'] == 'edit') {
    $albums = getAllAlbums();
    $artists = getAllArtists();
    if (!empty($_POST)) {
        if (empty($_POST['title']) || empty($_POST['artist_id'])) {

            if (empty($_POST['title'])) {
                $_SESSION['messages'][] = 'Le champ title est obligatoire !';
            }
            if (empty($_POST['artist_id'])) {
                $_SESSION['messages'][] = 'Le champ Artist est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=songs&action=edit&id=' . $_GET['id']);
            exit;
        } else {
            $result = updateSong($_GET['id'], $_POST);
            $_SESSION['messages'][] = $result ? 'Chanson mis à jour !' : 'Erreur lors de la mise à jour... :(';
            header('Location:index.php?controller=songs&action=list');
            exit;
        }
    } else {
        if (!isset($_SESSION['old_inputs'])) {
            if (isset($_GET['id'])) {
                $song = getSong($_GET['id']);
                if ($song == false) {
                    header('Location:index.php?controller=songs&action=list');
                    exit;
                }
            } else {
                header('Location:index.php?controller=songs&action=list');
                exit;
            }
        }
        $songs = getAllSongs();
        require('views/songForm.php');
    }

} elseif ($_GET['action'] == 'delete') {
    if (isset($_GET['id'])) {
        $result = deleteSong($_GET['id']);
    } else {
        header('Location:index.php?controller=songs&action=list');
        exit;
    }

    $_SESSION['messages'][] = $result ? 'Chanson supprimée !' : 'Erreur lors de la suppression... :(';

    header('Location:index.php?controller=songs&action=list');
    exit;
}

