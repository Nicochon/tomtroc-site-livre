<div id="publicProfile">
    <div class="row">
        <div class="col-md-4">
            <img id="profilePicture" class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $userInfo['imgName'] ?>" alt="Photo de profil"/>
            <div class="info pt-5">
                <div><h3><?php echo $userInfo['pseudo'] ?></h3></div>
                <div>Membre depuis le <?php echo $userInfo['dateUser'] ?></div>
                <div><p>Bibiliotheque</p></div>
                <div><p><?php echo count($booksInfo) ?> livre(s)</p></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="books">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php forEach($booksInfo as $bookInfo){?>
                        <tr>
                            <th class="align-middle" scope="row"><img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/book/<?php echo $bookInfo['img'] ?>" alt="Photo du livre" width="150" height="150"/></th>
                            <td class="align-middle"><?php echo $bookInfo['title'] ?></td>
                            <td class="align-middle"><?php echo $bookInfo['author'] ?></td>
                            <td class="align-middle"><?php echo $bookInfo['content'] ?> ...</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>