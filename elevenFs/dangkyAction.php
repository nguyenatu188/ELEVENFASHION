<?php
include 'connect.php';

function laTenHopLe($ten) {
  return preg_match('/^[a-zA-Z ]+$/', $ten);
}

function laEmailHopLe($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL) && substr($email, -10) === "@gmail.com";
}

function laSoDienThoaiHopLe($soDienThoai) {
  return preg_match('/^\d{10}$/', $soDienThoai);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $ho = $_POST["first_name"];
  $ten = $_POST["last_name"];
  $soDienThoai = $_POST["phone_number"];
  $diaChi = $_POST["address"];

  $loiKiemTra = [];

  // Kiểm tra tên
  if (!laTenHopLe($ho) || !laTenHopLe($ten)) {
    $loiKiemTra[] = "Định dạng tên không hợp lệ. Vui lòng chỉ sử dụng chữ và khoảng trắng.";
  }

  // Kiểm tra email
  if (!laEmailHopLe($email)) {
    $loiKiemTra[] = "Định dạng email không hợp lệ. Vui lòng sử dụng địa chỉ Gmail hợp lệ.";
  }

  // Kiểm tra số điện thoại
  if (!laSoDienThoaiHopLe($soDienThoai)) {
    $loiKiemTra[] = "Số điện thoại không hợp lệ. Vui lòng sử dụng số điện thoại có 10 chữ số.";
  }

  if (count($loiKiemTra) > 0) {
    echo "<script>";
    echo "const containerLoi = document.getElementById('thong-bao-loi');"; 
    echo "containerLoi.innerHTML = '';";
    foreach ($loiKiemTra as $loi) {
      echo "const thongBaoLoi = document.createElement('p');";
      echo "thongBaoLoi.textContent = '" . $loi . "';";
      echo "thongBaoLoi.classList.add('thong-bao-loi');";
      echo "containerLoi.appendChild(thongBaoLoi);";
    }
    echo "</script>";
  } else {
    // Dữ liệu hợp lệ, thêm vào bảng users
    $sql = "INSERT INTO users (email, password, firstName, lastName, phoneNo, address) VALUES ('$email', '$password', '$ho', '$ten', '$soDienThoai', '$diaChi')";

    if ($conn->query($sql) === TRUE) {
      // Đăng ký thành công, hiển thị thông báo cảnh báo bằng JavaScript
      echo '<script type="text/javascript">
                alert("Đăng ký thành công!");
                window.location.href = "dangnhap.php";
              </script>';
      exit();
    } else {
      // Xử lý lỗi khi thêm dữ liệu
      echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>
