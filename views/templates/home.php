<?php
/**
 * Affichage de la home page.
 */
?>

<body>
    <div id="discover">
        <div class="row p-5">
            <div class="d-flex justify-content-center">
                <div class="col-md-4 d-flex flex-column justify-content-center m-5">
                    <h1>Rejoignez nos lecteur passionnés</h1>
                    <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
                    <div><a class="btn btn-primary" href="#">Découvrir</a></div>
                </div>
                <div class="col-md-4 m-5">
                    <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/home/photoHome.jpeg" alt="personne qui lit entouré de nombreux livres"/>
                </div>
            </div>
        </div>
    </div>
    <div id="lastBook" class="pt-5 pb-5">
        <div class="text-center">
            <h2>Les derniers livres ajoutés</h2>
        </div>
        <div class="row">
            <?php if(!empty($books)){
                foreach ($books as $book){?>
                    <div class="col-md-3 p-5">
                        <div><img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/book/<?php echo $book['imgName'] ?>" alt="couverture du livre: <?php echo $book['title']?>"/></div>
                        <div><p><?php echo $book['title'] ?></p></div>
                        <div><p><?php echo $book['author'] ?></p></div>
                        <div><p>Vendu par: <?php echo $book['owner'] ?></p></div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="index.php?action=displayAllBooks">Voir tous les livres</a>
        </div>
    </div>
    <div id="explanation" class="pt-5">
        <div class="d-flex flex-column align-items-center">
            <h3>Comment ça marche ?</h3>
            <p>Echanger des livres avec TomTroc c'est simple et amusant ! suivez ces étapes pour commencer:</p>
            <div class="row text-center d-flex justify-content-center p-3">
                <div class="stage col-md-2 m-2 d-flex align-items-center"><p>Inscrivez-vous gratuitement.</p></div>
                <div class="stage col-md-2 m-2 d-flex align-items-center"><p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p></div>
                <div class="stage col-md-2 m-2 d-flex align-items-center"><p>Parcourz les livres disponibles chez d'autres membres.</p></div>
                <div class="stage col-md-2 m-2 d-flex align-items-center"><p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p></div>
            </div>
            <a class="btn btn-primary" href="#">Voir tous les livres</a>
        </div>
    </div>
    <div id="banner" class="">
        <div><img  src="<?php echo ROOT_DIR ?>/views/img/home/banner.png" alt="une personne cherche un livre dans une bibliothéque"></div>
    </div>
    <div id="about" class="pb-5">
        <div class="d-flex flex-column align-items-center">
            <div class="col-md-6">
                <h3>Nos valeurs</h3>
                <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.

                    Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.

                    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
                <span>L’équipe Tom Troc</span>
            </div>
        </div>
    </div>
</body>
