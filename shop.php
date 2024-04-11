<?php

require('connect.php');

$query = "SELECT * FROM items ORDER BY date_posted DESC";
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
    <title>Shop Secondhand - Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-content">
        <h1>Explore Curated Secondhand Items</h1>
        <p>From vintage classics to modern staples, our curated selection of secondhand items offers sustainable style for every taste. Give pre-loved items a new life.</p>
    </div>

    <main class="indexmain">
        <h2>Featured Items</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No items listed yet</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
            <div class="block">
                <h3><?= $row['name'] ?></h3>
                <p>Size: <?= $row['size'] ?></p>
                <p><?= $row['description'] ?></p>
                <p>Brand: <?= $row['brand'] ?></p>
                <p>Category: <?= $row['category'] ?></p>
                <?php if (!empty($row['image_path'])) : ?>
                    <?php
                    // Get the image name
                    $image_name = basename($row['image_path']);
                    ?>
                    <img src="<?= $row['image_path'] ?>" alt="<?= $image_name ?>" class="item-image">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>
