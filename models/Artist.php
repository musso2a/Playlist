<?php
function getArtists($artistId = null){

    $db = dbConnect();

    $query = $db->query('SELECT * FROM artists');
    $artists = $query->fetchAll();
    return $artists;
}

function getArtist($id){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM artists WHERE id = ?');
    $artist = $query->execute( [ $id ] );
    if ($artist){
        return $query->fetch();
    }else {
        return false;
    }
}

//function getArtists($label_id = false)
//{
//    $db = dbConnect();
//    if($label_id){
//
//        $query=$db->prepare("
//        SELECT a.*
//        FROM artists a
//        JOIN artists_labels al ON a.id = al.artist_id
//        WHERE al.label_id = ?
//        ");
//        $query->execute([
//            $label_id
//        ]);
//
//
//    }
//    else {
//
//    }
//}
