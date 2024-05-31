<div class="container-fluid-publicProfile">
    <div class="container">
        <div id="publicProfile">
            <div class="row pt-5">
                <div class="col-md-4 infoUser text-center d-flex flex-column align-items-center ">
                    <div class="userPhoto pt-5 pb-5">
                        <img id="profilePicture" class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $userInfo['imgName']; ?>" alt="Photo de profil"/>
                    </div>
                    <div class="info pt-5">
                        <div><h3><?php echo $userInfo['pseudo']; ?></h3></div>
                        <div class="dateMember">Membre depuis le <?php echo $userInfo['dateUser']; ?></div>
                        <div class="littleText"><span>Bibiliotheque</span></div>
                        <div class="row d-flex justify-content-center bookNumber">
                            <div class="col-md-2 text-end p-0"><img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/admin/vector.svg"/></div>
                            <div class="col-md-5 p-0"><p><?php echo count($booksInfo); ?> livre(s)</p></div>
                        </div>
                        <a class="btn btn-primary" href="index.php?action=displayMessage&idUser=<?php echo $_SESSION['user']->getId(); ?>&idNewContact=<?php echo $userInfo['idUser']; ?>">Contacter</a>
                    </div>
                </div>
                <div class="col-md-8 pb-5">
                    <div class="books">
                        <table class="table table-striped table-hover custom-table">
                            <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($booksInfo as $bookInfo):?>
                                <tr>
                                    <th class="align-middle" scope="row"><img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/book/<?php echo $bookInfo['img']; ?>" alt="Photo du livre" width="150" height="150"/></th>
                                    <td class="align-middle"><?php echo $bookInfo['title']; ?></td>
                                    <td class="align-middle"><?php echo $bookInfo['author']; ?></td>
                                    <td class="align-middle"><?php echo $bookInfo['content']; ?> ...</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>