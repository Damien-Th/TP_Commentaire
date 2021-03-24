<?php include("entete.php"); ?>
<p><a href="index.php">Retour à la liste des billets</a></p>
 
<?php

include("connexionbdd.php");

// Connexion à la base de données

    // requête préparée car récupération d'un paramètre (id du billet)
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ? ');
    $req->execute(array($_GET['billet']));

    $donnees = $req->fetch();

    if (empty($donnees)) // si aucun id billet ne correspond au paramèter envoyé on afficghe un message d'erreur
    {   
        echo 'aucun billet ne correspond au paramètre saisi';
    } 
    else // un billet correspnd bien au paramètre envoyé
    {   
             ?>
<?php include("billet.php"); ?>
    </p>
</div>

        <h2>Commentaires</h2>

<?php
// Fin de la boucle des billets
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

////////////////////////////////////////////////////////////////////////////////////


$current_billet = $_GET['billet']; // le billet acutel

// on compte le nombre de colonne dont id-billet dans le billet actuel
$count = (int)$bdd->query('SELECT COUNT(id) FROM commentaires WHERE id_billet =' . $current_billet)->fetch(PDO::FETCH_NUM)[0];

// on configure la page actuel en créant un parametre dans URL
$currentPage = (int)($_GET['page'] ?? 1);
    if ($currentPage <= 0) {
        $currentPage = 1;
    } 
    
    // on calcule le nombre de pages.
    $perPage = 3;
    
    // avec ceil on arrondit le nombre au plus haut
    $pages = ceil($count / $perPage);
    $offset = $perPage * ($currentPage -1);  

    ?>
    <div class="page_nav">
    <p>Page :</p>
    <?php

    for ($i=1; $i<=$pages;$i++){
        if($currentPage > $pages){
            echo 'cette page n\'existe pas';
            break;
        }else {
            ?>
        <a href="commentaires.php?billet=<?php echo $current_billet ?>&page=<?php echo $i?>"> <?php echo $i ?></a>
       <?php

        }
    }
    ?>
    </div>
    <?php

// on récuper les élément de la table 
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = :id ORDER BY date_commentaire DESC LIMIT :limits OFFSET :offset');
$req->bindParam( ':id', $current_billet, PDO::PARAM_INT);
$req->bindParam( ':limits', $perPage, PDO::PARAM_INT);
$req->bindParam( ':offset', $offset, PDO::PARAM_INT);
$req->execute();

    while ($donnees = $req->fetch()) 
    {
        ?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>

<?php
    } 
// Fin de la boucle des commentaires
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$req->closeCursor();
?>  

<h3> laisser un commentaire </h3>

<form action="commentaires_post.php" method="post">

            <input type="hidden" name="id_value_post" value = "<?php echo($_GET['billet']); ?>"/>
            <p><input type="text" name="auteur_post" placeholder = "Votre nom"id="auteurPost"/></p>
            
            <p><textarea  rows="5" cols="33" name="commentaire_post" id="commentairePost"></textarea></p>
            <p><input type="submit" value="Envoyer"/></p>
        </form>

    <?php
    }
    ?>

</body>
</html>
