<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
require('connect.php');

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$certsPerPage = 6;
$offset = ($page - 1) * $certsPerPage;

$query = "SELECT * FROM certifications";

// Check if a search query is provided
if(isset($_GET['searchCertification'])) {
    // Retrieve the search query from the URL
    $searchCertification = $_GET['searchCertification'];
    // Add WHERE clause to filter by name
    $query .= " WHERE name LIKE :searchCertification";
    $queryParams = [':searchCertification' => '%' . $searchCertification . '%'];
} else {
    // Default query to select all if no search query is provided
    $queryParams = [];
}

// Add ORDER BY clause to sort by name
$query .= " ORDER BY name ASC LIMIT :limit OFFSET :offset";

// Prepare the statement
$statement = $db->prepare($query);

// Bind parameters separately
$statement->bindParam(':limit', $certsPerPage, PDO::PARAM_INT);
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
    <title>Certifications - Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-image">
        <img src="uploads/clothing factory.jpg" alt="clothing factory">
        <div class="overlay-text hero-content">
            <h1>Explore Ethical Certifications</h1>
            <p>Discover various ethical certifications that validate a brand's commitment to sustainability and ethical practices.</p>
        </div>
    </div>

    <main class="indexmain">
        <form action="certifications.php" method="GET" id="searchForm">
            <input type="text" name="searchCertification" id="searchCertification" placeholder="Search certification name" style="width: 200px;">
            <button type="submit">Search</button>
        </form>
        <a href="certifications.php" class="title-link">Browse All Certifications</a>
        <?php if($statement->rowCount() == 0):?>
            <div>
                <p>No certifications listed yet</p>
            </div>
        <?php exit; endif; ?>
        <div class="cert-container">
            <?php while($row = $statement->fetch()): ?>
                <div class="cert">
                    <?php if (!empty($row['image_path'])) : ?>
                        <?php
                        // Get the image name
                        $image_name = basename($row['image_path']);
                        ?>
                        <img src="<?= $row['image_path'] ?>" alt="<?= $image_name ?>" class="cert-image">
                    <?php endif; ?>
                    <div class="cert-info">
                        <h3><?= $row['name'] ?></h3>
                        <p class="description"><?= strlen($row['description']) > 140 ? substr($row['description'], 0, 140) . ' ...' :
                            $row['description'] ?><a href="show_cert.php?id=<?=$row['id']?>">Read More</a>
                        </p>
                        <p><a href="<?= $row['website'] ?>" target="_blank">Visit Website</a></p>
                        <p><a href="edit_cert.php?id=<?= $row['id'] ?>">Edit</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Pagination buttons -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <button> <a href="?page=<?= $page - 1 ?>" class="pagination-button">Prev</a></button>
            <?php endif; ?>
            <?php if ($statement->rowCount() == $certsPerPage): ?>
                <button><a href="?page=<?= $page + 1 ?>" class="pagination-button">Next</a></button>
            <?php endif; ?>
        </div>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>
