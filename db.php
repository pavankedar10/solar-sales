<?php
$servername = "localhost"; // Change if using a different host
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "records"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
