<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
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
                <small><a href="edit_cert.php?id=<?=$certifications['id']?>">Edit</a></small><br>
                <div class="image-block">
                <?php if(!empty($certifications['image_path'])): ?>
                    <img src="<?=$certifications['image_path']?>" alt="<?=$certifications['name']?> logo" class="lrg-cert-image">
                <?php endif; ?>
                </div>
                <p><?=$certifications['description']?></p>
                <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
                <p><a href="certifications.php">Return</a></p>
            <?php else: ?>
                <p>No certification selected <a href="?id=1">Try this link</a></p>
            <?php endif ?>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>