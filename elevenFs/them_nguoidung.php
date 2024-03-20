<!DOCTYPE html>
<html>
    
<head>
<?php
include_once('connect.php');

$errors = [];

$selectDesignersQuery = "SELECT * FROM users";
$result = mysqli_query($conn, $selectDesignersQuery);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

mysqli_free_result($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userfirstName = mysqli_real_escape_string($conn, $_POST["userfirstName"]);
    $userlastName = mysqli_real_escape_string($conn, $_POST["userlastName"]);
    $userEmail = mysqli_real_escape_string($conn, $_POST["userEmail"]);
    $userPhoneNo = mysqli_real_escape_string($conn, $_POST["userPhoneNo"]);
    $userPassword = mysqli_real_escape_string($conn, $_POST["userPassword"]);
    $userAddress = mysqli_real_escape_string($conn, $_POST["userAddress"]);

    $checkPhoneQuery = "SELECT * FROM users WHERE phoneNo = '$userPhoneNo'";
    $checkResult = mysqli_query($conn, $checkPhoneQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Phone number already exists, display an error message
        echo "Số điện thoại đã được đăng kí.";
    } else {
        $insertQuery = "INSERT INTO users (firstName, lastName, email, phoneNo, password, address) 
                        VALUES ('$userfirstName', '$userlastName', '$userEmail', '$userPhoneNo', '$userPassword', '$userAddress')";

        if (mysqli_query($conn, $insertQuery)) {
            header("Location: Quanlynguoidung.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm Sản Phẩm - ELEVEN FASHION</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Kaisei+Tokumin&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

            <style>
            body {
                font-family: 'Jura', sans-serif;
                background-color: #f8f9fa;
                color: #343a40;
            }

            header {
                background-color: #ffffff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .container1 {
                border-bottom: 1px solid #dee2e6;
                padding: 1rem;
            }

            .container2 {
                border-bottom: 1px solid #dee2e6;
                padding: 0.5rem;
            }

            main {
                background-color: #ffffff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 2rem;
                border-radius: 8px;
                margin-top: 20px;
            }

            h1 {
                color: #010101;
            }

            .card {
                margin-top: 20px;
                border: 1px solid #000000;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(71, 70, 70, 0.955);
                padding: 20px;
            }

            .btn-outline-primary {
                background-color: #4c4c4d;
                color: #ffffff;
                border: 1px solid #4c4c4d;
            }

            table {
                width: 100%;
            }

            th,
            td {
                text-align: center;
            }

            th {
                background-color: #007bff;
                color: #ffffff;
            }

            .action-icons {
                font-size: 20px;
                cursor: pointer;
                margin-right: 5px;
            }

            
        </style>

    </head>

    
<body>
    <header class="text-dark py-3">
        <div class="container1 container text-center py-1">
            <div class="d-flex justify-content-between align-items-center">
                <a href="Quanly.php" class="text-decoration-none border-start border-dark text-dark ps-5 mx-auto">ELEVEN FASHION</a>
                <button type="button" class="btn btn-light" onclick="location.href='dangxuat.php';">Đăng xuất</button>
            </div>
        </div>
    </header>

    <main class="container py-4">
        <form action="" method="post" class="col-md-6 mx-auto pb-4" enctype="multipart/form-data">
            <h1 class="text-center mb-4">THÊM NGƯỜI DÙNG</h1>
            <button type="button" class="btn btn-secondary" onclick="location.href='Quanlynguoidung.php';">Trở về</button>
        <br>
        <br>
            <div class="mb-3">
                <label for="userfirstName" class="form-label">Họ người dùng <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userfirstName" name="userfirstName" required>
            </div>

            <div class="mb-3">
                <label for="userlastName" class="form-label">Tên người dùng <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userlastName" name="userlastName" required>
            </div>

            <div class="mb-3">
                <label for="userEmail" class="form-label">Email <span style="color:red;">*</span></label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
            </div>

            <div class="mb-3">
                <label for="userPhoneNo" class="form-label">Số điện thoại <span style="color:red;">*</span></label>
                <input type="number" class="form-control" id="userPhoneNo" name="userPhoneNo" required>
            </div>

            <div class="mb-3">
                <label for="userPassword" class="form-label">Mật khẩu <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userPassword" name="userPassword" required>
            </div>

            <div class="mb-3">
                <label for="userAddress" class="form-label">Địa chỉ <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userAddress" name="userAddress" required>
            </div>

            <button type="submit" class="btn btn-secondary">Thêm người dùng</button>
        </form>
    </main>
</body>
</html>