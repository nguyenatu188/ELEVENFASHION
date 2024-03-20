<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the 'continue' button was pressed and the payment method is set
        if (isset($_POST['continue']) && isset($_POST['payMethod'])) {
            // Capture the selected payment method and store it in the session
            $_SESSION['selectedPayMethod'] = $_POST['payMethod'];

            // Redirect to thanhtoan_3.php
            header('Location: thanhtoan_3.php');
            exit();
        }
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
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="container icon_step_text col">
                    <i class="bi bi-2-circle-fill"></i>
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
            <form method="post" class="col-md-5 mx-auto border-bottom border-dark pb-4">
                <h1 class="text-left mb-4 mt-5 pb-4 border-bottom border-secondary-subtle">Choose Payment Method</h1>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payMethod" id="thanhtoankhinhanhang" value="Thanh toán khi nhận hàng" onclick="handleRadioClick_2()" checked>
                    <label class="form-check-label" for="thanhtoankhinhanhang">Thanh toán khi nhận hàng</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payMethod" id="MaQRRadio" onclick="handleRadioClick_1()" value="Mã QR">
                    <label class="form-check-label" for="MaQRRadio">Mã QR</label>
                </div>
                <div id="MaQRDiv" style="display: none;">
                    <img id="MaQRImage" src="images/qrcode.jpg" style="width:400px; height:400px" alt="QR Code" />
                </div>
                <div class="mb-3 mt-5">
                    <button type="submit" name="continue" class="btn btn-dark btn-block w-100">Continue</button>
                </div>
            </form>
            <?php include 'chitietdonhang_thanhtoan.php'; ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <<script>
        function handleRadioClick_1() {
            // Lấy div chứa hình ảnh
            var qrCodeDiv = document.getElementById("MaQRDiv");

            // Hiển thị hoặc ẩn div chứa hình ảnh tùy thuộc vào trạng thái của radio button
            if (document.getElementById("MaQRRadio").checked) {
            qrCodeDiv.style.display = "block";
            } else {
            qrCodeDiv.style.display = "none";
            }
        }
        function handleRadioClick_2() {
            // Lấy div chứa hình ảnh
            var qrCodeDiv = document.getElementById("MaQRDiv");

            // Hiển thị hoặc ẩn div chứa hình ảnh tùy thuộc vào trạng thái của radio button
            if (document.getElementById("thanhtoankhinhanhang").checked) {
                qrCodeDiv.style.display = "none";
            } else {
                qrCodeDiv.style.display = "none";
            }
        }
    </script>
</body>
</html>