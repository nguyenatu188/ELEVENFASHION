<?php 
$servername="localhost";
$username="root";
$password="";
$database="elevenfs";
$conn = new mysqli($servername,$username,$password,$database);
if ($conn->connect_error){
	die("Lỗi kết nối với CSDL");
}
?>