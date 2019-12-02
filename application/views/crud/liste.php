
<h1>page1</h1>    

<hr>


<?php foreach($liste as $artist): ?>

    <div>
        <a href="<?= site_url("crud/detail/") . $artist->artist_id ?>">
            <?= $artist->artist_name ?>
        </a>
    </div>

<?php endforeach; ?>