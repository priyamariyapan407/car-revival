<?php
// $servername = "localhost";   // Replace with your database server name
// $username   = "root";        // Replace with your database username
// $password   = "";            // Replace with your database password
// $dbname     = "car_revival"; // Replace with your database name

// // Mobile number to check
// //$mobileNumberToCheck = "1234567890"; // Replace with the mobile number you want to check

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$servername = "localhost";   // Replace with your database server name
$username   = "root";        // Replace with your database username
$password   = "";            // Replace with your database password
$dbname     = "car_revival"; // Replace with your database name

// $servername = "vehidealz.shop";        // Replace with your database server name
// $username   = "u664465396_vehi_dealz"; // Replace with your database username
// $password   = "vehi_dealZ@123";        // Replace with your database password
// $dbname     = "u664465396_vehi_dealz"; // Replace with your database name

// Mobile number to check
//$mobileNumberToCheck = "1234567890"; // Replace with the mobile number you want to check

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //   echo "connection successfull";
}
