<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/

require('connect.php');
require('authenticate.php');

function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
    $current_folder = dirname(__FILE__);
    
    // Build an array of paths segment names to be joined using OS specific slashes.
    $path_segments = [$upload_subfolder_name, basename($original_filename)];
    
    // Return the relative path
    return join(DIRECTORY_SEPARATOR, $path_segments);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM items WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $items = $statement->fetch();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['delete'])) {
        $delete_query = "DELETE FROM items WHERE id = :id";
        $delete_statement = $db->prepare($delete_query);
        $delete_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($delete_statement->execute()) {
            header("Location: shop.php");
            exit;
        }
    } elseif(isset($_POST['update'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $category = $_POST['category'];
        $price = $_POST['price'];

        // Initialize $new_image_path
        $image_path = $certifications['image_path'];

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

        // Check if image upload detected and update image path accordingly
        if ($image_upload_detected) {
            $image_path = $image_path; // Use the newly uploaded image path
        } else {
            $image_path = $items['image_path']; // Use the existing image path if no new image uploaded
        }

        $update_query = "UPDATE items SET name = :name, description = :description, size = :size, category = :category, price = :price, image_path = :image_path WHERE id = :id";
        $update_statement = $db->prepare($update_query);
        $update_statement->bindValue(':name', $name);
        $update_statement->bindValue(':description', $description);
        $update_statement->bindValue(':size', $size);
        $update_statement->bindValue(':category', $category);
        $update_statement->bindValue(':price', $price);
        $update_statement->bindValue(':image_path', $image_path);
        $update_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($update_statement->execute()) {
            header("Location: shop.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Item</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main>
        <form action="" method="POST" enctype="multipart/form-data" class="block"> <!-- Added enctype="multipart/form-data" -->
            <h2>Edit Item</h2>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name"
                minlength="1" required value="<?= $items['name']?>">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="75" rows="12"
                minlength="1" required><?= $items['description']?></textarea>
                <div>
                <label for="category">Category</label>
                <select name="category" id="category" >
                    <option value="">Select category</option>
                    <option value="Women" <?= ($items['category'] === "Women") ? 'selected' : '' ?>>Women's</option>
                    <option value="Men" <?= ($items['category'] === "Men") ? 'selected' : '' ?>>Men's</option>
                </select>
            </div>
            <div>
                <label for="size">Size</label>
                <select name="size" id="size"></select>
            </div>
            <div>
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" min="0" step="1" required value=<?=$items['price']?>> 
            </div>
            <div>
            <div>
                <label for="image">Upload image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete">Delete</button>
        </form>
    </main>
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