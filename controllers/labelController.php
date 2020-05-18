<?php

require ('models/Label.php');
require ('models/Artist.php');

if(isset($_GEt['id']) ){

    $label = getLabel($_GET['id']);

    if($label==false) {

    }

    $artist=getArtists($_GET['id']);

    include ('views/label.php');
}
else {

}