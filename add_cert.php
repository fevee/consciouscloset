<?php
/**************** 
    
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

if($_POST && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['website'])) {

    $query = "INSERT INTO certifications(name, description, website, image_path ) VALUES (:name, :description, :website, :image_path)";
    $statement = $db->prepare($query);

    $name = filter_input(INPUT_POST, 'name');
    $description = filter_input(INPUT_POST, 'description');
    $website = filter_input(INPUT_POST, 'website');

    // Check if $new_image_path is null and handle accordingly
    if ($new_image_path !== null) {
        $image_path = file_upload_path($image_filename);
    } else {
        $image_path = null; // Set image_path to null if no image is uploaded
    }

    $statement->bindValue(':name', $name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':website', $website);
    $statement->bindValue(':image_path', $image_path, PDO::PARAM_STR); // PDO::PARAM_STR for NULL value

    if($statement->execute()) {
        echo "New certification submitted";
    }

    header("Location: certifications.php");
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
    <title>New Certification</title>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('nav.php') ?>
    <main>
        <form action="add_cert.php" method="POST" enctype="multipart/form-data" class="block">
            <h2>Add New Certification</h2>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" minlength="1" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="75" rows="12" minlength="1" required></textarea>
            </div>
            <div>
                <label for="website">Website</label>
                <input type="text" name="website" id="website"required>
            </div>
            <div>
                <label for="image">Upload image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit">Submit</button>
        </form>
    </main>
    <?php include('footer.php')?>
</body>
</html>
