<!DOCTYPE html>
<html>

<head>
<?php
include_once('connect.php');

$errors = [];
$message = '';

function isPhoneNumberExists($conn, $phoneNo, $currentUserId) {
    $query = "SELECT uid FROM users WHERE phoneNo = ? AND uid != ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $phoneNo, $currentUserId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $count = mysqli_stmt_num_rows($stmt);

        mysqli_stmt_close($stmt);

        return $count > 0;
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $userFirstName = $_POST['userfirstname'];
    $userLastName = $_POST['userlastname'];
    $userEmail = $_POST['useremail'];
    $userPhoneNo = $_POST['userphoneno'];
    $userPassword = $_POST['userpassword'];
    $userAddress = $_POST['useraddress'];

    // Validate or sanitize input data as needed

    if (empty($errors)) {
        // Check if the phone number already exists
        if (isPhoneNumberExists($conn, $userPhoneNo, $id)) {
            $errors[] = "Số điện thoại này đã được đăng ký.";
        }

        // Continue with the rest of the validation

        if (empty($errors)) {
            // Use prepared statement to prevent SQL injection
            $query = "UPDATE users SET firstName = ?, lastName = ?, email = ?, phoneNo = ?, password = ?, address = ? WHERE uid = ?";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssssssi', $userFirstName, $userLastName, $userEmail, $userPhoneNo, $userPassword, $userAddress, $id);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $message = "Cập nhật thông tin người dùng thành công!";
                } else {
                    $message = "Lỗi! Không thể cập nhật thông tin người dùng.";
                }

                mysqli_stmt_close($stmt);
            } else {
                $message = "Lỗi! Không thể tạo truy vấn.";
            }
        } else {
            // Combine error messages
            $message = "Có lỗi xảy ra:<br>" . implode('<br>', $errors);
        }
    }
} else {
    // Nếu không phải là form submit, truy xuất thông tin cũ từ cơ sở dữ liệu
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE uid = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                $userFirstName = $user['firstName'];
                $userLastName = $user['lastName'];
                $userEmail = $user['email'];
                $userPhoneNo = $user['phoneNo'];
                $userPassword = $user['password'];
                $userAddress = $user['address'];
            } else {
                // Handle case when user is not found
                $message = "Không tìm thấy người dùng.";
            }
        } else {
            // Handle query error
            $message = "Lỗi! Không thể truy vấn cơ sở dữ liệu.";
        }
    }
}
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Người Dùng - ELEVEN FASHION</title>

    
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
        <form action="" method="post" class="col-md-6 mx-auto pb-4">
            <h1 class="text-center mb-4">SỬA NGƯỜI DÙNG</h1>
            <?php if ($message) : ?>
                <div class="alert alert-<?php echo (strpos($message, 'Cập nhật thông tin người dùng thành công') !== false) ? 'success' : 'danger'; ?> mt-3">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <button type="button" class="btn btn-secondary" onclick="location.href='Quanlynguoidung.php';">Trở về</button>
            <!-- Populate form fields with existing user data -->
            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">

            <div class="mb-3">
                <label for="userfirstName" class="form-label">Họ người dùng <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userfirstName" name="userfirstname" value="<?php echo htmlspecialchars($userFirstName); ?>">
            </div>
            <div class="mb-3">
                <label for="userlastName" class="form-label">Tên người dùng <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userlastName" name="userlastname" value="<?php echo htmlspecialchars($userLastName); ?>">
            </div>
            <div class="mb-3">
                <label for="useremail" class="form-label">Email <span style="color:red;">*</span></label>
                <input type="email" class="form-control" id="useremail" name="useremail" value="<?php echo htmlspecialchars($userEmail); ?>">
            </div>
            <div class="mb-3">
                <label for="userphoneno" class="form-label">Số điện thoại <span style="color:red;">*</span></label>
                <input type="tel" class="form-control" id="userphoneno" name="userphoneno" value="<?php echo htmlspecialchars($userPhoneNo); ?>">
            </div>
            <div class="mb-3">
                <label for="userpassword" class="form-label">Mật khẩu <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="userpassword" name="userpassword" value="<?php echo htmlspecialchars($userPassword); ?>">
            </div>
            <div class="mb-3">
                <label for="useraddress" class="form-label">Địa chỉ <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="useraddress" name="useraddress" value="<?php echo htmlspecialchars($userAddress); ?>">
            </div>

            <button type="submit" class="btn btn-secondary">Lưu thay đổi</button>

        </form>

    </main>
</body>

</html>
