<div class="container-fluid-allBooks">
    <div class="container">
        <div id="allBooks" class="pt-5">
            <div class="row">
                <div class="col-md-8"><h1>Nos livres à l'échange</h1></div>
                <div class="col-md-4 d-flex align-items-center">
                    <form action="index.php?action=displayAllBooks" method="post" class="foldedCorner" enctype="multipart/form-data">
                        <div class="input-group">
                            <button type="submit" name="submit" class="btn searchBook btn-outline-secondary">Recherche un livre</button>
                            <input type="text" class="form-control" name="search" id="search">

                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-between pt-4 pb-1">
                <?php if (!empty($dataBooks)): ?>
                    <?php foreach ($dataBooks as $dataBook): ?>
                        <div class="col-md-2 col-4 m-4 p-0 book-card">
                            <a href="index.php?action=displayBook&idBook=<?php echo $dataBook['idBook']; ?>">
                                <div><img class="img-fluid" src="<?php echo ROOT_DIR ?>/views/img/book/<?php echo $dataBook['imgName']; ?>" alt="couverture du livre: <?php echo $dataBook['title']; ?>"/></div>
                                <div class="title-book-card"><p><?php echo $dataBook['title']; ?></p></div>
                                <div class="author-book-card"><p><?php echo $dataBook['author']; ?></p></div>
                                <div class="seller-book-card"><p>Vendu par: <?php echo $dataBook['owner']; ?></p></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>