<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to the login page
    header("Location: dangnhap.php");
    exit();
}

// Get uid of the logged-in user
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

// Include the database connection
include 'connect.php';

// Check if the form is submitted for quantity update or checkbox state update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if $uid is set
    if ($uid !== null) {
        // Check if quantity is provided
        if (isset($_POST['quantity']) && isset($_POST['pid'])) {
            $pid = intval($_POST['pid']); // Sanitize the product ID
            $quantity = intval($_POST['quantity']); // Sanitize the quantity
            // Perform the update query for quantity
            $updateQuantitySql = "UPDATE cart SET quantity = '$quantity' WHERE uid = '$uid' AND pid = '$pid'";
            if ($conn->query($updateQuantitySql) !== TRUE) {
                echo "Error updating quantity: " . $conn->error;
            } else {
                $_SESSION['cart'][$pid] = $quantity;
            }
        }
        // Check if checkbox state is provided
        if (isset($_POST['isChecked']) && isset($_POST['pid'])) {
            $pid = intval($_POST['pid']); // Sanitize the product ID
            $isChecked = intval($_POST['isChecked']); // Sanitize the checkbox state
            // Perform the update query for checkbox state
            $updateCheckSql = "UPDATE cart SET checks = '$isChecked' WHERE uid = '$uid' AND pid = '$pid'";
            if ($conn->query($updateCheckSql) !== TRUE) {
                echo "Error updating checkbox state: " . $conn->error;
            }
        }

        // Check if delete_selected button is clicked
        if (isset($_POST['delete_selected'])) {
            // Delete selected products from the cart where checks = 1
            $deleteSelectedSql = "DELETE FROM cart WHERE uid = '$uid' AND checks = 1";
            if ($conn->query($deleteSelectedSql) !== TRUE) {
                echo "Error deleting selected products: " . $conn->error;
            }
        }
    }
    // Redirect back to cart page after processing form submission
    header("Location: cart.php");
    exit();
}

// Fetch cart items from the database
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cartSql = "SELECT product.*, cart.quantity AS quantity, cart.checks AS checks FROM product JOIN cart ON product.pid = cart.pid WHERE cart.uid = '$uid'";
$cartResult = $conn->query($cartSql);

// Store cart items in an array
$cartItems = array();
while ($row = $cartResult->fetch_assoc()) {
    $cartItems[] = $row;
}

$totalAmount = 0;
foreach ($cartItems as $row) {
    if ($row['checks'] == 1) {
        $totalAmount += $row['price'] * $row['quantity'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        div.container h1 {
            font-family: 'Jura', sans-serif;
            font-weight: 400;
            font-size: 25px;
        }
        /* Increase checkbox size */
        input.select-checkbox {
            width: 30px;
            height: 30px;
        }
        /* Justify content to align checkboxes with the "Chọn" column */
        th:first-child,
        td:first-child {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center mb-4">Cart</h1>
    </div>
    <div class="container mb-5">
        <div class="container title_cart border-bottom border-black">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="" class="pb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Chọn</th>
                                    <th>Product</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $row) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="selected_products[]" value="<?= $row['pid']; ?>" class="form-check-input select-checkbox" <?= $row['checks'] == 1 ? 'checked' : ''; ?> onchange="handleCheckboxChange(this)"></td>
                                        <td><img src="images/<?= $row['pImage']; ?>" alt="Hình ảnh sản phẩm" style="max-width: 400px; max-height: 400px;"></td>
                                        <td><?= $row['pName']; ?></td>
                                        <td><?= $row['size']; ?></td>
                                        <td>
                                            <button type="button" class="minus-button" data-pid="<?= $row['pid']; ?>" onclick="decreaseAmount(this)">-</button>
                                            <span class="amount" id="quantity_<?= $row['pid']; ?>"><?= $row['quantity']; ?></span>
                                            <button type="button" class="plus-button" data-pid="<?= $row['pid']; ?>" onclick="increaseAmount(this)">+</button>
                                        </td>
                                        <td><?= $row['price']; ?>VND</td>
                                        <td class="subtotal"><?= $row['price'] * $row['quantity']; ?>VND</td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($cartItems)) : ?>
                                    <tr>
                                        <td colspan="7">No items in the cart.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" onclick="selectAll()">Chọn tất cả</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" name="delete_selected" class="btn btn-danger">Xóa sản phẩm đã chọn</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6 text-center">
                <p class="font-weight-bold">Tổng tiền: <span id="total">VND<?php echo number_format($totalAmount, 2); ?></span></p>
                <a href="thanhtoan_1.php" class="btn btn-success">Thanh toán</a>
            </div>
        </div>
    </div>   
    <?php include 'footer.php'; ?>

    <script>
        // Function to calculate total
        function calculateTotal() {
            var checkboxes = document.querySelectorAll('.select-checkbox');
            var total = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var row = checkbox.closest('tr');
                    var subtotal = parseFloat(row.querySelector('.subtotal').textContent.replace('VND', ''));
                    total += subtotal;
                }
            });
            return total.toFixed(2);
        }

        // Function to update total display
        function updateTotal() {
            var totalElement = document.getElementById('total');
            totalElement.textContent = 'VND' + calculateTotal();
        }

        // Function to handle checkbox change
        function handleCheckboxChange(checkbox) {
            var pid = checkbox.value;
            var isChecked = checkbox.checked ? 1 : 0;
            var quantity = parseInt(checkbox.closest('tr').querySelector('.amount').textContent); // Get the current quantity
            updateQuantityAndChecks(pid, quantity, isChecked);
            updateTotal();
        }


        // Function to decrease amount
        function decreaseAmount(button) {
            var pid = button.getAttribute('data-pid');
            var amountElement = button.nextElementSibling;
            var currentAmount = parseInt(amountElement.textContent);
            if (currentAmount > 1) {
                amountElement.textContent = currentAmount - 1;
                updateSubtotal(amountElement);
                updateTotal();
                updateQuantityAndChecks(pid, currentAmount - 1, null); // Send AJAX request to update quantity
            }
        }

        // Function to increase amount
        function increaseAmount(button) {
            var pid = button.getAttribute('data-pid');
            var amountElement = button.previousElementSibling;
            var currentAmount = parseInt(amountElement.textContent);
            amountElement.textContent = currentAmount + 1;
            updateSubtotal(amountElement);
            updateTotal();
            updateQuantityAndChecks(pid, currentAmount + 1, null); // Send AJAX request to update quantity
        }

        // Function to update quantity and checkbox state in the database via AJAX
        function updateQuantityAndChecks(pid, quantity, isChecked) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true); // Send the request to the same page
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                }
            };
            xhr.send('pid=' + pid + '&quantity=' + quantity + '&isChecked=' + isChecked);
        }


        // Function to update subtotal
        function updateSubtotal(amountElement) {
            var priceElement = amountElement.parentElement.nextElementSibling;
            var subtotalElement = priceElement.nextElementSibling;
            var price = parseFloat(priceElement.textContent.replace('VND', ''));
            var amount = parseInt(amountElement.textContent);
            var subtotal = price * amount;
            subtotalElement.textContent = 'VND' + subtotal.toFixed(2);
        }

        // Add event listeners to checkboxes
        var checkboxes = document.querySelectorAll('.select-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(checkbox);
            });
        });

        function selectAll() {
            var checkboxes = document.querySelectorAll('.select-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
                handleCheckboxChange(checkbox);
            });
            updateTotal();
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>