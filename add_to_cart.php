<?php
session_start(); // Start the session

if(isset($_POST['add_to_cart'])) {
    // Retrieve item details from the form
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image_path'];

    // Add item to cart session variable
    $_SESSION['cart'][$item_id] = array(
        'name' => $name,
        'price' => $price,
        'image_path' => $image,
    );

    // Redirect back to the previous page or item listing page
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
