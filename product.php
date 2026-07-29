<?php
// Start session to track cart items
session_start();

// Include functions file
include('functions.php');

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$product_name = "";

// Check if a product is added to the cart
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    add_to_cart($product_id); // Use function from functions.php
    $product_name = get_product_name($product_id);  // Get product name for message
}

// Sample product data (Replace this with database call if needed)
$products = [
    1 => ["name" => "Solar Panel 575W", "price" => "MRP 48,949/-", "image" => "solarpanel.jpeg", "link" => "spanel.php"],
    2 => ["name" => "Solar Led Street Lights", "price" => "MRP 2,498/-", "image" => "solarlamp.jpeg", "link" => "sslights.php"],
    3 => ["name" => "Solar Camera 24MP", "price" => "MRP 6,090/-", "image" => "solarcam.jpeg", "link" => "scamera.php"],
    4 => ["name" => "Solar Geyser 220L", "price" => "MRP 27,500/-", "image" => "solarg.jpeg", "link" => "sgeyser.php"],
    5 => ["name" => "Solar Water Heater", "price" => "MRP 17,900/-", "image" => "solarwater.jpeg", "link" => "swheater.php"],
    6 => ['name' => 'Solar Meter', 'price' => "MRP 3199", "image" => "solarmeter.jpg", "link" => "swheater.php"],
    7 => ['name' => 'Solar Inverter', 'price' => "MRP 29917", "image" => "solarinveter.jpeg", "link" => "swheater.php"],
    8 => ['name' => 'Solar Battery', 'price' => "MRP 24875", "image" => "soalrb.png", "link" => "swheater.php"],
    9 => ['name' => 'Solar Fan', 'price' => "MRP 5520", "image" => "solarfan.jpg", "link" => "swheater.php"],
    10 => ['name' => 'Solar chargeable light for home usage', 'price' => "MRP 2050", "image" => "solar battry.webp", "link" => "swheater.php"],
    11 => ['name' => 'Solar Bulb', 'price' => "MRP 2080", "image" => "solar lamp.webp", "link" => "swheater.php"],
    12 => ['name' => 'Solar Wireless Alarm Clock', 'price' => "MRP 2372", "image" => "solar wireless alaram.jpg", "link" => "swheater.php"],
    13 => ['name' => 'Solar Glass Crystal Lamp', 'price' =>"MRP 290", "image" => "solar glass crytal lamp.webp", "link" => "swheater.php"],
    14 => ['name' => 'Solar Led Torch 10W', 'price' => "MRP 1100", "image" => "solar led torch.webp", "link" => "swheater.php"],
    15 => ['name' => 'Solar Lamp', 'price' => "MRP 3680", "image" => "solar lamp.webp", "link" => "swheater.php"],
    16 => ['name' => 'Solar Keyboard', 'price' => "MRP 9583", "image" => "solar wireless keyboard.webp", "link" => "swheater.php"],
    17 => ['name' => 'Solar Halogen Light 100W', 'price' => "MRP 8000", "image" => "solar lights.webp", "link" => "swheater.php"],
    18 => ['name' => 'Solar Water Pump', 'price' => "MRP 20453", "image" => "solar water pump.webp", "link" => "swheater.php"],
    19 => ['name' => 'Solar Power Bank', 'price' => "MRP 1159", "image" => "solar power banks.webp", "link" => "swheater.php"],
    20 => ['name' => 'Solar Water Fountain', 'price' => "MRP 899", "image" => "solar water foutain.webp", "link" => "swheater.php"]
  
   
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="product.css">
    <style>
        .cart-message {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: green;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<?php require("cheader.php"); ?>

<body>
    <div class="container">
        <h1>Our Solar Products</h1>
        
        <div class="product-list">
            <?php foreach ($products as $id => $product): ?>
                <?php if (!is_in_cart($id)): ?>
                    <div class="product">
                        <a href="<?= $product['link']; ?>"><img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>"></a>
                        <h2><?= $product['name']; ?></h2>
                        <p><?= $product['price']; ?></p>
                        <br>
                        <a href="?add_to_cart=<?= $id; ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div id="cart-message" class="cart-message"></div>

        <div class="view-cart">
            <a href="cart.php">View Cart</a>
        </div>
    </div>

    <script>
        var cartMessage = document.getElementById("cart-message");
        <?php if (!empty($product_name)): ?>
            cartMessage.innerHTML = "<?= $product_name; ?> added to cart!";
            cartMessage.style.display = "block";
            setTimeout(function () {
                cartMessage.style.display = "none";
            }, 2000);
        <?php endif; ?>
    </script>
</body>
</html>
