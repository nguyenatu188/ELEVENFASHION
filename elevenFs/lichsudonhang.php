<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lich su don hang</title>
</head>
<body>
    <?php
        session_start();
        include 'header.php';
    ?>
    <div class="container">
        <h1 class="text-center mb-4">Lich su don hang</h1>
    </div>
    <div class="container mb-5">
        <div class="container title_cart row border-bottom border-black">
            <div class="row">
                <div class="col-md-12">
                <?php
                    include 'connect.php';


                    $uid = $_SESSION['uid'];

                    $sql = "SELECT oid, oDate, payMethod, total FROM orders WHERE uid = $uid";
                    $result = $conn->query($sql);

                    echo '<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngay</th>
                                    <th>Thanh toan</th>
                                    <th>Tong</th>
                                </tr>
                            </thead>
                            <tbody>';

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr onclick="window.location=\'chitietdonhang_lichsudonhang.php?oid=' . $row['oid'] . '\';">
                                    <td>' . $row['oid'] . '</td>
                                    <td>' . $row['oDate'] . '</td>
                                    <td>' . $row['payMethod'] . '</td>
                                    <td>' . $row['total'] . '</td>
                                </tr>';

                        }
                    } else {
                        echo '<tr><td colspan="4">Không có đơn đặt hàng</td></tr>';
                    }

                    echo '</tbody></table>';

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