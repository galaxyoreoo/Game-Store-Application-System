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

// Retrieve total price from cart_total table for the latest cart_id
$sql = "SELECT total_price FROM cart_total ORDER BY cart_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPrice = $row["total_price"];
} else {
    $totalPrice = 0;
}


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="pay.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/c695495eed.js" crossorigin="anonymous"></script>
    <style>
        /* Hide Virtual Account Number by default */
        #virtual_account {
            display: none;
        }

        /* Style for Payment Option */
        #payment_option {
            color: black; /* Change text color to black */
        }

        /* Flexbox styling for centering */
        .qris-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style for virtual account number */
        #virtual_account_number_display {
            color: black; /* Change text color to black */
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
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
        <form action="payment.php" method="post">
            <h1>Payment Page</h1>
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="text" name="total_price" id="total_price" placeholder="Total Price" value="<?php echo number_format($totalPrice, 0, ',', '.'); ?>" disabled>
                <i class='bx bxs-dollar-circle'></i>
            </div>
            <div class="form-group">
                <label for="payment_option">Payment Option</label>
                <select name="payment_option" id="payment_option">
                    <option value="" selected disabled hidden>Select Payment Option</option> <!-- Add empty option -->
                    <option value="qris">QRIS</option>
                    <option value="virtual_account">Virtual Account</option>
                </select>
            </div>
            <div id="qris" class="form-group qris-container">
                <img src="qris.jpg" alt="QRIS Image">
                <p>Please upload your Proof of Payment here:</p>
                <a href="https://drive.google.com/drive/folders/19tvtxLdNydRqT9Ujlo15S5xrmRccQm_I" target="_blank">Proof of Payment</a>
                <p>Rename your Proof Picture use this format: "Username_ID_Server"</p>
            </div>
            <div id="virtual_account" class="form-group virtual-account-container">
                <label for="virtual_account_number">Virtual Account Number</label>
                <div id="virtual_account_number_display" style="display: none;">1560019618570</div>
                <p>Please upload your Proof of Payment here:</p>
                <a href="https://drive.google.com/drive/folders/19tvtxLdNydRqT9Ujlo15S5xrmRccQm_I" target="_blank">Proof of Payment</a>
                <p>Rename your Proof Picture use this format: "Username_ID_Server"</p>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script>
        const paymentOption = document.getElementById('payment_option');
        const qrisContainer = document.getElementById('qris');
        const virtualAccountContainer = document.getElementById('virtual_account');
        const virtualAccountNumberDisplay = document.getElementById('virtual_account_number_display');

        // Hide QRIS image and Virtual Account Number by default
        qrisContainer.style.display = 'none';
        virtualAccountNumberDisplay.style.display = 'none';

        paymentOption.addEventListener('change', function() {
            if (this.value === 'qris') {
                qrisContainer.style.display = 'block'; // Show QRIS image
                virtualAccountContainer.style.display = 'none'; // Hide Virtual Account
                virtualAccountNumberDisplay.style.display = 'none'; // Hide Virtual Account Number
            } else if (this.value === 'virtual_account') {
                qrisContainer.style.display = 'none'; // Hide QRIS image
                virtualAccountContainer.style.display = 'block'; // Show Virtual Account
                virtualAccountNumberDisplay.style.display = 'block'; // Show Virtual Account Number
            }
        });
    </script>
</body>

</html>
