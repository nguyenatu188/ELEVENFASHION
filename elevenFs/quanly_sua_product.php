<!DOCTYPE html>
<html lang="en">

<head>
<?php
include_once('connect.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $productName = $_POST['productname'];
    $productPrice = $_POST['productprice'];
    $productSize = $_POST['productsize'];
    $productMaterial = $_POST['productmaterial'];
    $productDate = $_POST['productdate'];
    $productDesignerID = $_POST['productdesignerid'];

    // Check if a file is selected
    if (!empty($_FILES['filename']['name'])) {
        $file = $_FILES['filename'];
        $size_allow = 10; // 10MB
        $filename = explode('.', $filename);
        $ext = end($filename);
        $new_file = $productName . '.' . $ext;

        $allow_ext = ['png', 'jpg', 'jpeg', 'gif'];
        if (in_array(strtolower($ext), $allow_ext)) {
            $size = $file['size'] / 1024 / 1024;

            if ($size <= $size_allow) {
                $upload_dir = 'images/';

                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $upload = move_uploaded_file($file['tmp_name'], $upload_dir . $new_file);

                if (!$upload) {
                    $errors[] = 'upload_err';
                }
            } else {
                $errors[] = 'size_err';
            }
        } else {
            $errors[] = 'ext_err';
        }
    }

    if (empty($errors)) {
        // Use prepared statement to prevent SQL injection
        $query = "UPDATE product SET pName = ?, price = ?, size = ?, fabric = ?, pImage = ?, importDate = ?, did = ? WHERE pid = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssssss', $productName, $productPrice, $productSize, $productMaterial, $new_file, $productDate, $productDesignerID, $id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $message = "Cập nhật thông tin sản phẩm thành công!";
            } else {
                $message = "Lỗi! Không thể cập nhật thông tin sản phẩm.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Lỗi! Không thể tạo truy vấn.";
        }
    }
} else {
    // Nếu không phải là form submit, truy xuất thông tin cũ từ cơ sở dữ liệu
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM product WHERE pid = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['pName'];
            $productDesignerID = $row['did'];
            $productImage = $row['pImage'];
            $productPrice = $row['price'];
            $productSize = $row['size'];
            $productMaterial = $row['fabric'];
            $productDate = $row['importDate'];
        }
    }
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sửa Sản Phẩm - ELEVEN FASHION</title>

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
            <h1 class="text-center mb-4">SỬA SẢN PHẨM</h1>
            <?php if (isset($message)) : ?>
                <div class="alert alert-<?php echo ($result) ? 'success' : 'danger'; ?> mt-3">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>

                <div>
                <button type="button" class="btn btn-secondary" onclick="location.href='Quanlysanpham.php';">Trở về</button>
                <br>
                <br>

                <div class="input-group input-group-static mb-4">
                    <label>Tên sản phẩm</label>
                    </div>
                <div>
                    <input type="text" name="productname" class="form-control" value="<?php echo $productName; ?>">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Thương hiệu</label>
                    </div>
                <div>
                    <input type="text" name="productdesignerid" class="form-control" value="<?php echo $productDesignerID; ?>">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Ảnh</label>
                    </div>
                <div>
                    <input type="file" name="filename" class="form-control">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Giá</label>
                    </div>
                <div>
                    <input type="text" name="productprice" class="form-control" value="<?php echo $productPrice; ?>">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Size</label>
                </div>
                <div>
                    <input type="text" name="productsize" class="form-control" value="<?php echo $productSize; ?>">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Chất liệu</label>
                    </div>
                <div>
                    <input type="text" name="productmaterial" class="form-control" value="<?php echo $productMaterial; ?>">
                </div>
                <br>
                <div class="input-group input-group-static mb-4">
                    <label>Ngày nhập</label>
                    </div>
                <div>
                    <input type="text" name="productdate" class="form-control" value="<?php echo $productDate; ?>">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-secondary">Cập nhật sản phẩm</button>
        </form>
    </main>
</body>

</html>
