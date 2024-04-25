<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet (show full blog post)

****************/

require('connect.php');

if(isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement ->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $blog = $statement->fetch();
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
    <title>Welcome to my Blog!</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main class="indexmain">
        <div class="block">
            <?php if($id): ?>
                <h1><?=$blog['title']?></h1>
                <time datetime="<?=$blog['date_posted']?>"><?=date_format(date_create($blog['date_posted']), 'F j, Y G:i') ?></time>
                <a href="edit.php?id=<?=$blog['id']?>">Edit</a>
                <?php if(!empty($blog['image_path'])): ?>
                    <img src="<?=$blog['image_path']?>" alt="Blog Image" style="max-width: 100%; height: auto;">
                <?php endif; ?>
                <p><?=$blog['content']?></p>
            <?php else: ?>
                <p>No blog selected <a href="?id=1">Try this link</a></p>
            <?php endif ?>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>