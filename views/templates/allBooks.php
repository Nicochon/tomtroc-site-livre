<div id="allBooks" class="pt-5">
    <div class="row">
        <div class="col-md-8"><h1>Nos livres à l'échange</h1></div>
        <div class="col-md-4 d-flex align-items-center">
            <form action="index.php?action=displayAllBooks" method="post" class="foldedCorner" enctype="multipart/form-data">
                <div class="input-group">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Recherche</button>
                    <input type="text" class="form-control" name="search" id="search">

                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($dataBooks)){?>
            <?php foreach ($dataBooks as $dataBook){?>
                <div class="col-md-3 p-5">
                    <a href="#">
                        <div><img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/book/<?php echo $dataBook['imgName'] ?>" alt="couverture du livre: <?php echo $dataBook['title']?>"/></div>
                        <div><p><?php echo $dataBook['title'] ?></p></div>
                        <div><p><?php echo $dataBook['author'] ?></p></div>
                        <div><p>Vendu par: <?php echo $dataBook['owner'] ?></p></div>
                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>