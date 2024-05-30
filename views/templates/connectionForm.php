<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div class="container-fluid-connection">
    <div class="container">
        <div id="connection">
            <div class="row">
                <div class="connection-form col-md-4 d-flex flex-column justify-content-center ">
                    <form action="index.php?action=connectUser" method="post" class="foldedCorner pb-4">
                        <h2>Connexion</h2>
                        <?php echo '' ?>
                        <?php if($error != ''){?>
                        <p class="text-danger strong"><?php echo $error ?></p>
                        <?php }?>
                        <div class="formGrid pt-5">
                            <div class="mb-4">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input class="form-control" type="text" name="pseudo" id="pseudo" required>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <button class="submit btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                    <p>Pas de compte ? <a href="index.php?action=createUserForm">inscrivez-vous</a></p>
                </div>
                <div class="col-md-8">
                    <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/form/form_create_connect_user.jpg" alt="étagère rempli de livre"/>
                </div>
            </div>
        </div>
    </div>
</div>
