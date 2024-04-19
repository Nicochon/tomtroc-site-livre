<div id="bookPage">
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/book/<?php echo $userPhoto?>"/>
        </div>
        <div class="col-md-6">
            <h1><?php echo $dataBook->getTitle(); ?></h1>
            <p>par <?php echo $dataBook->getAuthor(); ?></p>
            <p><?php echo $dataBook->getContent(); ?></p>
            <p>Proriétaire</p>
            <a href="index.php?action=displayPublicProfile&id=<?php echo $dataUser['id'] ?>">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $dataUser['photo'] ?>"/>
                    </div>
                    <div class="col-md-3">
                        <p><?php echo $dataUser['pseudo']; ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>