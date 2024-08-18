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

// Get data from form submission
$game_id = $_POST['game_id'];
$server = $_POST['server'];
$items = $_POST['items'];
$price = $_POST['price'];

// Get username from session
$username = $_SESSION['username']; // Assuming the username is stored in the session

// Prepare SQL statement to insert cart entry
$sql_insert = "INSERT INTO user_carts (username, game_id, server, items, price) VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("ssssd", $username, $game_id, $server, $items, $price);

// Execute SQL statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
