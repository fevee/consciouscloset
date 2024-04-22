<?php

require('connect.php');

if(isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM brands WHERE id = :id";
    $statement = $db->prepare($query);
    $statement ->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $brands = $statement->fetch();
}
else {
    $id = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?=$brands['brand_name']?></title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main class="indexmain">
        <div class="block">
            <?php if($id): ?>
                <h1><?=$brands['brand_name']?></h1>
                <small><a href="edit_brand.php?id=<?=$brands['id']?>">Edit</a></small><br>
                <div class="image-block">
                    <?php if(!empty($brands['image_path'])): ?>
                        <img src="<?=$brands['image_path']?>" alt="<?=$brands['brand_name']?> clothing" class="lrg-brand-image">
                    <?php endif; ?>
                </div>
                <p><?=$brands['brand_description']?></p>
                <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
            <?php else: ?>
                <p>No brand selected <a href="?id=1">Try this link</a></p>
            <?php endif ?>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>