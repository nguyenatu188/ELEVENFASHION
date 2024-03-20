<?php
    session_start();

    // Check if the user is logged in and has a user ID stored in the session
    if (!isset($_SESSION['uid'])) {
        // Redirect the user to the login page if not logged in
        header("Location: dangnhap.php");
        exit;
    }

    // Include the database connection
    include 'connect.php';

    // Fetch user details from the database based on the user's ID
    $userId = $_SESSION['uid'];
    $sql = "SELECT * FROM users WHERE uid = $userId";
    $result = $conn->query($sql);

    // Check if user details are found
    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();
        $firstName = $userData['firstName'];
        $lastName = $userData['lastName'];
        $phoneNumber = $userData['phoneNo'];
        $address = $userData['address'];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continue'])) {
            // Retrieve the updated user information from the hidden input fields
            $FFirstName = $_POST['Ffirst_name'];
            $FLastName = $_POST['Flast_name'];
            $FPhoneNumber = $_POST['Fphone_number'];
            $FAddress = $_POST['Faddress'];
            
            // Set session variables with the updated information
            $_SESSION['firstname'] = $FFirstName;
            $_SESSION['lastname'] = $FLastName;
            $_SESSION['phoneNumber'] = $FPhoneNumber;
            $_SESSION['address'] = $FAddress;
            
            // Redirect user to thanhtoan_2.php after setting session variables
            header("Location: thanhtoan_2.php");
            exit;
        }
    } else {
        // Handle case when user details are not found
        $firstName = '';
        $lastName = '';
        $phoneNumber = '';
        $address = '';
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
                <div class="container icon_step_text col opacity-25">
                    <i class="bi bi-2-circle"></i>
                    <p>Payment</p>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="container icon_step_text col opacity-25">
                    <i class="bi bi-3-circle"></i> 
                    <p>Complete</p>
                </div>
            </div>
        </div>
        <div class="container row m-auto">
        <form method="post" class="col-md-5 mx-auto pb-4">
            <h1 class="text-left mb-4 mt-5 pb-4 border-bottom border-secondary-subtle">Shipping details</h1>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="Ffirst_name" name="Ffirst_name" placeholder="Nhập họ của bạn" value="<?php echo $firstName; ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="Flast_name" name="Flast_name" placeholder="Nhập tên của bạn" value="<?php echo $lastName; ?>">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="Fphone_number" name="Fphone_number" placeholder="Nhập số điện thoại" value="<?php echo $phoneNumber; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="Faddress" name="Faddress" placeholder="Nhập địa chỉ của bạn" value="<?php echo $address; ?>">
            </div>
            <div class="mb-3 mt-5">
                <button type="submit" name="continue" class="btn btn-dark btn-block w-100">Continue</button>
            </div>
        </form>
            <?php include 'chitietdonhang_thanhtoan.php'; ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
    // Close the database connection
    $conn->close();
?>
