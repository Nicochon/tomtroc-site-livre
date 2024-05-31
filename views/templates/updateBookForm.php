<div class="container-fluid-addBook">
    <div class="container pt-5 pb-5">
        <h2>Modifier les informations</h2>
        <div id="addBook" class="pt-5 pb-5">
            <?php if ($message !== null): ?>
                <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 me-5 updatePhoto">
                        <img id="profilePicture" class="img-fluid" src="<?php echo ROOT_DIR; ?>/views/img/book/<?php echo $img['name']; ?>" alt="couverture du livre"/>
                        <div class="pt-3 text-end"><a id="getFormToLoad" href="index.php?action=updatePhotoForm&key=book&id=<?php echo $bookInfo['id']; ?>">Modifier la photo</a></div>
                        <div id="formToLoad"></div>
                </div>
                <div class="col-md-4 ms-5 d-flex flex-column justify-content-center connection-form formStyle">
                    <form action="index.php?action=updateBook&id=<?php echo $bookInfo['id']; ?>" method="post" class="foldedCorner" enctype="multipart/form-data">
                        <div class="formGrid">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input class="form-control" type="text" name="title" id="title" value="<?php echo $bookInfo['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Auteur</label>
                                <input class="form-control" type="text" name="author" id="author" value="<?php echo $bookInfo['author']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Commentaire</label>
                                <textarea class="form-control formContent" id="content" name="textarea" rows="3" value="<?php echo $bookInfo['content']; ?>"><?php echo $bookInfo['content']; ?></textarea>
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
            </div>
        </div>
    </div>
</div>