<?php
/**
 * Template pour afficher la page admin de l'utisateur.
 */
?>

<div id="myAccount" class="pt-5">
    <h2>Mon compte</h2>
    <div class="info row d-flex justify-content-around pt-5">
        <div class="infoUser col-md-4 text-center d-flex flex-column align-items-center ">
            <div class="userPhoto pt-5 pb-5">
                <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/<?php echo $userInfo['imgName'] ?>" alt="Photo de profil"/>
                <div class="pt-3"><a href="index.php?action=updatePhotoForm">Modifier</a></div>
            </div>
            <div class="info pt-5">
                <div><h3><?php echo $userInfo['pseudo'] ?></h3></div>
                <div>Membre depuis le <?php echo $userInfo['dateUser'] ?></div>
                <div>nombre de livre: ...</div>
            </div>
        </div>
        <div class="newInfo infoUser col-md-4 p-5">
            <h3>Vos informations personnelles</h3>
                <div class="formGrid">
                    <form action="index.php?action=updateInfoUser" method="post" class="foldedCorner">
                        <div class="formGrid">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" name="email" id="email" value="<?php echo $userInfo['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input class="form-control" type="password" name="password" id="password" value="************" required>
                            </div>
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input class="form-control" type="text" name="pseudo" id="pseudo" value="<?php echo $userInfo['pseudo'] ?>"  required>
                            </div>
                            <button class="submit btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
    <div class="pt-5">
        <table class="table table-striped table-hover">
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
            <tr>
                <th scope="row">Donnée 1</th>
                <td>Donnée 2</td>
                <td>Donnée 3</td>
                <td>Donnée 4</td>
                <td>Donnée 5</td>
                <td>Editer</td>
                <td>Supprimer</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
