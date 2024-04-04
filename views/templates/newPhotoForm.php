<div class="row pt-5">
    <div class="col-md-4">
        <form action="index.php?action=uploadProfilPicture" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="photo" id="fileUpload" class="form-control">
                <div class="form-text"> Seuls les formats .jpg, .jpeg, .jpeg, .png sont autorisés.</div>
            </div>
            <button id="btnSubmitAdmin" type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

