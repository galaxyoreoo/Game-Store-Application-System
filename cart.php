<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart</title>
<link rel="stylesheet" href="transaction.css">
<script src="https://kit.fontawesome.com/c695495eed.js" crossorigin="anonymous"></script>
<style>
    /* CSS untuk membuat data sejajar dengan kolom di container1 */
    .additional-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        max-width: 1000px;
        margin: auto;
        text-align: center;
        margin-top: 20px;
    }
    .row {
        /* Menghapus border */
        border: none;
        /* Menambahkan padding untuk menjaga jarak antar elemen */
        padding: 10px;
    }
    .checkbox-container {
        text-align: center;
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
        <a href="../Cart/cart.html" class="navbar-item"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
    </div>
    <div class="navbar-right">
        <a href="../SignIn/login.html" class="navbar-item">Sign In</a>
        <a href="../SignUp/register.html" class="navbar-item">Sign Up</a>
    </div>
</nav>

<div class="search-container">
    <span class="invoice-label">Shopping Cart</span>
    <div class="button-container">
        <button id="selectAllButton" class="select-button">Select All</button>
    </div>
    <div class="total-price-container">
        <div class="total-price-box">
            <label>Total Price:</label>
            <span id="totalPrice"></span>
        </div>
    </div>
    
    <!-- Container 1 -->
    <div class="container" id="container1">
        <div class="column" style="margin-left: 240px;">ID</div>
        <div class="column" style="margin-left: 100px;">Server</div>
        <div class="column">Item Name</div>
        <div class="column" style="margin-right: 90px;">Price</div>
    </div>

    <!-- Container 2 -->
    <div class="container" id="container1">
        <?php include 'fetch_data.php'; ?>  
    </div>

     <!-- Submit button -->
     <button id="submitButton">Submit</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('#container1 input[type=checkbox]');
        var selectAllButton = document.getElementById('selectAllButton');

        // Event listener for "Select All" button
        selectAllButton.addEventListener('click', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true; // Menandai semua kotak centang
            });
            updateTotalPrice(); // Update total price when checkboxes are changed
        });

        // Event listener for individual checkboxes
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Uncheck "Select All" button if any checkbox is unchecked
                if (!checkbox.checked) {
                    selectAllButton.checked = false;
                }
                updateTotalPrice(); // Update total price when checkboxes are changed
            });
        });

        var submitButton = document.getElementById('submitButton');
        var totalPriceDisplay = document.getElementById('totalPrice');

        // Function to calculate total price
        function calculateTotalPrice() {
            var totalPrice = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.dataset.price);
                    totalPrice += price;
                }
            });
            return totalPrice.toFixed(2);
        }

        // Update total price display
        function updateTotalPrice() {
            totalPriceDisplay.textContent = '' + number_format(calculateTotalPrice(), 0, ',', '.');
        }

        // Event listener for submit button
        submitButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            var totalPrice = calculateTotalPrice();
            // Send total price to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_total.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Success
                    console.log('Total price saved successfully.');
                } else {
                    // Error
                    console.error('Error saving total price: ' + xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed.');
            };
            xhr.send('totalPrice=' + totalPrice);
        });

        // Function to format numbers with thousand separators
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    });

    submitButton.addEventListener('click', function(event) {
        // Redirect to another page
        window.location.href = '../Payments/fetch_pay.php';
    });
</script>


</body>
</html>
