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
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $password = $row['password'];
    $phone = $row['phone'];
    $birthdate = $row['birthdate'];
} else {
    echo "Error: Unable to retrieve user information";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
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
            <a href="../Cart/cart.php" class="navbar-item"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
        </div>
        <div class="navbar-right">
            <a href="../SignIn/login.html" class="navbar-item">Sign In</a>
            <a href="../SignUp/register.html" class="navbar-item">Sign Up</a>
        </div>
    </nav>

    <div class="wrapper">
        <form action="profile.php" method="post">
          <h1>Profile</h1>
          <div class="input-box">
            <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username, ENT_QUOTES)?>" disabled>
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="password" name="password" placeholder="*******"  disabled>
            <i class='bx bxs-lock-alt' ></i>
          </div>
          <div class="input-box">
                <input type="tel" name="phone" placeholder="Phone Number" value="<?= htmlspecialchars($phone, ENT_QUOTES)?>" disabled>
                <i class='bx bxs-phone'></i>
              </div>
              <div class="input-box">
                <input type="text" name="birthdate" placeholder="Birth Date" value="<?= htmlspecialchars($birthdate, ENT_QUOTES)?>" onfocus="this.type='Date'" onblur="this.type='text'" disabled>
                <i class='bx bxs-calendar' ></i>
            </div>
        <a href="../Info Account/update_profile.php">
        <button class="btn" name="submit">Edit</button></a>
        </form>
    </div>
</body>
</html>
