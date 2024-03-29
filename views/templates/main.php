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
    <title>TomTroc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_DIR ?>/views/css/front.css"/>
</head>

<body>
<div class="container">
    <header>
        <nav>
            <div class="row">
                <div class="col">
                    <div class="row nav">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="col-md-1"><img src="<?php echo ROOT_DIR ?>/views/img/home/logo.png" alt="logo"/></div>
                            <div class="col-md-3"><a href="index.php?action=home" class="logo">Tom Troc</a></div>
                            <div class="col-md-2"><a href="index.php?action=home">Accueil</a></div>
                            <div class="col-md-4"><a href="#">Nos livres à l'échange</a></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row nav">
                        <div class="d-flex justify-content-end align-items-center">
                            <?php if (isset($_SESSION['user'])) {?>
                                <div class="col-md-3"><a href="index.php?action=admin">Mon compte</a></div>
                                <div class="col-md-3"><a href="#">Messagerie</a></div>
                                <div class="col-md-3"><a href="index.php?action=disconnectUser">Déconnexion</a></div>
                            <?php } else { ?>
                                <div class="col-md-2"><a href="index.php?action=admin">Connexion</a></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>
        <div class="row pt-3">
            <div class="d-flex justify-content-end">
                <div class="col-md-2"><a href="#">Politique de confidentialité</a></div>
                <div class="col-md-2 d-flex justify-content-center "><a href="#">Mentions légales</a></div>
                <div class="col-md-1"><p>Tom Troc©</p></div>
            </div>
        </div>
    </footer>
</div>


</body>
</html>