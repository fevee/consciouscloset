<?php
session_start(); // Start the session

// Check if the item_id is provided
if(isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Check if the item exists in the cart
    if(isset($_SESSION['cart'][$item_id])) {
        // Remove the item from the cart
        unset($_SESSION['cart'][$item_id]);
        echo "Item removed from cart successfully.";
    } else {
        echo "Item not found in cart.";
    }
} else {
    echo "Item ID not provided.";
}
?>
