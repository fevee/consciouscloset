<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
require('authenticate.php');
require('connect.php');

function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
    $current_folder = dirname(__FILE__);
    
    // Build an array of paths segment names to be joined using OS specific slashes.
    $path_segments = [$upload_subfolder_name, basename($original_filename)];
    
    // Return the relative path
    return join(DIRECTORY_SEPARATOR, $path_segments);
}

// Initialize $new_image_path
$new_image_path = null;

// Check if image is uploaded
$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
$upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

// Handle image upload
if ($image_upload_detected) { 
    $image_filename        = $_FILES['image']['name'];
    $temporary_image_path  = $_FILES['image']['tmp_name'];
    $new_image_path        = file_upload_path($image_filename);
    if (move_uploaded_file($temporary_image_path, $new_image_path)) {
        // Get the relative path of the uploaded image
        $image_path = file_upload_path($image_filename);
    } else {
        // Handle failed upload
        echo "Error: Failed to move uploaded file.";
        exit;
    }
}

if($_POST && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) &&
    !empty($_POST['size']) && !empty($_POST['category'])) {

    $query = "INSERT INTO items(name, description, price, size, category, image_path, isSold, date_posted) 
              VALUES (:name, :description, :price, :size, :category, :image_path, :isSold, :date_posted)";
    $statement = $db->prepare($query);

    $name = filter_input(INPUT_POST, 'name');
    $description = filter_input(INPUT_POST, 'description');
    $price = filter_input(INPUT_POST, 'price');
    $size = filter_input(INPUT_POST, 'size');
    $category = filter_input(INPUT_POST, 'category');

    // Check if $new_image_path is null and handle accordingly
    if ($new_image_path !== null) {
        $image_path = file_upload_path($image_filename);
    } else {
        $image_path = null; // Set image_path to null if no image is uploaded
    }

    // Set isSold to 0 and date_posted to current timestamp
    $isSold = 0;
    $date_posted = date("Y-m-d");

    $statement->bindValue(':name', $name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':image_path', $image_path, PDO::PARAM_STR);
    $statement->bindValue(':isSold', $isSold, PDO::PARAM_INT); // Assuming isSold is an integer field
    $statement->bindValue(':date_posted', $date_posted, PDO::PARAM_STR); // Assuming date_posted is a string field

    if($statement->execute()) {
        echo "New item submitted";
    }

    header("Location: shop.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>New Shop Item</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main>
        <form action="add_item.php" method="POST" enctype="multipart/form-data" class="block">
            <h2>Add New Item</h2>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" minlength="1" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="75" rows="12" minlength="1" required></textarea>
            </div>
            <div>
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="">Select category</option>
                    <option value="Women">Women's</option>
                    <option value="Men">Men's</option>
                </select>
            </div>
            <div>
                <label for="size">Size</label>
                <select name="size" id="size"></select>
            </div>
            <div>
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" min="0" step="1" required> 
            </div>
            <div>
                <label for="image">Upload image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit">Submit</button>
        </form>
    </main>
    <?php include('footer.php')?>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            var category = this.value;
            var sizeSelect = document.getElementById('size');
            sizeSelect.innerHTML = ''; // Clear existing options

            // Define size options based on the selected category
            var sizeOptions = [];
            // Find the index after which the "<optgroup>" for shoes should be inserted
            var shoeIndex;

            if (category === 'Women') {
                sizeOptions = ["One Size", "XS", "S", "M", "L", "XL", "0", "2", "4", "6", "8", "10", "12", "14", "16", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "36", "5", "6", "7", "8", "9", "10"];
                shoeIndex = sizeOptions.indexOf("36") + 1;
            } else if (category === 'Men') {
                sizeOptions = ["One Size", "XS", "S", "M", "L", "XL", "26", "28", "30", "31", "32", "33", "34", "36", "38", "40", "42", "6", "7", "8", "9", "10", "11", "12", "13"];
                shoeIndex = sizeOptions.indexOf("42") + 1;
            }

            // Insert the "<optgroup>" for shoes after the specified index
            sizeOptions.splice(shoeIndex, 0, '<optgroup label="Shoes">');

            // Populate the size select element with size options
            sizeOptions.forEach(function(size) {
                if (size === '<optgroup label="Shoes">') {
                    var optgroup = document.createElement('optgroup')
                    optgroup.label = "Shoes";
                    sizeSelect.appendChild(optgroup);
                } 
                else {
                    var option = document.createElement('option');
                    option.value = size;
                    option.textContent = size;
                    sizeSelect.appendChild(option);
                }
            });
        });

    </script>
</body>
</html>
