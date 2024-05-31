<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div class="container-fluid-formCreateUser">
    <div class="container">
        <div id="createUser">
            <div class="row">
                <div class="connection-form col-md-4 d-flex flex-column justify-content-center ">
                    <form action="index.php?action=createUser" method="post" class="foldedCorner pb-4">
                        <h2>Inscription</h2>
                        <div class="formGrid pt-5">
                            <?php if($errorPseudo != ''){ ?>
                                <p class="text-danger strong"><?php echo 'Le pseudo précédement saisi est déjà utilisé.' ?></p>
                            <?php } ?>
                            <div class="mb-4">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input class="form-control" type="text" name="pseudo" id="pseudo" required>
                            </div>
                            <?php if($errorEmail != ''){ ?>
                                <p class="text-danger strong"><?php echo 'L\'email précédement saisi est déjà utilisé.'?></p>
                            <?php } ?>
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" name="email" id="email" required>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <button class="submit btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/form/form_create_connect_user.jpg" alt="étagère rempli de livre"/>
                </div>
            </div>
        </div>
    </div>
</div>