<div class="container-fluid">
    <div class="col-12">
        <h1>Details</h1>
    </div>
    <div class="row">
        <div class="col-4">

            <img class="img-thumbnail" src="<?= base_url("assets/images/") . $disc->disc_picture ?>">
        </div>
        <div class="col-8">
            <div class="row">


                <form action="<?= site_url("discs/delete_form/") ?>" class="col-12" enctype="multipart/form-data" method="POST">
                    <div class="col-12">
                        Title : <input class="form-control" type="text" name="disc_title" placeholder="Enter title" value="<?= $disc->disc_title ?>" readonly>
                    </div>

                    <!-- <div class="col-12">
                        Artist : <input class="form-control" type="text" name="artist_id" placeholder="Enter title" value="<?= $disc->artist_name ?>" readonly>
                    </div> -->

                    <div class="col-12">
                        Artist : <select class="form-control" name="artist_id" size="1" value="<?= $disc->artist_name ?>" disabled>
                            <?php foreach ($artists as $artist) : ?>
                                <option <?= ($artist->artist_id == $disc->artist_id) ? "selected" : "" ?> value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        Year <input class="form-control" type="text" name="disc_year" placeholder="Enter year" value="<?= $disc->disc_year ?>" readonly>
                    </div>
                    <div class="col-12">
                        Genre <input class="form-control" type="text" name="disc_genre" placeholder="Enter genre" value="<?= $disc->disc_genre ?>" readonly>
                    </div>
                    <div class="col-12">
                        Label<input class="form-control" type="text" name="disc_label" placeholder="Enter label" value="<?= $disc->disc_label ?>" readonly>
                    </div>
                    <div class="col-12">
                        Price <input class="form-control" type="text" name="disc_price" placeholder="Enter price" value="<?= $disc->disc_price ?>" readonly>
                    </div>
                    <hr>
                    <a href="<?= site_url('discs/update_form/') . $disc->disc_id ?>" class="btn btn-warning" role="button">Modifier</a>

                    <a href="<?= site_url('discs/delete_form/'). $disc->disc_id?>" class="btn btn-danger" > Supprimer </a>
                    <a href="<?= site_url('discs/accueil/') ?>" class="btn btn-secondary" role="button">Retour</a>

                    <input type="hidden" name="disc_id" value="<?= $disc->disc_id ?>">
            </div>

        </div>


        </form>

    </div>


</div>