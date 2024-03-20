<?php
// Include the file to establish a database connection
include 'connect.php';

// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute a query to check if the user exists in the admin table
    $stmt = $conn->prepare("SELECT username FROM admin WHERE username = ? AND password = ?");
    
    // Check if the prepare() call succeeded
    if ($stmt === false) {
        die('Failed to prepare statement: ' . $conn->error);
    }
    
    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $email, $password);
    if (!$stmt->execute()) {
        die('Error executing statement: ' . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // Admin exists, set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        
        // Redirect to the admin page
        header("Location: Quanly.php");
        exit();
    } else {
        // Check if the user exists in the regular user table
        $stmt = $conn->prepare("SELECT uid FROM users WHERE email = ? AND password = ?");
        if ($stmt === false) {
            die('Failed to prepare statement: ' . $conn->error);
        }
        $stmt->bind_param("ss", $email, $password);
        if (!$stmt->execute()) {
            die('Error executing statement: ' . $stmt->error);
        }
        $result = $stmt->get_result();
        
        // Check if any row is returned
        if ($result->num_rows > 0) {
            // Regular user exists, set session variables and redirect to regular user page
            $row = $result->fetch_assoc();
            $_SESSION['loggedin'] = true;
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['email'] = $email;
            header("Location: new_in.php");
            exit();
        } else {
            // User does not exist or invalid credentials, redirect back to login page with an error message
            header("Location: dangnhap.php?error=Invalid email or password");
            exit();
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>