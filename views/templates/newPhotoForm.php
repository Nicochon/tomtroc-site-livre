<div class="row pt-5">
    <div class="col-md-4">
        <form action="index.php?action=uploadProfilPicture" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Choisir nouvelle photo de profil:</label>
                <input type="file" name="photo" id="fileUpload" class="form-control">
                <div id="emailHelp" class="form-text"> Seuls les formats .jpg, .jpeg, .jpeg, .png sont autorisés.</div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

