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
                        <!-- Remove option -->
                        <form action='remove_from_cart.php' method='POST' style='float: left;'>
                            <input type='hidden' name='item_id' value='<?php echo $item_id; ?>' alt='<?php echo basename($item['name']); ?>'>
                            <button type='submit'>Remove</button>
                        </form>
                        <hr style="clear: both;">
                    </div>
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
</body>
</html>
