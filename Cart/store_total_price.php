<?php
session_start(); // Start session if not already started

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se_db2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from session
$username = $_SESSION['username']; // Assuming the username is stored in the session

// Get total price from POST request
$totalPrice = $_POST['total_price']; 

// Prepare SQL statement to insert total price into user_orders table
$sql = "INSERT INTO cart_total (username, total_price) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sd", $username, $totalPrice);

// Execute SQL statement
$result = $stmt->execute();

if ($result === false) {
    die("Error executing SQL: " . $stmt->error);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
