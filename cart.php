<?php
// Start session to track cart items
session_start();
include('functions.php');
// Get the cart items
$cart_items = get_cart_items();
$total_price = calculate_total($cart_items);

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = max(1, (int) $_POST['quantity']); // Ensure at least 1
    $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    
    // Recalculate total price
    $_SESSION['cart'][$product_id]['price'] = get_product_price_inr($product_id) * $new_quantity;

    header("Location: cart.php"); // Refresh page
    exit();
}

// Handle item removal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]); // Remove item from cart
    header("Location: cart.php"); // Refresh page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>

        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($cart_items as $product_id => $item): ?>
                    <li>
                        <strong><?php echo $item['name']; ?></strong> ₹ <?php echo number_format($item['price'], 2); ?>
                        <br>

                        <!-- Update Quantity Form -->
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="<?php echo $item['quantity'] ?? 1; ?>" min="1">
                            <button type="submit" name="update_quantity">Update</button>
                        </form>

                        <!-- Remove Item Form -->
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                            
                        </form>
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ul>

            <p><strong>Total Price: ₹ <?php echo number_format(calculate_total($cart_items), 2); ?></strong></p>

            <form method="POST" action="dinfo.php">
    <input type="hidden" name="cart_data" value='<?php 
        echo json_encode(array_map(function($item) {
            return [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'] ?? 1 // Ensure quantity is included
            ];
        }, $cart_items)); 
    ?>'>
    <input type="hidden" name="total_price" value="<?php echo calculate_total($cart_items); ?>">
    <button type="submit">Proceed to Buy</button>
</form>

            <br>
            <!-- <a href="product.php"><button>Back to Product Page</button></a> -->
        <?php endif; ?>
        <a href="product.php"><button>Back to Product Page</button></a>
    </div>
</body>
</html>
