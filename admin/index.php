
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Admin Page</h1>
        

<?php
// Connexion à la base de données

include("connexionbdd.php");

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch()) {
    ?>

<div class="news">
<div class="billet">
<h3>
    <?php echo htmlspecialchars($donnees['titre']); ?>
    <em>le <?php echo $donnees['date_creation_fr']; ?></em>
</h3>

<p>
<?php
// On affiche le contenu du billet
//nl2br = <br> retour à la ligne.
echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
<br />
<em><a href="http://localhost/tests/tpCommentaire/commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
</p>
</div>
<div class="edit">
<form action="modifier.php" method="post">
<input type="hidden" value= "<?php echo $donnees['id']; ?>" name="billet_delete"/>
<input type="submit" value="EDIT">
</form>
<form action="supprimer.php" method="post">
<input type="hidden" value= "<?php echo $donnees['id'];?>" name="billet_delete"/>
<input type="submit" value="DELETE">
</form>
</div>
</div>
<?php
}

include("ajouter.php");

include("supprimer.php");



?>

<h3> ajouter un billet </h3>

<form action="ajouter.php" method="post">
            <p><input type="text" placeholder= "titre" name="titre_billet"/></p>
            <p><textarea  rows="5" cols="33" name="contenu_billet" placeholder="contenue"></textarea></p>
            <p><input type="hidden" value= "<?php echo $date_billet;?>" name="date_billet"/></p>
            <p><input type="submit" value="Envoyer"/></p>
        </form>
</body>
</html>