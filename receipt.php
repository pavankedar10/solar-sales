<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "records";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order_id is passed
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    echo "<script>alert('Invalid request!'); window.location.href = 'cweb.php';</script>";
    exit();
}

$order_id = $_GET['order_id'];

// Fetch order details
$order_query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    echo "<script>alert('Order not found!'); window.location.href = 'cweb.php';</script>";
    exit();
}

// Fetch order items
$item_query = "SELECT * FROM order_items WHERE order_id = ?";
$item_stmt = $conn->prepare($item_query);
$item_stmt->bind_param("i", $order_id);
$item_stmt->execute();
$item_result = $item_stmt->get_result();
$order_items = $item_result->fetch_all(MYSQLI_ASSOC);

$conn->close();

// Clear session cart only if this is a receipt page visit
if (isset($_SESSION['cart']) && basename($_SERVER['PHP_SELF']) === 'receipt.php') {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="receipt.css"> <!-- Optional: Add your CSS -->
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .details {
            text-align: left;
            margin: 10px 0;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            font-weight: bold;
        }
        .print-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;

        }
        .ok{
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Payment Receipt</h2>
        
        <div class="details">
            <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($order['fullname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['user_email']); ?></p>
            <p><strong>Contact No:</strong> <?php echo htmlspecialchars($order['contactno']); ?></p>
            <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['pincode']); ?></p>
            <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
            <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
        </div>

        <h3>Order Items</h3>
        <table class="items">
            <tr>
                <th>Product Name</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo number_format($item['product_price'], 2); ?></td>
                    <td><?php echo number_format($item['product_quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="total">Total Price</td>
                <td class="total" colspan="2">₹ <?php echo number_format($order['total_price'], 2); ?></td>
            </tr>
        </table>

        <button class="print-btn" onclick="window.print()">Print Receipt</button> <br> <br>
        <a class="ok" href="cweb.php"><button>GO TO HOME</button></a>
    </div>

</body>
</html>
