<?php
    session_start();

    // Retrieve shipping details from session variables
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $phoneNumber = $_SESSION['phoneNumber'];
    $address = $_SESSION['address'];
    $selectedPayMethod = $_SESSION['selectedPayMethod'];

    // Retrieve chosen payment method from session variable
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {

            // Include the database connection
            include 'connect.php';

            // Retrieve total price from the session variable
            $totalPrice = $_SESSION['totalPrice'];

            // Insert into orders table
            $insertOrderQuery = "INSERT INTO orders (oDate, payMethod, total, uid) VALUES (CURDATE(), '$selectedPayMethod', $totalPrice, {$_SESSION['uid']})";
            $conn->query($insertOrderQuery);

            // Get the last inserted order ID
            $orderId = $conn->insert_id;

            $selectedProductsSql = "SELECT product.*, cart.quantity AS quantity FROM product JOIN cart ON product.pid = cart.pid WHERE cart.checks = 1 and uid={$_SESSION['uid']}";
            $selectedProductsResult = $conn->query($selectedProductsSql);

            while ($row = $selectedProductsResult->fetch_assoc()) {
            $productId = $row['pid'];
            $quantity = $row['quantity'];
            $subtotal = $row['price'] * $quantity;
    
            $insertOrderDetailQuery = "INSERT INTO order_detail (oid, pid, soLuong, sub_total) VALUES ($orderId, $productId, $quantity, $subtotal)";
            $conn->query($insertOrderDetailQuery);
            }

            // Insert into shipping table
            $insertShippingQuery = "INSERT INTO shipping (receiverFirstName, receiverLastName, receiverPhone, shippingTo, oid) 
                                    VALUES ('$firstname', '$lastname', '$phoneNumber', '$address', $orderId)";
            $conn->query($insertShippingQuery);

            // Close database connection
            $conn->close();

            // Redirect to a thank you page or any other page
            header('Location: lichsudonhang.php');
            exit();
        } else {
            echo "Error";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
</head>
<body>
    <style>
        input {
            border:none;
            border-color: white;
            width: 100%;
        }
    </style>
    <?php include 'header.php'; ?>
    <main class="m-auto">
        <div class="container text-center w-50">
            <div class="containner icon_step row fs-4">
                <div class="container icon_step_text col">
                    <i class="bi bi-1-circle-fill"></i>
                    <p>Shipping</p>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-arrow-right "></i>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-2-circle-fill"></i>
                    <p>Payment</p>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-3-circle-fill"></i> 
                    <p>Complete</p>
                </div>
            </div>
        </div>
        <div class="container row m-auto">
            <form action="thanhtoan_3.php" method="post" class="col-md-5 mx-auto border-bottom border-dark pb-4">
                <h2 class="text-left mb-4 mt-5 pb-4 border-bottom border-secondary-subtle">Order Details</h2>
                <div class="form-check-label">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" class="custom-input" value="<?php echo $firstname,' ',$lastname; ?>" disabled>
                </div>
                <div class="form-check-label">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="tel" id="phone_number" class="custom-input" value="<?php echo $phoneNumber; ?>" disabled>
                </div>
                <div class="form-check-label">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" id="address" class="custom-input" value="<?php echo $address; ?>" disabled>
                </div>
                <div class="form-check-label">
                    <label for="payment_method" class="form-label">Payment Method:</label>
                    <input type="text" id="payment_method" class="custom-input" value="<?php echo $selectedPayMethod; ?>" disabled>
                </div>
                <div class="mb-3 mt-5">
                    <button type="submit" name="submit" class="btn btn-dark btn-block w-100">Submit</button>
                </div>
            </form>
            <?php include 'chitietdonhang_thanhtoan.php'; ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>