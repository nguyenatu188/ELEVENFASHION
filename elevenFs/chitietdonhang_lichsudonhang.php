<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiet don hang_Lich su don hang</title>
</head>
<body>
    <?php 
        session_start();
        include 'header.php';
    ?>
    <div class="container">
        <h1 class="text-center mb-4">Chi tiet lich su don hang</h1>
    </div>
    <div class="container mb-5">
        <div class="container title_cart row ">
            <div class="row">
                <div class="col-md-12">
                <?php
                    include 'connect.php';
                    $uid = $_SESSION['uid'];
                    // Check if the order ID (oid) is provided in the URL
                    if (isset($_GET['oid'])) {
                        // Sanitize the input to prevent SQL injection
                        $oid = mysqli_real_escape_string($conn, $_GET['oid']);

                        // Query to retrieve order details
                        $sql = "SELECT od.oid, od.pid, od.soLuong, od.sub_total, o.oDate, p.pImage, p.pName, p.size
                                FROM order_detail od
                                JOIN orders o ON od.oid = o.oid
                                JOIN product p ON od.pid = p.pid
                                WHERE o.uid = '$uid' AND o.oid = '$oid'";

                        $result = $conn->query($sql);

                        echo '<table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Hình ảnh sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>kích cỡ</th>
                                        <th>Số lượng</th>
                                        <th>Ngày</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>' . $row['oid'] . '</td>
                                        <td><img src="images/' . $row['pImage'] . '" alt="Hình ảnh sản phẩm" width="50"></td> 
                                        <td>' . $row['pName'] . '</td>
                                        <td>' . $row['size']. '</td>
                                        <td>' . $row['soLuong'] . '</td>
                                        <td>' . $row['oDate'] . '</td>
                                        <td>' . $row['sub_total'] . ' vnd</td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">Không có sản phẩm trong đơn đặt hàng</td></tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo '<p>Không có thông tin đơn hàng được cung cấp.</p>';
                    }

                    $conn->close();
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include 'footer.php';
    ?>
</body>
</html>