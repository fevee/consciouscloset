<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet (home page blog)

****************/
require('connect.php');

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$postsPerPage = 3;
$offset = ($page - 1) * $postsPerPage;


// Initial query to select all 
$query = "SELECT * FROM blog";

// Check if a search query is provided
if(isset($_GET['searchBlog'])) {
    // Retrieve the search query from the URL
    $searchBlog = $_GET['searchBlog'];
    // Add WHERE clause to filter by date
    $query .= " WHERE title LIKE :searchBlog";
    $queryParams = [':searchBlog' => '%' . $searchBlog . '%'];
} else {
    $queryParams = [];
}

// Add ORDER BY clause to sort by date
$query .= " ORDER BY date_posted DESC LIMIT :limit OFFSET :offset";

// Prepare the statement
$statement = $db->prepare($query);

// Bind parameters separately
$statement->bindParam(':limit', $postsPerPage, PDO::PARAM_INT);
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
    <script src="script.js"></script>
    <title>Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>

    <div class="hero-image">
        <img src="uploads/welcome header image.jpg" alt="earth tone thread spools">
        <div class="overlay-text hero-content">
            <h1>Welcome</h1>
            <p>Indulge in the vibrant world of fashion guilt-free! Our platform caters to fashion enthusiasts who seek to explore their style with their joy and conscience intact. 
            Explore style sustainably with our curated brand selection or shop our curated selection of secondhand pieces. Learn more about certifications or from our insightful blog.</p>
        </div>
    </div>

    <main class="indexmain">
        <form action="index.php" method="GET" id="searchForm">
            <input type="text" name="searchBlog" id="searchBlog" placeholder="Search Blog" style="width: 150px;">
            <button type="submit">Search</button>
        </form>
        <a href="index.php" class="title-link"><h2>Browse Blog Posts</h2></a>
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
        <!-- Pagination buttons -->
        <div class="pagination">
            <?php if ($page > 1): ?>
            <button> <a href="?page=<?= $page - 1 ?>" class="pagination-button">Prev</a></button>
            <?php endif; ?>
            <?php if ($statement->rowCount() == $postsPerPage): ?>
                <button><a href="?page=<?= $page + 1 ?>" class="pagination-button">Next</a></button>
            <?php endif; ?>
        </div>
    </main>

    <?php include('footer.php')?>
    
</body>
</html>