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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data (you can add more validation)
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into database
        $sql = "INSERT INTO users (username, phone, birthdate, password) VALUES ('$username', '$phone', '$birthdate', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header("Location: ../SignIn/login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
