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

// Prepare SQL statement to fetch user's cart data
$sql = "SELECT game_id, server, items, price FROM user_carts WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("s", $username);

// Execute SQL statement
$result = $stmt->execute();

if ($result === false) {
    die("Error executing SQL: " . $stmt->error);
}

// Get result set
$result = $stmt->get_result();

// Display data in the desired format
if ($result->num_rows > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
            }
            td {
                padding: 40px 70px;
            }
          </style>";

    echo "<table id='cart-table'>";
    $totalPrice = 0; // Initialize total price
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='selected_rows[]' value='" . $row['game_id'] . "' data-price='" . $row['price'] . "'></td>";

        echo "<td>" . substr($row["game_id"], 0, 6) . "</td>";
        echo "<td>" . $row["server"] . "</td>";
        echo "<td>" . $row["items"] . "</td>";
        echo "<td>" . number_format($row["price"], 0, ',', '.') . "</td>";
        echo "</tr>";
        // Calculate total price
        $totalPrice += $row["price"];
    }
    echo "</table>";

    // Add JavaScript code to calculate total price
    echo "<script>
            document.querySelectorAll('#cart-table input[type=checkbox]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var totalPrice = 0;
                    document.querySelectorAll('#cart-table input[type=checkbox]:checked').forEach(function(checkedCheckbox) {
                        totalPrice += parseInt(checkedCheckbox.getAttribute('data-price'));
                    });
                    
                    // Store the total price in the database
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'store_total_price.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('total_price=' + totalPrice);
                });
            });
          </script>";

} else {
    echo "No data found";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

<p id="total-price"></p>
