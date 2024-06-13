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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_DIR; ?>/views/css/front.css"/>
    <script src="<?php echo ROOT_DIR; ?>/views/js/front.js"></script>
</head>

<body>
<div class="container-fluid-header">
    <div class="container">
        <header>
            <nav class="nav navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand logo pe-5" href="index.php?action=home"><img class="logoIcon me-1" src="<?php echo ROOT_DIR; ?>/views/img/home/logo.png" alt="logo"/>Tom Troc</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="col-md-6">
                            <ul class="navbar-nav">
                                <li class="nav-item pe-5">
                                    <a class="nav-link" href="index.php?action=home">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=displayAllBooks">Nos livres à l'échange</a>
                                </li>
                            </ul>
                        </div>
                       <div class="col-md-6">
                           <ul class="navbar-nav d-flex justify-content-end">
                               <?php if (isset($_SESSION['user'])): ?>
                                   <li class="nav-item pe-5">
                                       <a class="nav-link" href="index.php?action=displayMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>"><img class="icon_mon_compte pe-1" src="<?php echo ROOT_DIR; ?>/views/img/home/icon_messagerie.png" alt="logo"/>Messagerie</a>
                                   </li>
                                   <li class="nav-item pe-5">
                                       <a class="nav-link" href="index.php?action=admin"><img class="icon_mon_compte pe-1" src="<?php echo ROOT_DIR; ?>/views/img/home/icon_mon_compte.png" alt="logo"/>Mon compte</a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link" href="index.php?action=disconnectUser">Déconnexion</a>
                                   </li>
                               <?php else: ?>
                                   <li class="nav-item">
                                       <a class="nav-link" href="index.php?action=admin">Connexion</a>
                                   </li>
                               <?php endif; ?>
                           </ul>
                       </div>
                    </div>

                </div>
            </nav>
        </header>
    </div>
</div>


<main>
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>


<div class="container-fluid-footer">
    <footer>
        <div class="row d-flex justify-content-end pt-3">
                <div class="col-md-2 col-sm-12 text-center"><a href="#">Politique de confidentialité</a></div>
                <div class="col-md-1 col-sm-12 text-center"><a href="#">Mentions légales</a></div>
                <div class="col-md-1 col-sm-12 text-center"><p>Tom Troc©</p></div>
                <div class="col-md-1 col-sm-12 text-center"><img src="<?php echo ROOT_DIR; ?>/views/img/home/logo2.svg"/></div>
        </div>
    </footer>
</div>


</body>
</html>