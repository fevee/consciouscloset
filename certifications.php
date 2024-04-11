<?php

require('connect.php');

$query = "SELECT * FROM certifications ORDER BY name ASC";
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
    <title>Certifications - Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-content">
        <h1>Explore Ethical Certifications</h1>
        <p>Discover various ethical certifications that validate a brand's commitment to sustainability and ethical practices.</p>
    </div>

    <main class="indexmain">
        <h2>Featured Certifications</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No certifications listed yet</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
            <div class="block">
                <h3><?= $row['name'] ?></h3>
                <p><?= $row['description'] ?></p>
            </div>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>