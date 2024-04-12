<?php

require('connect.php');

$query = "SELECT * FROM brands ORDER BY name ASC";
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
        <h1>Discover Sustainable Brands</h1>
        <p>Explore a curated selection of eco-friendly and ethically conscious fashion brands that align with your values.</p>
    </div>

    <main class="indexmain">
        <h2>Featured Brands</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No sustainable brands listed yet</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
            <div class="block">
                <h3><?= $row['name'] ?></h3>
                <p><?= $row['description'] ?></p>
                <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
            </div>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>
