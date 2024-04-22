<?php

require('connect.php');

$query = "SELECT * FROM brands ORDER BY brand_name ASC";
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
    <title>Sustainable Brands - Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?> 
    <?php include('nav.php') ?>

    <div class="hero-content">
        <h1>Explore Sustainable Brands</h1>
        <p>Discover a curated selection of eco-friendly and ethically conscious fashion brands that align with your values.</p>
    </div>

    <main class="indexmain">
        <h2>Featured Brands</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No sustainable brands listed yet</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
            <div class="brand">
                <?php if (!empty($row['image_path'])) : ?>
                    <?php
                    // Get the image name
                    $image_name = basename($row['image_path']);
                    ?>
                    <img src="<?= $row['image_path'] ?>" alt="<?= $image_name ?>" class="brand-image">
                <?php endif; ?>
                <div class="brand-info">
                    <h3><?= $row['brand_name'] ?></h3>
                    <p class="brand-description"><?= strlen($row['brand_description']) > 140 ? substr($row['brand_description'], 0, 140) . '...' : $row['brand_description'] ?><a href="show_brand.php?id=<?=$row['id']?>">Show</a>
</p>
                    <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
                    <p><a href="edit_brand.php?id=<?= $row['id'] ?>">Edit</a></p>
                </div>
            </div>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>
