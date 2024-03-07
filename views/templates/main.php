<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilie Forteroche</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>

<body>
<header>
    <nav>
        <div>
            <img src="#" alt="logo"/>
            <a href="index.php?action=home">Accueil</a>
            <a href="#">Nos livres à l'échange</a>
        </div>
        <div>
            <a href="#">Messagerie</a>
            <a href="#">Mon compte</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
            } else {
                echo '<a href="index.php?action=admin">Connexion</a>';
            }
            ?>

        </div>
    </nav>
</header>

<main>
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>

<footer>
    <a href="#">Politique de confidentialité</a>
    <a href="#">Mentions légales</a>
    <p>Tom Troc©</p>
</footer>

</body>
</html>