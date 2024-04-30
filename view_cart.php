<?php
/*************** 
    
    Name: Faye Vaquilar
    Date: April 24, 2024
    Description: Web Dev 2 Final Assignment - Conscious Closet

****************/
session_start(); // Start the session
require('connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
     <!-- Include jQuery library  -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>View Shopping Cart - Conscious Closet</title>
</head>
<body>
    <?php include('header.php') ?> 
    <?php include('nav.php') ?>
    <main class="indexmain">

        <!-- Shopping cart display -->
        <div class="shopping-cart block">
            <?php
            $total_amount = 0; // Initialize total amount

            if (empty($_SESSION['cart'])) {
                echo "<p>Your shopping cart is empty.</p>";
            } else {
                foreach ($_SESSION['cart'] as $item_id => $item) {
                    ?>
                    <div class='cart-item'>
                        <p>Item ID: <?php echo $item_id; ?></p>
                        <p>Name: <?php echo $item['name']; ?></p>
                        <p>Price: $<?php echo $item['price']; ?></p>
                        <img src="<?php echo $item['image_path']; ?>" class="item-image" alt="<?php echo basename($item['name']); ?>">
                        <br>
                        <br>
                        <!-- Remove option -->
                        <button class="remove-item" data-item-id="<?php echo $item_id; ?>">Remove</button>
                        <hr>
                    <?php
                    // Calculate total amount for each item
                    $total_amount += $item['price'];
                }
                // Display total amount
                echo "<p>Total: $" . $total_amount . ".00</p>";
            }
            ?>
        </div>
    </main>
    <?php require('footer.php'); ?>
     <!-- JavaScript to handle removing items from the cart -->
     <script>
        $(document).ready(function() {
            // This function waits for the DOM to be fully loaded before executing

            // Event listener for the click event on elements with class 'remove-item'
            $(document).on('click', '.remove-item', function() {
                // This function is triggered when a remove button is clicked

                // Get the item ID from the data attribute of the clicked remove button
                var itemId = $(this).data('item-id');

                // Send an AJAX request to remove_from_cart.php with the item ID
                $.ajax({
                    type: 'POST',  // HTTP method used for the request
                    url: 'remove_from_cart.php',  // URL of the PHP script to handle the request
                    data: { item_id: itemId },  // Data to be sent with the request (item ID)
                    success: function(response) {
                        // This function is called when the request is successful

                        // Reload the page to reflect the changes in the cart
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // This function is called if an error occurs during the request

                        // Log the error to the console for debugging purposes
                        console.error(xhr.responseText);

                        // Display an alert to the user indicating the error
                        alert('An error occurred while removing the item from the cart. Please try again later.');
                    }
                });
            });
        });
    </script>
</body>
</html>
