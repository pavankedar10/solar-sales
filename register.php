<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="register.css">
    <script>
        function validateForm() {
            var fullname = document.getElementById("fullname").value;
            var contact = document.getElementById("contact_no").value.replace("+91", "").trim(); // Remove country code for validation
            var nameRegex = /^[A-Za-z\s]+$/; // Only letters and spaces
            var contactRegex = /^[0-9]{10}$/; // Exactly 10 digits

            // Validate Full Name
            if (!nameRegex.test(fullname)) {
                alert("Full Name must contain only letters and spaces.");
                return false;
            }

            // Validate Contact Number
            if (!contactRegex.test(contact)) {
                alert("Contact Number must be exactly 10 digits.");
                return false;
            }

            // Prevent repeated digits (more than 4 times in a row)
            if (/(\d)\1{4,}/.test(contact)) {
                alert("Contact Number cannot have the same digit repeated more than 4 times in a row.");
                return false;
            }

            // Prevent serial numbers (ascending or descending sequences)
            var ascending = "01234567890123456789";
            var descending = "98765432109876543210";
            if (ascending.includes(contact) || descending.includes(contact)) {
                alert("Contact Number cannot be a serial number like 1234567890 or 9876543210.");
                return false;
            }

            return true; // Submit the form if validation passes
        }

        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var toggleIcon = document.getElementById(id + "-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.textContent = "👁️";
            } else {
                passwordField.type = "password";
                toggleIcon.textContent = "👁️‍🗨️";
            }
        }

        function addCountryCode() {
            var contactInput = document.getElementById("contact_no");
            if (!contactInput.value.startsWith("+91")) {
                contactInput.value = "+91" + contactInput.value;
            }
        }
    </script>
</head>
<body>
<div class="video-background">
    <video autoplay loop muted>
        <source src="bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<div class="container">
    <form action="#" method="post" class="registration-form" onsubmit="return validateForm()">
        <h2>Create an Account</h2>

        <!-- Full Name -->
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required placeholder="Enter your full name">

        <!-- Email Address -->
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email">

        <!-- Contact Number -->
        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" required placeholder="Enter your contact number" onfocus="addCountryCode()">

        <!-- Password -->
        <label for="password">Password:</label>
        <div style="position: relative;">
            <input type="password" id="password" name="userpassword" required placeholder="Enter your password">
            <span id="password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password')">👁️</span>
        </div>

        <!-- Confirm Password -->
        <label for="confirm-password">Confirm Password:</label>
        <div style="position: relative;">
            <input type="password" id="confirm-password" name="cpassword" required placeholder="Confirm your password">
            <span id="confirm-password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('confirm-password')">👁️‍🗨️</span>
        </div>

        <br>

        <!-- User Type -->
        <label for="user-type">User Type:</label>
        <select name="user-type" id="user-type" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn" name="sb">Register</button>

        <!-- Already have an account -->
        <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
    </form>

    <?php
    // Database Connection
    $con = new mysqli('localhost', 'root', '', 'records');

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if (isset($_POST['sb'])) {
        $name = $con->real_escape_string($_POST['fullname']);
        $email = $con->real_escape_string($_POST['email']);
        $contact_no = str_replace("+91", "", $con->real_escape_string($_POST['contact_no'])); // Remove +91 for storage
        $password = $_POST['userpassword'];
        $cpassword = $_POST['cpassword'];
        $users = $con->real_escape_string($_POST['user-type']);

        // Server-side validation
        if (!preg_match("/^[A-Za-z\s]+$/", $name)) { 
            echo "<p style='color: red;'>Full Name must contain only letters and spaces.</p>";
        } elseif (!preg_match("/^[0-9]{10}$/", $contact_no)) {
            echo "<p style='color: red;'>Contact Number must be exactly 10 digits.</p>";
        } elseif (preg_match("/(\d)\1{4,}/", $contact_no)) {
            echo "<p style='color: red;'>Contact Number cannot have the same digit repeated more than 4 times.</p>";
        } elseif (preg_match("/1234567890|9876543210/", $contact_no)) {
            echo "<p style='color: red;'>Contact Number cannot be a serial sequence.</p>";
        } elseif ($password !== $cpassword) {
            echo "<p style='color: red;'>Passwords do not match. Please try again.</p>";
        } else {
            // Check if the email already exists
            $checkEmailQuery = "SELECT email FROM user WHERE email = ?";
            $stmt = $con->prepare($checkEmailQuery);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<p style='color: red;'>Email is already registered. Please use a different email.</p>";
            } else {
                // Insert User
                $stmt = $con->prepare("INSERT INTO user (fullname, email, contact_no, userpassword, user_type) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $name, $email, $contact_no, $password, $users);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Account created successfully!</p>";
                } else {
                    echo "<p style='color: red;'>Error inserting user: " . $stmt->error . "</p>";
                }
            }
            $stmt->close();
        }
    }

    $con->close();
    ?>
</div>
</body>
</html>
