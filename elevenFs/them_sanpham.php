<!DOCTYPE html>
<html lang="en">

<head>
<?php
include_once('connect.php');

// Lấy danh sách designers từ database
$selectDesignersQuery = "SELECT * FROM designer";
$result = mysqli_query($conn, $selectDesignersQuery);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$designers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $designer[$row['did']] = $row['dName']; // Thay 'designer_name' và 'id' bằng tên cột chứa tên và ID designer trong database
}

mysqli_free_result($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý khi form được submit

    // Lấy dữ liệu từ form
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $productImage = $_FILES["productImage"]["name"];
    $productPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
    $productSize = mysqli_real_escape_string($conn, $_POST["productSize"]);
    $productMaterial = mysqli_real_escape_string($conn, $_POST["productMaterial"]);
    $productDate = mysqli_real_escape_string($conn, $_POST["productDate"]);
    $productDesignerID = mysqli_real_escape_string($conn, $_POST["productDesigner"]);

    // Kiểm tra và xử lý dữ liệu nếu cần
    // Ví dụ: kiểm tra loại file ảnh, kích thước, và chuyển nó đến thư mục cụ thể.

    // Thêm dữ liệu vào database
    $insertQuery = "INSERT INTO product (pName, pImage, price, size, fabric, importDate, did) 
                    VALUES ('$productName', '$productImage', '$productPrice', '$productSize', '$productMaterial', '$productDate', '$productDesignerID')";

    if (mysqli_query($conn, $insertQuery)) {
        // Nếu thành công, chuyển hướng đến trang thành công hoặc hiển thị thông báo
        header("Location: Quanly.php");
        exit();
    } else {
        // Nếu có lỗi, xử lý nó
        echo "Error: " . mysqli_error($conn);
    }
}
// Đóng kết nối database
mysqli_close($conn);
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
            <h1 class="text-center mb-4">THÊM SẢN PHẨM</h1>
            <button type="button" class="btn btn-secondary" onclick="location.href='Quanlysanpham.php';">Trở về</button>
        <br>
        <br>
            <div class="mb-3">
                <label for="productName" class="form-label">Tên sản phẩm <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>

            <div class="mb-3">
                <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
            </div>
            
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
            </div>

            <div class="mb-3">
                <label for="productSize" class="form-label">Size</label>
                <input type="text" class="form-control" id="productSize" name="productSize" required>
            </div>

            <div class="mb-3">
                <label for="productMaterial" class="form-label">Chất liệu</label>
                <input type="text" class="form-control" id="productMaterial" name="productMaterial" required>
            </div>

            <div class="mb-3">
                <label for="productDate" class="form-label">Ngày nhập</label>
                <input type="date" class="form-control" id="productDate" name="productDate" required>
            </div>

            <div class="mb-3">
                <label for="productDesigner" class="form-label">Designer</label>
                <select class="form-select" id="productDesigner" name="productDesigner" required>
                    <option value="" disabled selected>Chọn designer</option>
                    <?php
                    foreach ($designer as $did => $designerName) {
                        echo "<option value='$did'>$designerName</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </main>
</body>

</html>
