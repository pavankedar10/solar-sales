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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .product-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }

        .product-image {
            width: 100%;
            border-radius: 10px;
        }

        .product-title {
            font-size: 24px;
            margin: 10px 0;
        }

        .product-price {
            font-size: 20px;
            color: #e74c3c;
            margin: 10px 0;
        }

        .product-description {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .buy-now {
            background-color: #27ae60;
            color: #fff;
        }

        .buy-now:hover {
            background-color: #219150;
        }

        .add-to-cart {
            background-color: #f39c12;
            color: #fff;
        }

        .add-to-cart:hover {
            background-color: #d68910;
        }
    </style>
</head>

<body>
    <div class="product-container">
        <img src="soalrb.png" alt="Product Image" class="product-image">
        <h2 class="product-title">Solar Battery</h2>
        <p class="product-price">MRP 24,875/-</p>
        <p class="product-description">Luminous Solar LPTT12150L Tall Tubular 150AH with 60months Warranty</p>
        <div class="buttons">
            <button class="btn buy-now">Buy Now</button>
            <button class="btn add-to-cart">Add to Cart</button>
        </div>
        <script>
        // Get the cart message container
        var cartMessage = document.getElementById("cart-message");

        // Show the cart message if a product is added to the cart
        <?php if (isset($product_name)): ?>
            cartMessage.style.display = "block";
            cartMessage.innerHTML = "<?php echo $product_name; ?> has been added to the cart!";

            // Hide the cart message after 3 seconds
            setTimeout(function () {
                cartMessage.style.display = "none";
            }, 3000);
        <?php endif; ?>
    </script>
    </div>
</body>

</html>