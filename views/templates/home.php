<?php
/**
 * Affichage de la home page.
 */
?>

<body>
    <div id="discover">
        <div class="row p-5">
            <div class="d-flex justify-content-center">
                <div class="col-md-3 d-flex flex-column justify-content-center m-5">
                    <h2>Rejoignez nos lecteur passionnés</h2>
                    <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
                    <div><a class="btn btn-primary" href="#">Découvrir</a></div>
                </div>
                <div class="col-md-3 m-5">
                    <img class="img-fluid" src="https://s3-alpha-sig.figma.com/img/4b93/0792/e67398fca2185c7e020225c880309454?Expires=1711324800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=iKF1aQUR2eTPqugwGyW0J0w6mCuIzq6d~gtPSulNYPDk87kj~7OZPkLVt-AG4A9MvPl3qHCOT6NiRJx~DBaD90Ixh0vTvoDJOwEpSBKo4oF98wyQhjwqK28XgXaU5sD~ul75wjZa2ooj3lqeuZyv7uc8gaxRxKnJc0f12ZIO-lPJqEho~xwj7igKRNP2CdeVJkMdExhKFzlM5pGfSF3EFsIcaHAAU5DK921iwp7FdwAhX7dnOjt6s7uZjgh2wd2Swtxg-iIaAZPe6jcDYzUqgxicdrHN-4c8erUA-COipd5z1kiUvDX6hVlvI-UdDU7vavOj0f1TkkNx0nJIgkQEKg__" alt="personne qui lit entouré de nombreux livres"/>
                </div>
            </div>
        </div>
    </div>
    <div id="lastBook" class="p-5">
        <div class="d-flex flex-column align-items-center">
            <h2>Les derniers livres ajoutés</h2>

            <div>
                <!--            ici on utilise la base de donnée pour afficher les dernier livres-->
            </div>
            <div><a class="btn btn-primary" href="#">Voir tous les livres</a></div>
        </div>
    </div>
    <div id="explanation" class="p-5">
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
        <div><img  src="https://s3-alpha-sig.figma.com/img/a139/99bc/4c3f0a4a254acb5010dd96d3fb7321e4?Expires=1711324800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=p8PTZUdrXlyO19l7mtrrX4IlcGi88B-jk51lrAFGbD84vUyPgAY4WQ3SeOytgjJhl4V9NYGrWhf1djwvlmgOdIh~h3pgUgsFsUwY-mO52e2dHAFkzH~Ei8FVODnvYOf3H71ibe7c3PaasT4Bj8v04yoUttABKlWWisVvDZPOxbdI8em4k2thIkGTk1atTBOikIjMF0jnFxAxKl9TLmfh1Jk551A7goFXCN0ldjlXE8swgBvzRaKeefF1fjjaaiLCzqwSdOz4hTMOPp8svpqh3NfH3BVFH9EY4BxIN2rgWRXHfYI5BM4Bl9KfOer-pAe8aqzoJ9HhmP-wCa15R1rOdA__" alt="une personne cherche un livre dans une bibliothéque"></div>
    </div>
    <div id="about" class="p-5">
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
