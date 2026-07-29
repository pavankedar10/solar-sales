<?php
session_start();
include('funtion.php'); // Ensure this file contains database connection logic

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: register.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details using email
$query = "SELECT name, email, address FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch user orders using email
$order_query = "SELECT order_id, product_name, quantity, total_price, order_date FROM orders WHERE email = ? ORDER BY order_date DESC";
$order_stmt = $conn->prepare($order_query);
$order_stmt->bind_param("s", $email);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        
        <h3>Your Orders</h3>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Date</th>
            </tr>
            <?php while ($order = $order_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                </tr>
            <?php } ?>
        </table>
        
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
