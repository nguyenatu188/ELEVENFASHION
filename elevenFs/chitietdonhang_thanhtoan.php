<?php
// Include the database connection
include 'connect.php';

// Retrieve selected products from the cart
$selectedProductsSql = "SELECT product.*, cart.quantity AS quantity FROM product JOIN cart ON product.pid = cart.pid WHERE cart.checks = 1 and uid={$_SESSION['uid']}";
$selectedProductsResult = $conn->query($selectedProductsSql);

// Initialize total price variable
$totalPrice = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
</head>
<body>
    <div class="col-md-5 mx-auto pb-4 text-left">
        <h2 class="text-left mb-4 mt-5 pb-4 border-bottom border-secondary-subtle">Thông tin đơn hàng</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Size</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display selected products
                while ($row = $selectedProductsResult->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><img src="images/<?php echo $row['pImage']; ?>" alt="Product Image" style="max-width: 400px; max-height: 400px;"></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['size']; ?></td>
                        <td><?php echo '$' . ($row['price'] * $row['quantity']); ?></td>
                    </tr>
                    <?php
                    // Add product price to total price
                    $totalPrice += ($row['price'] * $row['quantity']);
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Tổng cộng</th>
                    <th id="total">
                        <?php
                        echo '$' . $totalPrice; // Display total price
                        ?>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

<?php
// Save total price in session variable
$_SESSION['totalPrice'] = $totalPrice;

// Close database connection
$conn->close();
?>