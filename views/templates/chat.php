<div id="chat">
    <div class="row">
        <div class="col-md-4">
            <h1>Messagerie</h1>
            <?php foreach ($conversations as $conversation){ ?>
                <a id="displayConversation" href="index.php?action=displayConversation&idConversation=<?php echo $conversation['id_conversation'] ?>&idContact=<?php echo $conversation['id_user'] ?>">
                    <div class="row">

                        <div class="col-md-4">
                            <img id="profilePicture" class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $conversation['img'] ?>" alt="Photo de profil"/>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-7">
                                    <p><?php echo $conversation['name']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>date</p>
                                </div>
                            </div>
                            <p><?php echo $conversation['conversations'][0]->getContent()?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <div id="conversation">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $conversations[0]['img'] ?>"/>
                    </div>
                    <div class="col-md-3">
                        <p><?php echo $conversations[0]['name'] ?></p>
                    </div>
                </div>
                <?php foreach (array_reverse ($conversations[0]['conversations']) as $content){
                    if($content->getIdOwner() === $_SESSION['user']->getId()){ ?>
                        <div class="d-flex justify-content-end">
                            <p class="text-right"><?php echo $content->getContent(); ?></p>
                        </div>
                    <?php } else { ?>
                        <div>
                            <p><?php echo $content->getContent(); ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <form action="index.php?action=postNewMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $conversations[0]['id_user']; ?>" method="post" class="foldedCorner" enctype="multipart/form-data">
                    <div class="input-group">
                        <button type="submit" name="submit" class="btn btn-outline-secondary">Envoyer</button>
                        <input type="text" class="form-control" name="message" id="message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>