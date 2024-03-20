<?php
// Include the database connection
include 'connect.php';

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product ID and quantity from the POST data
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the database
    $updateSql = "UPDATE cart SET quantity = '$quantity' WHERE pid = '$pid'";
    $conn->query($updateSql);

    // Close the database connection
    $conn->close();
}
?>