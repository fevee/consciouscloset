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

    $query = "SELECT * FROM certifications WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $certifications = $statement->fetch();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['delete'])) {
        $delete_query = "DELETE FROM certifications WHERE id = :id";
        $delete_statement = $db->prepare($delete_query);
        $delete_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($delete_statement->execute()) {
            header("Location: certifications.php");
            exit;
        }
    } elseif(isset($_POST['update'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $website = $_POST['website'];

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
            $image_path = $certifications['image_path']; // Use the existing image path if no new image uploaded
        }

        $update_query = "UPDATE certifications SET name = :name, description = :description, website = :website, image_path = :image_path WHERE id = :id";
        $update_statement = $db->prepare($update_query);
        $update_statement->bindValue(':name', $name);
        $update_statement->bindValue(':description', $description);
        $update_statement->bindValue(':website', $website);
        $update_statement->bindValue(':image_path', $image_path);
        $update_statement->bindValue(':id', $id, PDO::PARAM_INT);
        if($update_statement->execute()) {
            header("Location: certifications.php");
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
    <title>Edit this Certification</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main>
        <form action="" method="POST" enctype="multipart/form-data" class="block"> <!-- Added enctype="multipart/form-data" -->
            <h2>Edit Certification</h2>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name"
                minlength="1" required value="<?= $certifications['name']?>">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="75" rows="12"
                minlength="1" required><?= $certifications['description']?></textarea>
            </div>
            <label for="website">Website</label>
                <input type="text" name="website" id="website"
                required value="<?= $certifications['website']?>">
            </div>
            <div>
                <label for="image">Upload image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete">Delete</button>
        </form>
    </main>
    </body>
</html>
