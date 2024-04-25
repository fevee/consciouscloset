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

    $query = "SELECT * FROM brands WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $brands = $statement->fetch();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['delete'])) {
        $delete_query = "DELETE FROM brands WHERE id = :id";
        $delete_statement = $db->prepare($delete_query);
        $delete_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($delete_statement->execute()) {
            header("Location: brands.php");
            exit;
        }
    } elseif(isset($_POST['update'])) {
        $brand_name = $_POST['brand_name'];
        $brand_description = $_POST['brand_description'];
        $website = $_POST['website'];

        // Initialize $new_image_path
        $image_path = $brands['image_path'];

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
            $image_path = $brands['image_path']; // Use the existing image path if no new image uploaded
        }

        $update_query = "UPDATE brands SET brand_name = :brand_name, brand_description = :brand_description, website = :website, image_path = :image_path WHERE id = :id";
        $update_statement = $db->prepare($update_query);
        $update_statement->bindValue(':brand_name', $brand_name);
        $update_statement->bindValue(':brand_description', $brand_description);
        $update_statement->bindValue(':website', $website);
        $update_statement->bindValue(':image_path', $image_path);
        $update_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($update_statement->execute()) {
            header("Location: brands.php");
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
    <title>Edit this Brand</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main>
        <form action="" method="POST" enctype="multipart/form-data" class="block"> <!-- Added enctype="multipart/form-data" -->
            <h2>Edit Brand</h2>
            <div>
                <label for="brand_name">Name</label>
                <input type="text" name="brand_name" id="brand_name"
                minlength="1" required value="<?= $brands['brand_name']?>">
            </div>
            <div>
                <label for="brand_description">Description</label>
                <textarea name="brand_description" id="brand_description" cols="75" rows="12"
                minlength="1" required><?= $brands['brand_description']?></textarea>
            </div>
            <label for="website">Website</label>
                <input type="text" name="website" id="website"
                required value="<?= $brands['website']?>">
            </div>
            <div>
                <label for="image">Upload image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete">Delete</button>
        </form>
    </main>
    <?php
