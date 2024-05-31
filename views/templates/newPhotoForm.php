<div class="row pt-5">
    <div class="col-md-4">
        <?php if($type === 'profile'): ?>
            <form action="index.php?action=uploadProfilPicture" method="post" enctype="multipart/form-data">
        <?php else:  ?>
            <form action="index.php?action=uploadBookPicture&id=<?php echo $idBook; ?>" method="post" enctype="multipart/form-data">
                <?php endif; ?>
            <div class="mb-3">
                <input type="file" name="photo" id="fileUpload" class="form-control">
                <div class="form-text"> Seuls les formats .jpg, .jpeg, .jpeg, .png sont autorisés.</div>
            </div>
            <button id="btnSubmitAdmin" type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

