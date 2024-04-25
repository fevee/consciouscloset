<?php

/*******w******** 
    
    Name: Faye Vaquilar
    Date: Feb 20, 2024
    Description: Web Dev 2 Assignment 3 Blog

****************/

require('connect.php');

$query = "SELECT * FROM blog ORDER BY date_posted DESC LIMIT 5";
$statement = $db->prepare($query);
$statement->execute();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <script src="script.js"></script>
    <title>Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-content">
        <h1>Welcome</h1>
        <p>Indulge in the vibrant world of fashion guilt-free! Our platform caters to fashion enthusiasts who seek to explore their style with their joy and conscience intact. 
            Explore style sustainably with our curated brand selection or shop our curated selection of secondhand pieces. Learn more about certifications or from our insightful blog.</p>
    </div>

    <main class="indexmain">
        <h2>Browse Recent Blog Posts</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No blog posts yet</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
            <div class="block">
            <h3>
                <a href="show.php?id=<?=$row['id']?>" class="titlelink"><?=$row['title']?></a>
            </h3>
            <?= date_format(date_create($row['date_posted']), "F j, Y G:i" ) ?>
            <small><a href="edit.php?id=<?=$row['id']?>">Edit</a></small><br>
            <?php if (!empty($row['image_path'])) : ?>
                <?php
                // Get the image name
                $image_name = basename($row['image_path']);
                ?>
                <img src="<?= $row['image_path'] ?>" alt="<?= $image_name ?>" class="post-image">
            <?php endif; ?>

            <p>
                <?php if(strlen($row['content']) > 500) : ?>
                    <?=substr($row['content'], 0, 500)?>
                    ... <small><a href="show.php?id=<?=$row['id']?>">Read more</a></small>
                <?php else: ?>
                        <?=$row['content'] ?>
                <?php endif ?>
            </p>
            </div>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>