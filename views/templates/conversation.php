<div class="container-fluid-newConversation">
    <div class="container">
        <div id="newConversation">
            <div class="row dataMessage">
                <div class="col-md-1 text-center d-flex align-items-center">
                    <img class="messagingPicture" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $conversation['img']; ?>"/>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <p><strong><?php echo $conversation['pseudo']; ?></strong></p>
                </div>
            </div>
            <div class="scrollBar">
                <?php foreach (array_reverse ($conversation['conversation']) as $content):
                    if($content->getIdOwner() === $_SESSION['user']->getId()): ?>
                        <div class="message d-flex align-items-end flex-column">
                            <span><?php echo $content->getDate(); ?></span>
                            <div class="d-flex align-items-end myMessage flex-column">
                                <p class="pt-2"><?php echo $content->getContent(); ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="message d-flex align-items-start flex-column">
                            <div class="row pb-1 pt-2">
                                <div class="col-md-2"><img class="messagingPicture mini" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $conversation['img']; ?>"/></div>
                                <div class="col-md-10"><span><?php echo $content->getDate(); ?></span></div>
                            </div>
                            <div class="yourMessage">
                                <p class="pt-2"><?php echo $content->getContent(); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <form class="row g-3 d-flex justify-content-center pt-5" action="index.php?action=postNewMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $conversation['id_recipient']; ?>" method="post" class="foldedCorner" enctype="multipart/form-data">
                <div class="col-md-10 d-flex align-items-center">
                    <input type="text" class="form-control" name="message" id="message">
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>