<div class="container-fluid-chat">
    <div class="container">
        <div id="chat">
            <div class="row">
                <div class="col-md-3 messaging pt-5">
                    <h1>Messagerie</h1>
                    <?php foreach ($conversations as $conversation): ?>
                        <div id="conversations" class="pb-3">
                            <a id="displayConversation" href="index.php?action=displayConversation&idConversation=<?php echo $conversation['id_conversation']; ?>&idContact=<?php echo $conversation['id_user']; ?>">
                                <div class="row pt-3">
                                    <div class="col-md-3 text-center">
                                        <img class="messagingPicture" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $conversation['img']; ?>" alt="Photo de profil"/>
                                    </div>
                                    <div class="col-md-9 d-flex justify-content-center flex-column">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <p><strong><?php echo $conversation['name']; ?></strong></p>
                                            </div>
                                            <div class="col-md-7">
                                                <span><?php echo $conversation['conversations'][0]->getDate(); ?></span>
                                            </div>
                                        </div>
                                        <div class="row contentMessaging">
                                            <p><?php echo $conversation['conversations'][0]->getContent(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="conversation" class="col-md-9 pt-3 pb-5">
                    <div>
                        <?php if(empty ($newConversations)): ?>
                            <div class="row dataMessage">
                                <div class="col-md-1 text-center d-flex align-items-center">
                                    <img class="messagingPicture" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $conversations[0]['img']; ?>"/>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <p><strong><?php echo $conversations[0]['name']; ?></strong></p>
                                </div>
                            </div>
                            <div class="scrollBar">
                                <?php foreach (array_reverse ($conversations[0]['conversations']) as $content):
                                    if($content->getIdOwner() === $_SESSION['user']->getId()): ?>
                                        <div class="message d-flex align-items-end flex-column">
                                            <span><?php echo $content->getDate(); ?></span>
                                            <div class="myMessage d-flex flex-column align-items-end">
                                                <p class="pt-2"><?php echo $content->getContent(); ?></p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="message d-flex align-items-start flex-column">
                                            <div class="row pb-1 pt-2">
                                                <div class="col-md-2"><img class="messagingPicture mini" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $conversations[0]['img']; ?>"/></div>
                                                <div class="col-md-10"><span><?php echo $content->getDate(); ?></span></div>
                                            </div>
                                            <div class="yourMessage">
                                                <p class="pt-2"><?php echo $content->getContent(); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <form class="row g-3 d-flex justify-content-center pt-5" action="index.php?action=postNewMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $conversations[0]['id_user']; ?>" method="post" class="foldedCorner" enctype="multipart/form-data">
                                <div class="col-md-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="message" id="message">
                                </div>
                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-primary mb-3">Envoyer</button>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-1 text-center d-flex align-items-center">
                                    <img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $newConversations['img']; ?>"/>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <p><strong><?php echo $newConversations['name']; ?></strong></p>
                                </div>
                            </div>
                            <form class="row pt-5" action="index.php?action=postNewMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $_SESSION['user']->getId(); ?>&idRecipient=<?php echo $newConversations['id_newContact']; ?>" method="post" class="foldedCorner" enctype="multipart/form-data">
                                <div class="col-md-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="message" id="message">
                                </div>
                                <div class="col-md-2 d-flex justify-content-center mt-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>