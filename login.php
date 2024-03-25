<?php
// Khai báo biến để lưu thông báo lỗi
$login_error = '';

// Kiểm tra xem người dùng đã gửi dữ liệu từ form đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Xử lý đăng nhập
    // Kết nối đến cơ sở dữ liệu MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ql_nhansu";

    $conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hàm đăng nhập người dùng
    function loginUser($conn, $username, $password) {
        // Kiểm tra xem người dùng có tồn tại không
        $check_query = "SELECT * FROM user WHERE username='$username'";
        $check_result = $conn->query($check_query);
        
        if ($check_result->num_rows == 1) {
            $user = $check_result->fetch_assoc();
            // Kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                return "Đăng nhập thành công";
            } else {
                return "Sai mật khẩu";
            }
        } else {
            return "Người dùng không tồn tại";
        }
    }

    // Gọi hàm đăng nhập
    $login_result = loginUser($conn, $username, $password);
    if ($login_result === "Đăng nhập thành công") {
        // Chuyển hướng sau khi đăng nhập thành công
        header("Location: nhanvien.php");
        exit(); // Dừng kịch bản hiện tại sau khi chuyển hướng
    } else {
        $login_error = $login_result;
    }

    // Đóng kết nối
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập và Đăng ký</title>
    <style>
    button a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <h2>Đăng nhập</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>
        <span style="color: red;"><?php echo $login_error; ?></span><br>
        <input type="submit" name="login" value="Đăng nhập">
        <button>
            <a href="register.php">Đăng Ký</a>
        </button>
    </form>
</body>

</html>