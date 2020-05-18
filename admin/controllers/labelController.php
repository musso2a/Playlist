<?php


require('models/Artist.php');
require('models/Label.php');


if ($_GET['action'] == 'list') {
    $labels = getAllLabels();
    require('views/labelList.php');
} elseif ($_GET['action'] == 'new') {
    require('views/labelForm.php');
} elseif ($_GET['action'] == 'add') {

    if (empty($_POST['name'])) {

        if (empty($_POST['name'])) {
            $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
        }

        $_SESSION['old_inputs'] = $_POST;
        header('Location:index.php?controller=labels&action=new');
        exit;
    } else {
        $resultAdd = addlabel($_POST);

        $_SESSION['messages'][] = $resultAdd ? 'Label enregistré !' : "Erreur lors de l'enregistrement du label... :(";

        header('Location:index.php?controller=labels&action=list');
        exit;
    }
} elseif ($_GET['action'] == 'edit') {

    if (!empty($_POST)) {
        if (empty($_POST['name'])) {

            if (empty($_POST['name'])) {
                $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=labels&action=edit&id=' . $_GET['id']);
            exit;
        } else {
            $result = updateLabel($_GET['id'], $_POST);
            $_SESSION['messages'][] = $result ? 'Label mis à jour !' : 'Erreur lors de la mise à jour... :(';
            header('Location:index.php?controller=labels&action=list');
            exit;
        }
    } else {
        if (!isset($_SESSION['old_inputs'])) {
            if (isset($_GET['id'])) {
                $label = getLabel($_GET['id']);
                if ($label == false) {
                    header('Location:index.php?controller=labels&action=list');
                    exit;
                }
            } else {
                header('Location:index.php?controller=labels&action=list');
                exit;
            }
        }
        $labels = getAllLabels();
        require('views/labelForm.php');
    }

} elseif ($_GET['action'] == 'delete') {
    if (isset($_GET['id'])) {
        $result = deletelabel($_GET['id']);
    } else {
        header('Location:index.php?controller=labels&action=list');
        exit;
    }

    $_SESSION['messages'][] = $result ? 'Label supprimé !' : 'Erreur lors de la suppression... :(';

    header('Location:index.php?controller=labels&action=list');
    exit;
}

