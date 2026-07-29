<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgetpass.css">
</head>

<body >

    <form method="POST" action="">
        <h1>Forgot Password</h1>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Retrieve Password</button>
        <br>
        <br>
        <br>
        <center><a href="register.php">Back to login page</a></center>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name']; // Corrected to match the form's input name
            $email = $_POST['email'];

            // Database connection
            $con = new mysqli("localhost", "root", "", "records");

            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            // Query to retrieve the password
            $stmt = $con->prepare("SELECT userpassword FROM user WHERE fullname = ? AND email = ?");
            $stmt->bind_param("ss", $name, $email); // Use $name and $email
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                echo "<h2>Your Password is: " . htmlspecialchars($data['userpassword']) . "</h2>";
            } else {
                echo "<h2>Invalid Name or Email</h2>";
            }

            $stmt->close();
            $con->close();
        }
        ?>
    </form>
    <br>
    <!-- <a href="register.php"><button>Back to login page</button></a> -->
</body>

</html>