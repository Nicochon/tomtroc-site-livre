<div id="chat">
    <div class="row">
        <div class="col-md-4">
            <h1>Messagerie</h1>
            <p>foreach de toute les conversation afficher que les noms photo heure du dernier message et dernier message</p>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/admin/"/>
                </div>
                <div class="col-md-3">
                    <p>pseudo</p>
                </div>
            </div>
            <form action="index.php?action=postNewMessage" method="post" class="foldedCorner" enctype="multipart/form-data">
                <div class="input-group">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Recherche</button>
                    <input type="text" class="form-control" name="message" id="message">
                </div>
            </form>
        </div>
    </div>
</div>