<?php

require('connect.php');

if(isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM certifications WHERE id = :id";
    $statement = $db->prepare($query);
    $statement ->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $certifications = $statement->fetch();
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
    <title><?=$certifications['name']?></title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main class="indexmain">
        <div class="block">
            <?php if($id): ?>
                <h1><?=$certifications['name']?></h1>
                <small><a href="edit_cert.php?id=<?=$certifications['id']?>">Edit</a></small>
                <?php if(!empty($certifications['image_path'])): ?>
                    <img src="<?=$certifications['image_path']?>" alt="<?=$certifications['name']?> logo" style="max-width: 100%; height: auto;">
                <?php endif; ?>
                <p><?=$certifications['description']?></p>
            <?php else: ?>
                <p>No certification selected <a href="?id=1">Try this link</a></p>
            <?php endif ?>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>