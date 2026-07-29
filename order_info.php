<?php
// Start session and include database connection
session_start();

// Database connection
$con = new mysqli("localhost", "root", "", "records");

// Check connection
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

// Ensure only admin can access the page
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    die("Invalid order ID.");
}
$order_id = $_GET['order_id'];

// Fetch order details
$order_query = $con->prepare("SELECT * FROM orders WHERE id = ?");
$order_query->bind_param("i", $order_id);
$order_query->execute();
$order_result = $order_query->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$items_query = $con->prepare("SELECT * FROM order_items WHERE order_id = ?");
$items_query->bind_param("i", $order_id);
$items_query->execute();
$items_result = $items_query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Order Receipt</h1>
            <a href="admin.php"><button>Back to Dashboard</button></a>
        </header>
        <div class="content">
            <section class="card">
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
                <p><strong>User Email:</strong> <?php echo htmlspecialchars($order['user_email']); ?></p>
                <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
                <p><strong>Total Price:</strong> ₹<?php echo number_format($order['total_price'], 2); ?></p>
            </section>
            <section class="card">
                <h2>Order Items</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = $items_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo $item['product_quantity']; ?></td>
                                <td>₹ <?php echo number_format($item['product_price'], 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
