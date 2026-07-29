<?php
// Start session to track cart items
session_start();

// Include functions file
include('functions.php');

// Check if a product is added to the cart
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    add_to_cart($product_id);
    $product_name = get_product_name($product_id);  // Get product name for message
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>