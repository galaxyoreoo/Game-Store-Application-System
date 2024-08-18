<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se_db2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../SignIn/login.html');
    exit;
}

// Retrieve the user information from the database
$currentUsername = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $password = $row['password'];
    $phone = $row['phone'];
    $birthdate = $row['birthdate'];
} else {
    echo "Error: Unable to retrieve user information";
}

// Update the user information in the database
// Update the user information in the database
if (isset($_POST['submit'])) {
    $newUsername = isset($_POST['username']) ? $_POST['username'] : $username;
    $password = isset($_POST['password']) ? $_POST['password'] : $password;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : $phone;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : $birthdate;

    $query = "UPDATE users SET username = ?, password = ?, phone = ?, birthdate = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $newUsername, $password, $phone, $birthdate, $username); // Note: Use $username here
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Update the session variable if the username was changed
        if ($newUsername != $username) {
            $_SESSION['username'] = $newUsername;
            header("Location: ../Info Account/infoaccount.php");
            exit();
        }
        
    } 
}


// Close the database connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Page</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/c695495eed.js" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="navbar-item">Profile</a>
            <a href="../Home/Home.html" class="navbar-item"><i class="fa-solid fa-house"></i>Home</a>
            <a href="../Transaction/transaction.html" class="navbar-item"><i class="fa-solid fa-file-invoice"></i>Transaction</a>
            <a href="../Info Account/infoaccount.php" class="navbar-item"><i class="fa-solid fa-user-large"></i>Info Account</a>
            <a href="#" class="navbar-item"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
        </div>
        <div class="navbar-right">
            <a href="../SignIn/login.html" class="navbar-item">Sign In</a>
            <a href="../SignUp/register.html" class="navbar-item">Sign Up</a>
        </div>
    </nav>

    <div class="wrapper">
        <form action="profile.php" method="post">
          <h1>Edit Profile</h1>
          <div class="input-box">
            <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username, ENT_QUOTES)?>">
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="password" name="password" placeholder="*******" >
            <i class='bx bxs-lock-alt' ></i>
          </div>
          <div class="input-box">
                <input type="tel" name="phone" placeholder="Phone Number" value="<?= htmlspecialchars($phone, ENT_QUOTES)?>">
                <i class='bx bxs-phone'></i>
              </div>
              <div class="input-box">
                <input type="text" name="birthdate" placeholder="Birth Date" value="<?= htmlspecialchars($birthdate, ENT_QUOTES)?>" onfocus="this.type='Date'" onblur="this.type='text'">
                <i class='bx bxs-calendar' ></i>
            </div>
        <button class="btn" name="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>