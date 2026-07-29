<?php
// Database connection settings
$servername = "localhost"; // Change this if your database server is not local
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "records"; // Replace with your database name

// Create connection
$con = new mysqli("localhost", "root", "", "records");

// Check connection

if(isset($_POST['s']))

 {

 $customername=$_POST['fullname'];
 $customeremail=$_POST['email'];
 $address=$_POST['useraddress'];


$query="INSERT INTO customer(fullname,email,useraddress VALUES ('$fullname','$customeremail','$address')";

$run=mysqli_query($con, $query);
}

?>
