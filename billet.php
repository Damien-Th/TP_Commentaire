<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    //nl2br = <br> retour à la ligne.
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>


