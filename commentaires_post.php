<?php

$id_value = $_POST['id_value_post']; 
$auteur = $_POST['auteur_post'];
$commentaire = $_POST['commentaire_post'];
date_default_timezone_set('Europe/Paris');
$date_commentaire = date('Y-m-d H:i:s');

// Connexion à la base de données

include("connexionbdd.php");

$req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES (:id_value, :auteur, :commentaire, :date_commentaire)');
$req->execute(array(
    'id_value' => $id_value,
    'auteur' => $auteur,
    'commentaire' => $commentaire,
    'date_commentaire' => $date_commentaire
    ));

$req->closeCursor();
// retour à la page commentaire.php
header("location:" . $_SERVER['HTTP_REFERER']);

?>