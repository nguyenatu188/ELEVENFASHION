<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    exit("Please log in to add items to your cart.");
}

// Get the pname and size from the form submission using GET method
$pname = isset($_GET['pname']) ? $_GET['pname'] : '';
$size = isset($_GET['size']) ? $_GET['size'] : '';

// Validate inputs
if (empty($pname) || empty($size)) {
    exit("Product name and size are required.");
}

// Include database connection
include 'connect.php';

// Get uid of the logged-in user
$uid = $_SESSION['uid'];

// Query to check if the product with the given size is already in the cart
$checkCartQuery = "SELECT quantity FROM cart WHERE uid = '$uid' AND pid IN (SELECT pid FROM product WHERE pName = '$pname' AND size = '$size')";
$checkCartResult = $conn->query($checkCartQuery);

if ($checkCartResult->num_rows > 0) {
    // Product already exists in the cart, update quantity
    $row = $checkCartResult->fetch_assoc();
    $quantity = $row['quantity'] + 1;

    // Update quantity in the cart table
    $updateSql = "UPDATE cart SET quantity = '$quantity' WHERE uid = '$uid' AND pid IN (SELECT pid FROM product WHERE pName = '$pname' AND size = '$size')";
    if ($conn->query($updateSql) === TRUE) {
        // Redirect to cart.php after adding the product to the cart
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Product does not exist in the cart, add a new record
    // Query to get pid of the product with the specified size
    $getPidQuery = "SELECT pid FROM product WHERE pName = '$pname' AND size = '$size'";
    $getPidResult = $conn->query($getPidQuery);

    if ($getPidResult->num_rows > 0) {
        // Product found with the specified size, get the pid
        $row = $getPidResult->fetch_assoc();
        $pid = $row['pid'];

        // Insert into cart table with quantity = 1
        $insertSql = "INSERT INTO cart (uid, pid, quantity) VALUES ('$uid', '$pid', '1')";
        if ($conn->query($insertSql) === TRUE) {
            // Redirect to cart.php after adding the product to the cart
            header("Location: cart.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Product not found with the specified size
        echo "Product not found with the specified size.";
    }
}

// Close database connection
$conn->close();
?>
