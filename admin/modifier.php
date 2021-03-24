

<?php

include("connexionbdd.php");

if (!empty($_POST)) {
    $billet_delete = $_POST['billet_delete'];
    $titre_billet = $_POST['titre_billet'];
    $contenue = $_POST['contenu_billet'];


    $req = $bdd->prepare("UPDATE billets SET titre = '$titre_billet', contenu= '$contenue' WHERE ID = $billet_delete");
    $req->execute();
    $req->closeCursor();
}
?>


<h3> ajouter un billet </h3>

<form action="modifier.php" method="post">
            <p><input type="text" placeholder= "titre" name="titre_billet"/></p>
            <p><textarea  rows="5" cols="33" name="contenu_billet" placeholder="contenue"></textarea></p>
            <p><input type="hidden" value= "<?php echo $billet_delete;?>" name="billet_delete"/></p>
            <p><input type="submit" value="Envoyer"/></p>
        </form>

