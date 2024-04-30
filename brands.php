<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
require('connect.php');

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$brandsPerPage = 6;
$offset = ($page - 1) * $brandsPerPage;

// Initial query to select all brands
$query = "SELECT * FROM brands";

// Check if a search query is provided
if(isset($_GET['searchBrand'])) {
    // Retrieve the search query from the URL
    $searchBrand = $_GET['searchBrand'];
    // Add WHERE clause to filter brands by name
    $query .= " WHERE brand_name LIKE :searchBrand";
    $queryParams = [':searchBrand' => '%' . $searchBrand . '%'];
} else {
    // Default query to select all brands if no search query is provided
    $queryParams = [];
}

// Add LIMIT and OFFSET for pagination
$query .= " ORDER BY brand_name ASC LIMIT :limit OFFSET :offset";

// Prepare the statement
$statement = $db->prepare($query);

// Bind parameters separately
$statement->bindParam(':limit', $brandsPerPage, PDO::PARAM_INT);
$statement->bindParam(':offset', $offset, PDO::PARAM_INT);

// Merge query parameters if search query is provided
if(isset($queryParams)) {
    foreach ($queryParams as $param => $value) {
        $statement->bindParam($param, $value);
    }
}

// Execute the statement
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
    <div class="hero-image">
        <img src="uploads/clothing store window rack.jpg" alt="clothing store window rack">
        <div class="overlay-text hero-content">
            <h1>Explore Sustainable Brands</h1>
            <p>Discover a curated selection of eco-friendly and ethically conscious fashion brands that align with your values</p>
        </div>
    </div>
    <main class="indexmain">
        <form action="brands.php" method="GET" id="searchForm">
            <input type="text" name="searchBrand" id="searchBrand" placeholder="Search brand name" style="width: 150px;">
            <button type="submit">Search</button>
        </form>
        <a href="brands.php" class="title-link">Browse All Brands</a>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No sustainable brands listed</p>
            </div>
        <?php exit; endif; ?>
        <div class="brands-container">
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
                        <a href="show_brand.php?id=<?=$row['id']?>" class="namelink"><?= $row['brand_name'] ?></a>
                        <p class="brand-description"><?= strlen($row['brand_description']) > 140 ? substr($row['brand_description'], 0, 140) . ' ...' : $row['brand_description'] ?><a href="show_brand.php?id=<?=$row['id']?>">Read More</a>
    </p>
                        <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
                        <p><a href="edit_brand.php?id=<?= $row['id'] ?>">Edit</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
        <!-- Pagination buttons -->
        <div class="pagination">
            <?php if ($page > 1): ?>
            <button> <a href="?page=<?= $page - 1 ?>" class="pagination-button">Prev</a></button>
            <?php endif; ?>
            <?php if ($statement->rowCount() == $brandsPerPage): ?>
                <button><a href="?page=<?= $page + 1 ?>" class="pagination-button">Next</a></button>
            <?php endif; ?>
        </div>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>
