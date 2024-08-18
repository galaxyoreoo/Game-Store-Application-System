<?php
// Database connection
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

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query database to retrieve hashed password for the given username
    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variable and redirect to home page
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ../Home/Home.html");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid username or password";
        }
    } else {
        // User not found
        echo "Invalid username or password";
    }
}

// Close connection
$conn->close();
?>
