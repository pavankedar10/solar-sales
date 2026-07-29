<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgetpass.css">
</head>
<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    /* Container */
    form {
        background-color: #ffffff;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    /* Heading */
    h2 {
        color: #444;
        margin-bottom: 20px;
    }

    /* Labels and Inputs */
    label {
        display: block;
        font-size: 14px;
        margin-bottom: 8px;
        text-align: left;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    /* Buttons */
    button {
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    a {
        background-color: red;
        margin-top: 30px;
        font-size: 14px;
        color: white;
        height: 4px;

    }


    a:hover {
        background-color: red;
    }

    /* Link Styling */


    /* Responsive Design */
    @media (max-width: 480px) {
        form {
            padding: 15px;
        }

        button {
            font-size: 14px;
            padding: 8px 12px;
        }

        input[type="text"],
        input[type="email"] {
            padding: 8px;
        }
    }

    .bt a button {
        background-color: red;
        color: red;
        position: absolute;
        z-index: -1;
        margin-top: 70px;
    }
</style>

<body>
    <div class="form">
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

            <!-- <center><a href="register.php">Back to login page</a></center> -->
            <!-- <div class="fp"> <center><a href="register.php">Back to login page</a></center></div> -->
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
        <div class="bt">
            <a href="register.php"><button>Back to login page</button></a>
        </div>

    </div>

</body>

</html>