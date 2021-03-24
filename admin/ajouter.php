<?php

include("connexionbdd.php");

if (!empty($_POST)) {
    $titre = $_POST['titre_billet'];
    $contenu = $_POST['contenu_billet'];
    date_default_timezone_set('Europe/Paris');
    $date_billet= date('Y-m-d H:i:s');
    
    $req = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation) VALUES (:titre, :contenu, :date_billet)');
    $req->execute(array(
    'titre' => $titre,
    'contenu' => $contenu,
    'date_billet' => $date_billet
    ));

    $req->closeCursor();
    header("location:javascript://history.go(-1)");
    
}
?>