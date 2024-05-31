<?php
/**
 * Template pour afficher la page admin de l'utisateur.
 */
?>
<div id="popup"></div>
<div class="container-fluid-myAccount">
    <div class="container">
        <div id="myAccount" class="pt-5">
            <h2>Mon compte</h2>
            <div class="info row d-flex justify-content-around pt-5 pb-5 ">
                <div class="infoUser col-md-5 text-center d-flex flex-column align-items-center ">
                    <div class="userPhoto pt-5 pb-5">
                        <img id="profilePicture" class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/admin/<?php echo $userInfo['imgName']; ?>" alt="Photo de profil"/>
                        <div class="pt-3"><a id="getFormToLoad" href="index.php?action=updatePhotoForm&key=profile">Modifier</a></div>
                        <div id="formToLoad"></div>
                    </div>
                    <div class="info pt-5">
                        <div><h3><?php echo $userInfo['pseudo']; ?></h3></div>
                        <div class="dateMember">Membre depuis le <?php echo $userInfo['dateUser']; ?></div>
                        <div class="littleText"><span>Bibiliotheque</span></div>
                        <div class="row d-flex justify-content-center bookNumber">
                            <div class="col-md-2 text-end p-0"><img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/admin/vector.svg"/></div>
                            <div class="col-md-5 p-0"><p><?php echo count($booksInfo); ?> livre(s)</p></div>
                        </div>
                    </div>
                </div>
                <div class="newInfo infoUser col-md-5 p-5">
                    <h3>Vos informations personnelles</h3>
                        <div class="formGrid formStyle">
                            <form action="index.php?action=updateInfoUser" method="post" class="foldedCorner">
                                <div class="formGrid">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" name="email" id="email" value="<?php echo $userInfo['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input class="form-control" type="password" name="password" id="password" value="Nicolas" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pseudo" class="form-label">Pseudo</label>
                                        <input class="form-control" type="text" name="pseudo" id="pseudo" value="<?php echo $userInfo['pseudo']; ?>"  required>
                                    </div>
                                    <button class=" btnInfoUser submit btn btn-primary mt-3">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
            <div class="books">
                <table class="table table-striped table-hover custom-table">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Description</th>
                            <th scope="col">Disponibilité</th>
                            <th scope="col" colspan="2" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php forEach($booksInfo as $bookInfo):?>
                        <tr>
                            <th class="align-middle" scope="row"><img class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/book/<?php echo $bookInfo['img']; ?>" alt="Photo du livre" width="150" height="150"/></th>
                            <td class="align-middle"><?php echo $bookInfo['title']; ?></td>
                            <td class="align-middle"><?php echo $bookInfo['author']; ?></td>
                            <td class="align-middle"><?php echo $bookInfo['content']; ?> ...</td>
                            <td class="align-middle"><span class="<?php echo $bookInfo['availability'] === 'Disponible' ? 'available' : 'unavailable'; ?>"><?php echo $bookInfo['availability']; ?></span></td>
                            <td class="align-middle"><a class="edit" href="index.php?action=updateBookForm&id=<?php echo $bookInfo['id']; ?>">Editer</a></td>
                            <td class="align-middle"><a id="deleteBook" class="delete" href="index.php?action=deleteBookVerification&id=<?php echo $bookInfo['id']; ?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="addBook btn btn-primary pt-3 d-flex justify-content-center">
                <a href="index.php?action=addBookForm">Ajouter</a>
            </div>
        </div>
    </div>
</div>
