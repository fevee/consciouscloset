<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
require('connect.php');

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$itemsPerPage = 6; // Adjust the number of items per page as needed
$offset = ($page - 1) * $itemsPerPage;

// Set default sorting criteria
$defaultSort = "date_posted DESC";

// Check if a category filter is specified in the URL
if(isset($_GET['category'])) {
    // Retrieve the category value from the URL
    $category = $_GET['category'];

    // Prepare SQL query to select items based on the specified category
    $query = "SELECT * FROM items WHERE category = :category AND isSold = 0";
    $queryParams = [':category' => $category];
} else {
    // Default SQL query to select all items if no category filter is specified
    $query = "SELECT * FROM items WHERE isSold = 0";
    $queryParams = [];
}

// Check if sorting criteria is provided
if(isset($_GET['sortBy'])) {
    $sortBy = $_GET['sortBy'];
    switch($sortBy) {
        case 'price_low':
            $sort = "price ASC";
            break;
        case 'price_high':
            $sort = "price DESC";
            break;
        default:
            $sort = $defaultSort;
            break;
    }
} else {
    $sort = $defaultSort;
}

// Append sorting criteria to the query
$query .= " ORDER BY $sort";

// Add LIMIT and OFFSET for pagination
$query .= " LIMIT :limit OFFSET :offset";

// Prepare the statement
$statement = $db->prepare($query);

// Bind parameters separately
$statement->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/luminous-basic.min.css">
    <title>Shop Secondhand with Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <div class="hero-image">
        <img src="uploads/woman shopping clothing rack.jpg" alt="woman shopping through clothing rack">
        <div class="overlay-text hero-content">
            <h1>Explore Curated Secondhand Items</h1>
            <p>From vintage classics to modern staples, our curated selection of secondhand items offers sustainable style for every taste. Look good and feel great by giving pre-loved items a new life.</p>
        </div>
    </div>

    <main class="indexmain">

    <div class="shop-header">
        <div class="category-links">
            <h3>Shop Categories</h3>
            <a href="shop.php?category=Women">Women's</a>
            <a href="shop.php?category=Men">Men's</a>
            <a href="shop.php?">View All</a>
        </div>
        <form action="shop.php<?= isset($_GET['category']) ? '?category=' . $_GET['category'] : ''; ?><?php echo isset($_GET['sortBy']) ? (isset($_GET['category']) ? '&' : '?') . 'sortBy=' . $_GET['sortBy'] : ''; ?>" method="GET" id="sortByForm">
        <!-- Hidden input field to include the category parameter -->
            <?php if(isset($_GET['category'])): ?>
                <input type="hidden" name="category" value="<?= $_GET['category'] ?>">
            <?php endif; ?>
            <label for="sortBy">Sort By:</label>
            <select name="sortBy" id="sortBy">
                <option value="">Select criteria</option>
                <option value="price_low">Price Low to High</option>
                <option value="price_high">Price High to Low</option>
            </select>
        </form>
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

                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="name" value="<?= $row['name'] ?>">
                            <input type="hidden" name="price" value="<?= $row['price'] ?>">
                            <input type="hidden" name="image_path" value="<?= $row['image_path'] ?>">
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>

                        <p><a href="edit_item.php?id=<?= $row['id'] ?>">Edit</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
         <!-- Pagination buttons -->
         <div class="pagination">
                <?php if ($page > 1): ?>
                <button> <a href="?page=<?= $page - 1 ?>" class="pagination-button">Prev</a></button>
                <?php endif; ?>
                <?php if ($statement->rowCount() == $itemsPerPage): ?>
                    <button><a href="?page=<?= $page + 1 ?>" class="pagination-button">Next</a></button>
                <?php endif; ?>
        </div>
    </main>
    <?php include('footer.php')?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/Luminous.min.js"></script>
    <script>
        // JavaScript to submit the form when the sorting criteria changes
        document.getElementById('sortBy').addEventListener('change', function() {
            document.getElementById('sortByForm').submit();
        });
        new LuminousGallery(document.querySelectorAll(".item .img-link"));
    </script>
</body>
</html>
