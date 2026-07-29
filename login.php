<?php
session_start();
include 'db_connect.php'; // Include the database connection file

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['userpassword']);

    // Check if fields are empty
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "<p style='color: red;'>Please enter both email and password.</p>";
        header("Location: login.php");
        exit();
    }

    // Database connection
    $conn = db_connect();

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT fullname, email, userpassword, user_type FROM user WHERE email = ?");
    
    if (!$stmt) {
        $_SESSION['message'] = "<p style='color: red;'>SQL Error: " . $conn->error . "</p>";
        header("Location: login.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Compare passwords (Consider using password_hash() in the future)
        if ($password === $user['userpassword']) { 
            $_SESSION['user_email'] = $user['email']; // Store user email
            $_SESSION['user_type'] = $user['user_type']; // Store user type
            $_SESSION['username'] = $user['fullname']; // Store user's full name

        } else {
            $_SESSION['message'] = "<p style='color: red;'>Invalid email or password!</p>";
        }
    } else {
        $_SESSION['message'] = "<p style='color: red;'>User not found!</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="video-background">
    <video autoplay loop muted>
        <source src="bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<div class="container">
    <?php 
    // Show message if available
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); // Clear message after displaying
    }

    // Show login form only if the user is not logged in
    if (!isset($_SESSION['user_email'])): 
    ?>
        <form method="POST" action="login.php">
            <center><h2>Login</h2></center> 
            <br>

            <label>Email:</label>
            <br>
            <input type="email" name="email" required placeholder="Enter your email" autocomplete="off">
            <br><br>

            <label>Password:</label><br> 
            <input type="password" name="userpassword" id="password" required placeholder="Enter your password" autocomplete="off">
            <br><br>

            <i class="fa-solid fa-eye" id="togglePassword"></i>

            <button type="submit">Login</button>
            <br>
        </form>

        <p>Don't have an account? <br><a href="register.php">Register here</a></p>
    
    <?php else: ?>
        <!-- Show user info and "Go to Home" button after login -->
      <center>  <div class="user-info">
            <p><strong>Welcome, <?php echo $_SESSION['username']; ?>!</strong></p> <!-- Display Full Name -->
            <p>User Type: <strong><?php echo ucfirst($_SESSION['user_type']); ?></strong></p>

            <?php 
            // Redirect based on user type when clicking "Go to Home"
            $redirect_page = ($_SESSION['user_type'] === 'admin') ? "admin.php" : "cweb.php";
            ?>
            <br>
            <a href="<?php echo $redirect_page; ?>"><button>Go to Home</button></a>
        </div></center>
    <?php endif; ?>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
