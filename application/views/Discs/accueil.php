

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <h1>Liste des disques <?= count($liste) ?></h1>
        </div>
        <div class="col-2">
            <a href="<?=site_url('discs/add_form/')?>" class="btn btn-primary" role="button">Ajouter</a>
        </div>
    </div>
    <div class="row">
        <?php
        
        foreach ($liste as $ligne) { ?>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="row">
                    <div class="col-6">

                        <img class="img-thumbnail" src="<?= base_url("assets/images/").$ligne->disc_picture ?>">
                    </div>
                    <div class="col-6">


                        <h5><?= $ligne->disc_title ?></h5>
                        <h6><?= $ligne->artist_name ?></h6>
                        <div> label : <?= $ligne->disc_label ?></div>
                        <div> year : <?= $ligne->disc_year ?></div>
                        <div> Genre : <?= $ligne->disc_genre ?></div>

                        <a role="button" class="btn btn-primary" href="<?=site_url('discs/detail/').$ligne->disc_id ?>" name="<?= $ligne->disc_id ?>"> Détails </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
