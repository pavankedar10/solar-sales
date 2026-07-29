<?php
// Start session and include database connection
session_start();

// Database connection
$con = new mysqli("localhost", "root", "", "records");

// Check connection
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure only admin can access the page
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get admin details
$admin_email = $_SESSION['user_email'];
$admin_query = $con->prepare("SELECT fullname FROM user WHERE email = ?");
$admin_query->bind_param("s", $admin_email);
$admin_query->execute();
$admin_result = $admin_query->get_result();
$admin = $admin_result->fetch_assoc();
$admin_name = $admin ? $admin['fullname'] : 'Admin';

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_email = $_POST['user_email'];

    // Delete user's orders first to maintain foreign key constraints
    $delete_orders_query = $con->prepare("DELETE FROM orders WHERE user_email = ?");
    $delete_orders_query->bind_param("s", $user_email);
    $delete_orders_query->execute();

    // Delete user from database
    $delete_user_query = $con->prepare("DELETE FROM user WHERE email = ?");
    $delete_user_query->bind_param("s", $user_email);
    
    if ($delete_user_query->execute()) {
        echo "<script>alert('User account and their orders deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete user account!');</script>";
    }

    // Refresh the page after deletion
    echo "<script>window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
    exit();
}

// Handle delete and status update requests for orders
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];
        $delete_order_query = $con->prepare("DELETE FROM orders WHERE id = ?");
        $delete_order_query->bind_param("i", $order_id);
        if ($delete_order_query->execute()) {
            echo "<script>alert('Order deleted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to delete order!');</script>";
        }
    }

    if (isset($_POST['order_id']) && isset($_POST['status'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['status'];

        $update_status_query = $con->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $update_status_query->bind_param("si", $new_status, $order_id);
        
        if ($update_status_query->execute()) {
            echo "<script>alert('Order status updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update order status!');</script>";
        }
    }

    echo "<script>window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
    exit();
}

// Fetch all users
$user_query = "SELECT email, fullname FROM user";
$users_result = $con->query($user_query);

// Fetch orders grouped by user
$order_query = "SELECT id, user_email, total_price, status, created_at FROM orders ORDER BY user_email, status, created_at DESC";
$orders_result = $con->query($order_query);

// Organize orders by user
$user_orders = [];
while ($order = $orders_result->fetch_assoc()) {
    $user_orders[$order['user_email']][] = $order;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome, <?php echo htmlspecialchars($admin_name); ?> (Admin)</h1>
            <a href="logout.php"><button>Logout</button></a>
        </header>
        
        <div class="content">
            <!-- Users Section -->
            <section class="card">
                <h2>All Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User Email</th>
                            <th>Full Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $users_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="user_email" value="<?php echo $user['email']; ?>">
                                        <button type="submit" name="delete_user" onclick="return confirm('Are you sure you want to delete this user and all their orders?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>

            <!-- Orders Section -->
            <?php foreach ($user_orders as $user_email => $orders): ?>
                <section class="card">
                    <h2>Orders for <?php echo htmlspecialchars($user_email); ?></h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['created_at']; ?></td>
                                    <td>₹ <?php echo number_format($order['total_price'], 2); ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                                <option value="canceled" <?php echo $order['status'] == 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <button type="submit" name="delete_order" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                        </form>
                                        <a href="order_info.php?order_id=<?php echo $order['id']; ?>">View Info</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
