<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Kiểm tra xem mã nhân viên đã được truyền từ trang danh sách nhân viên chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa nhân viên từ cơ sở dữ liệu
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV='$id'";
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng người dùng về trang danh sách nhân viên
        header("Location: danh_sach_nhanvien.php");
        exit(); // Dừng kịch bản hiện tại sau khi chuyển hướng
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>