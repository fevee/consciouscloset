<?php

require('connect.php');

// Check if a category filter is specified in the URL
if(isset($_GET['category'])) {
    // Retrieve the category value from the URL
    $category = $_GET['category'];

    // Prepare SQL query to select items based on the specified category
    $query = "SELECT * FROM items WHERE category = :category AND isSold = 0 ORDER BY date_posted DESC";
    $statement = $db->prepare($query);
    $statement->bindValue(':category', $category, PDO::PARAM_STR);
} else {
    // Default SQL query to select all items if no category filter is specified
    $query = "SELECT * FROM items WHERE isSold = 0 ORDER BY date_posted DESC";
    $statement = $db->prepare($query);
}
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/luminous-basic.min.css">
    <title>Shop Secondhand with Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-content">
        <h1>Explore Curated Secondhand Items</h1>
        <p>From vintage classics to modern staples, our curated selection of secondhand items offers sustainable style for every taste. Look good and feel great by giving pre-loved items a new life.</p>
    </div>

    <main class="indexmain">
    <div class="category-links">
        <h3>Shop Categories</h3>
        <a href="shop.php?category=Women">Women's</a>
        <a href="shop.php?category=Men">Men's</a>
        <a href="shop.php?">View All</a>
    </div>
        <h2>Browse All Items</h2>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No items listed yet</p>
            </div>
        <?php exit; endif; ?>
        <div class=" item-container">
        <?php while($row = $statement->fetch()): ?>
            <div class="item">
                <?php if (!empty($row['image_path'])) : ?>
                    <?php
                    // Get the image name
                    $image_name = basename($row['image_path']);
                    ?>
                    <a href="<?= $row['image_path'] ?>" data-luminous="gallery" class="img-link">
                        <img src="<?= $row['image_path'] ?>" alt="<?= $image_name ?>" class="item-image">
                    </a>
                <?php endif; ?>
                <div class="item-info">
                    <h3><?= $row['name'] ?></h3>
                    <p>Category: <?= $row['category'] ?></p>
                    <p>Size: <?= $row['size'] ?></p>
                    <p><?= $row['description'] ?></p>
                    <p>Price: $<?=$row['price']?> CAD</p>
                    <p><a href="edit_item.php?id=<?= $row['id'] ?>">Edit</a></p>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </main>
    <?php include('footer.php')?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/Luminous.min.js"></script>
    <script>
        new LuminousGallery(document.querySelectorAll(".item a .img-link"));
    </script>
</body>
</html>
