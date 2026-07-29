<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="function.css">
</head>
<body>
<div class="container">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_POST['email'];
$password = $_POST['userpassword'];

// Database connection here
$con = new mysqli("localhost", "root", "", "records");


if ($con->connect_error) {
    die("Failed to connect : " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['userpassword'] === $password) {
            header("Location: cweb.php"); // Refresh page
            
            $fullname = $data['fullname']; // Assuming 'fullname' column exists in your database
            $user_type = $data['user_type'];

            echo "<h2>Login Successful!</h2>";
            echo "<h3>Welcome, $fullname</h3>";

            // Check user type and display appropriate link
            if ($user_type === 'admin') {
                echo '<a href="admin.php">Go to Admin Dashboard</a>';
            } elseif ($user_type === 'user') {
                echo '<a href="cweb.php">Go to User Dashboard</a>';
            } else {
                echo '<h2>Invalid user type!</h2>';
            }
        } else {
            echo '<h2>Invalid Email or Password</h2>';
            echo '<a href="register.php">Try Again</a>';
        }
    } else {
        echo "<h2>Invalid Email or Password</h2>";
        echo '<a href="register.php">Try Again</a>';
    }
}
?>
</div>
</body>
</html>
