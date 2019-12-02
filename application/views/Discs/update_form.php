<div class="container-fluid">
    <div class="col-12">
        <h1>Modification</h1>
    </div>
    <form action="<?=site_url('discs/update_form/').$disc->disc_id ?>" class="col-12" method="POST" enctype="multipart/form-data">
        <div class="col-12">
            Title : <input class="form-control" type="text" name="disc_title" placeholder="Enter title" value="<?= $disc->disc_title ?>">
        </div>
        <div class="col-12">
            Artist : <select class="form-control" name="artist_id" size="1" value="<?= $disc->artist_name ?>">
                <?php foreach ($artists as $artist) : ?>
                    <option <?= ($artist->artist_id == $disc->artist_id) ? "selected" : "" ?> value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12">
            Year <input class="form-control" type="text" name="disc_year" placeholder="Enter year" value="<?= $disc->disc_year ?>">
        </div>
        <div class="col-12">
            Genre <input class="form-control" type="text" name="disc_genre" placeholder="Enter genre" value="<?= $disc->disc_genre ?>">
        </div>
        <div class="col-12">
            Label<input class="form-control" type="text" name="disc_label" placeholder="Enter label" value="<?= $disc->disc_label ?>">
        </div>
        <div class="col-12">
            Price <input class="form-control" type="text" name="disc_price" placeholder="Enter price" value="<?= $disc->disc_price ?>">
        </div>
        <div class="col-12">
            Picture <input class="form-control" type="file" name="disc_picture" value="<?= $disc->disc_picture ?>">
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Soumettre les modifications</button>
        <a href="<?= site_url('discs/detail/') . $disc->artist_id ?>" class="btn btn-secondary" role="button">Retour aux details</a>

        <input type="hidden" name="disc_id" value="<?= $disc->disc_id ?>">

    </form>



</div>