<?php
session_start(); // Bắt đầu hoặc tiếp tục phiên làm việc
session_unset();
session_destroy();
header("Location: dangnhap.php");
exit();
?>
