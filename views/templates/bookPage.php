<div class="container-fluid-littleTitlePage pb-3">
    <div class="container">
        <div class="row">
            <span>Nos livres > <?php echo $dataBook->getTitle(); ?></span>
        </div>
    </div>
</div>
<div class="container-fluid-bookPage">
    <div class="container">
        <div id="bookPage">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid bookImage" src="<?php echo ROOT_DIR; ?>/views/img/book/<?php echo $userPhoto; ?>"/>
                </div>
                <div class="col-md-5 dataBook p-5 ">
                    <h1><?php echo $dataBook->getTitle(); ?></h1>
                    <p class="dataBook-author pb-4">par <?php echo $dataBook->getAuthor(); ?></p>
                    <div class="style"></div>
                    <p class="section-Title">Description</p>
                    <p class="dataBook-content"><?php echo $dataBook->getContent(); ?></p>
                    <p class="section-Title">Proriétaire</p>
                    <a href="index.php?action=displayPublicProfile&id=<?php echo $dataOwner['id']; ?>">
                        <div class="row seller-badge">
                            <div class="col-md-4 p-2">
                                <img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $dataOwner['photo']; ?>"/>
                            </div>
                            <div class="col-md-5 pseudo-badge pt-4">
                                <p><?php echo $dataOwner['pseudo']; ?></p>
                            </div>
                        </div>
                    </a>
                    <div class=" btn-message d-flex justify-content-center">
                        <a class="btn btn-primary" href="index.php?action=displayMessage&idUser=<?php echo $idUser; ?>&idNewContact=<?php echo $dataOwner['id']; ?>">Envoyer un message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>