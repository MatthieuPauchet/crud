
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Ajouter un vinyle</h1>
        </div>
        <form action="<?=site_url('discs/add_form/')?>" class="col-12" enctype="multipart/form-data" method="POST">
            <div class="col-12">
                Title : <input class="form-control" type="text" name="disc_title" placeholder="Enter title" required>
            </div>
            <div class="col-12">
                Artist : <select class="form-control" name="artist_id" size="1" required>
                    <?php
                    foreach ($artists as $ligne) { ?>
                        <option value=<?= $ligne->artist_id ?> ><?= $ligne->artist_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
                Year <input class="form-control" type="text" name="disc_year" placeholder="Enter year" required>
            </div>
            <div class="col-12">
                Genre <input class="form-control" type="text" name="disc_genre" placeholder="Enter genre" required>
            </div>
            <div class="col-12">
                Label<input class="form-control" type="text" name="disc_label" placeholder="Enter label" required>
            </div>
            <div class="col-12">
                Price <input class="form-control" type="text" name="disc_price" placeholder="Enter price" required>
            </div>
            <div class="col-12">
                Picture <input class="form-control" type="file" name="disc_picture" required>
            </div>
            <div class="col-12">
                <br>
                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="<?= site_url('discs/accueil/') ?>" class="btn btn-primary" role="button">Retour</a>
            </div>

        </form>
    </div>
</div>
