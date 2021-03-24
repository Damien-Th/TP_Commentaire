
<?php

include("connexionbdd.php");

if (!empty($_POST)) {
    $billet_delete = $_POST['billet_delete'];

    $req = $bdd->prepare("DELETE FROM billets WHERE id = $billet_delete");
    $req->execute();
    $req->closeCursor();
}

?>