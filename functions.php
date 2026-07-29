<?php
// Define the USD to INR conversion rate
define('USD_TO_INR', value:1);

// Array of products (Prices are in USD, will be converted dynamically)
$products = [
    1 => ['name' => 'SOLAR PANEL 575W', 'price' => 48949],
    2 => ['name' => 'Solar Led Street Lights', 'price' => 2498],
    3 => ['name' => 'Solar Camera 24MP', 'price' => 6090],
    4 => ['name' => 'Solar Geyser 220L', 'price' => 27500],
    5 => ['name' => 'Solar Water Heater', 'price' => 17900],
    6 => ['name' => 'Solar Meter', 'price' => 3199],
    7 => ['name' => 'Solar Inverter', 'price' => 29917],
    8 => ['name' => 'Solar Battery', 'price' => 24875],
    9 => ['name' => 'Solar Fan', 'price' => 5520],
    10 => ['name' => 'Solar chargeable light for home usage', 'price' => 2050],
    11 => ['name' => 'Solar Bulb', 'price' => 2080],
    12 => ['name' => 'Solar Wireless Alarm Clock', 'price' => 2372],
    13 => ['name' => 'Solar Glass Crystal Lamp', 'price' => 290],
    14 => ['name' => 'Solar Led Torch 10W', 'price' => 1100],
    15 => ['name' => 'Solar Lamp', 'price' => 3680],
    16 => ['name' => 'Solar Keyboard', 'price' => 9583],
    17 => ['name' => 'Solar Halogen Light 100W', 'price' => 8000],
    18 => ['name' => 'Solar Water Pump', 'price' => 20453],
    19 => ['name' => 'Solar Power Bank', 'price' => 1159],
    20 => ['name' => 'Solar Water Fountain', 'price' => 899],
    21 => ['name' => 'Product 3', 'price' => 40.00],
    22 => ['name' => 'Solar Panals', 'price' => 48949],
    23 => ['name' => 'Solar Camera', 'price' => 6090],
    24 => ['name' => 'Solar Lamp', 'price' => 3680],
    25 => ['name' => 'Solar Inverters', 'price' => 29918],
    26 => ['name' => 'Solar Batteries', 'price' => 24875],
    27 => ['name' => 'Solar Water Heaters', 'price' => 5600]
];

// Function to convert price to INR
function convert_to_inr($usd_price) {
    return round($usd_price * USD_TO_INR);
}

// Function to get the product name
function get_product_name($product_id) {
    global $products;
    return isset($products[$product_id]) ? $products[$product_id]['name'] : 'Unknown Product';
}

// Function to get product price in INR
function get_product_price_inr($product_id) {
    global $products;
    return isset($products[$product_id]) ? convert_to_inr($products[$product_id]['price']) : 0;
}

// Function to add a product to the cart
function add_to_cart($product_id) {
    global $products;
    if (isset($products[$product_id])) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        $_SESSION['cart'][$product_id] = [
            'name' => $products[$product_id]['name'],
            'price' => convert_to_inr($products[$product_id]['price']) // Store price in INR
        ];
    }
}

// Function to get all cart items
function get_cart_items() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

// Function to calculate the total price of cart items in INR
function calculate_total($cart_items) {
    $total = 0;
    foreach ($cart_items as $item) {
        $total += $item['price'];
    }
    return $total;
}

// Function to check if a product is in the cart
function is_in_cart($product_id) {
    return isset($_SESSION['cart'][$product_id]);
}
?>
