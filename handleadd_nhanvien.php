<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$maNV = $_POST['maNV'];
$tenNV = $_POST['tenNV'];
$phongBan = $_POST['phongBan'];
$gioiTinh = $_POST['gioiTinh'];
$noiSinh = $_POST['noiSinh'];
$luong = $_POST['luong'];

// Tạo truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
$sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$maNV', '$tenNV', '$gioiTinh', '$noiSinh','$phongBan', '$luong')";

if ($conn->query($sql) === TRUE) {
    echo "Thêm nhân viên thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>