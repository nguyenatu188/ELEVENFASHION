<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
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
        td img {
            max-width: 100px; /* Set the maximum width for the images */
            height: auto; /* Maintain the aspect ratio */
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
        
        <form action="/create-account" method="post" class="col-md-6 mx-auto pb-4">
            <h1 class="text-center mb-4">QUẢN LÝ SẢN PHẨM</h1>
        </form>

        <div class="container py-4">
            <h2>Danh sách sản phẩm</h2>
            <div>
                <button type="button" class="btn btn-secondary"
                    onclick="location.href='them_sanpham.php';">Thêm mới</button>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <!-- <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">STT
                            </th> -->
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên sản
                                phẩm</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thương hiệu</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Size
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chất
                                liệu</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày
                                nhập</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thao
                                tác</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php
                            $query = "SELECT product.pid, product.pName, product.did, product.pImage, product.price, product.size, product.fabric, product.importDate, designer.dName
                                        FROM product
                                        JOIN designer ON product.did = designer.did";
                            $result = mysqli_query($conn, $query);

                            if ($result){
                                while ($row =  mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    // echo "<td>" . $row['pid'] . "</td>";
                                    echo "<td>" . $row['pName'] . "</td>";
                                    echo "<td>" . $row['dName'] . "</td>";
                                    echo "<td><img src='images/" . $row['pImage'] . "' alt='Product Image'></td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['size'] . "</td>";
                                    echo "<td>" . $row['fabric'] . "</td>";
                                    echo "<td>" . $row['importDate'] . "</td>";
                                    echo "<td><a href='quanly_sua_product.php?id=" . $row['pid'] . "' style='color: gray;'>&#9998;</a> | <a href='quanly_xoa_product.php?id=" . $row['pid'] . "' style='color: gray;'>&#128465;</a></td>";



                                }

                                mysqli_free_result($result);
                            }else{
                                echo "Error: " . mysqli_errno($conn);
                            }
                            mysqli_close($conn);
                       ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </main>
</body>

</html>
