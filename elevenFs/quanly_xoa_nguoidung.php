<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <?php
    include_once('connect.php');
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        $result = isset($_GET['result']) ? $_GET['result'] : 'danger';
    }
  ?>
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
        <?php
    include_once('connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Xử lý khi form xóa được submit
        if (isset($_POST['delete_user'])) {
            $user_num_to_delete = $_POST['user_num_to_delete'];

            // Thực hiện truy vấn để xóa sản phẩm
            $delete_query = "DELETE FROM users WHERE phoneNo = '$user_num_to_delete'";
            $delete_result = mysqli_query($conn, $delete_query);

            // Kiểm tra và hiển thị thông báo tương ứng
            if ($delete_result) {
                $message = "Xóa người dùng thành công!";
            } else {
                $message = "Lỗi! Không thể xóa người dùng.";
            }
        }
    }

    // Hiển thị thông báo nếu có
    if (isset($message)) {
        echo "<div class='alert alert-success' role='alert'>$message</div>";
    }
    ?>
    <main class="container py-4">
    <form action="" method="post">
    <button type="button" class="btn btn-secondary" onclick="location.href='Quanlynguoidung.php';">Trở về</button>
                <br>
                <br>
        <div class="mb-3">
            <label for="user_num_to_delete" class="form-label">Nhập số điện thoại đăng kí của người dùng để xóa:</label>
            <input type="text" class="form-control" id="user_num_to_delete" name="user_num_to_delete" required>
        </div>

        <button type="submit" name="delete_user" class="btn btn-secondary">Xóa người dùng</button>
    </form>
        
    </main>
   
</body>

</html>
