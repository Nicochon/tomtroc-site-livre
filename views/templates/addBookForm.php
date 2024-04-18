<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div id="addBook" class="pt-4">
    <?php if ($message !== null){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <div class="row p-5">
        <div class="connection-form col-md-4 d-flex flex-column justify-content-center ">
            <form action="index.php?action=addBook" method="post" class="foldedCorner" enctype="multipart/form-data">
                <h2>Ajouter Un Livre</h2>
                <div class="formGrid">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input class="form-control" type="text" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Auteur</label>
                        <input class="form-control" type="text" name="author" id="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Description</label>
                        <textarea class="form-control" id="content" name="textarea" rows="3"></textarea>
                    </div>
                    <div>
                        <label for="fileUploadBook" class="form-label">Image</label>
                        <input type="file" name="photo" id="fileUploadBook" class="form-control">
                        <div class="form-text"> Seuls les formats .jpg, .jpeg, .jpeg, .png sont autorisés.</div>
                    </div>
                    <div class="pt-3 pb-4">
                        <label for="availability" class="form-label">Indiquez la disponibilité de votre livre</label>
                        <select class="form-select" name="availability">
                            <option selected value="Disponible">Disponible</option>
                            <option value="Indisponible">Indisponible</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="submit btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/form/form_create_connect_user.jpg" alt="étagère rempli de livre"/>
        </div>
    </div>
</div>