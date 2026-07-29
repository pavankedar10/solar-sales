<?php
session_start();
include 'db_connect.php';
$conn = db_connect();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Check if order_id is received
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $user_email = $_SESSION['user_email'];

    // Check if order belongs to the user and is still pending
    $query = "SELECT status FROM orders WHERE id = ? AND user_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $order_id, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order && $order['status'] == 'Pending') {
        // Update order status to "Cancelled"
        $update_query = "UPDATE orders SET status = 'Cancelled' WHERE id = ? AND user_email = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("is", $order_id, $user_email);
        
        if ($update_stmt->execute()) {
            echo "<script>alert('Order cancelled successfully.'); window.location.href = 'user_account.php';</script>";
        } else {
            echo "<script>alert('Failed to cancel order. Please try again.'); window.location.href = 'user_account.php';</script>";
        }
        
        $update_stmt->close();
    } else {
        echo "<script>alert('Invalid request or order cannot be cancelled.'); window.location.href = 'user_account.php';</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>
