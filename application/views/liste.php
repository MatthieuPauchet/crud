<!-- application/views/liste.php -->

    
<?php $data = array("Donna Lee", "So What", "Maiden Voyage", "Kind of Blue", "A Night in Tunisia"); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Liste des produits</title>
</head>

<body>
    <h1>Liste des produits</h1>
    <ol>
        <?php foreach ($data as $value) { ?>
            <li>
                <?= $value ?>
            </li>
        <?php } ?>
    </ol>
    <!-- <p>Bonjour <?= $data ?> !</p> -->

</body>

</html>