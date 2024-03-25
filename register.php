<?php
// Kiểm tra xem người dùng đã gửi dữ liệu từ form chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $email = $_POST['email'];
    $role = 'user'; // Giả sử mặc định là user

    // Hàm đăng ký người dùng
    function registerUser($conn, $username, $password, $email, $role) {
        // Kiểm tra xem người dùng đã tồn tại chưa
        $check_query = "SELECT * FROM user WHERE username='$username'";
        $check_result = $conn->query($check_query);
        
        if ($check_result->num_rows > 0) {
            return "Tên người dùng đã tồn tại";
        } else {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Thêm người dùng mới vào cơ sở dữ liệu
            $insert_query = "INSERT INTO user (username, password, email, role) VALUES ('$username', '$hashed_password', '$email', '$role')";
            
            if ($conn->query($insert_query) === TRUE) {
                // Chuyển hướng sang trang đăng nhập
                header("Location: login.php");
                exit(); // Dừng kịch bản hiện tại sau khi chuyển hướng
            } else {
                return "Đăng ký thất bại: " . $conn->error;
            }
        }
    }

    // Gọi hàm đăng ký
    $registration_result = registerUser($conn, $username, $password, $email, $role);
    echo $registration_result;

    // Đóng kết nối
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
    button a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <h2>Đăng ký</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Đăng ký">
        <button>
            <a href="login.php">Đăng Nhập</a>
        </button>
    </form>
</body>

</html>