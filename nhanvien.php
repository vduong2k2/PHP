<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    h2 {
        text-align: center;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-primary {
        background-color: #1e90ff;
        padding: 1%;
        color: white;
        text-decoration: none;
        font-weight: bold;
        width: 10%;
        align-self: flex-end;
    }

    .btn-primary:hover {
        background-color: #3742fa;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    a {
        text-decoration: none;
    }

    button {
        padding: 5px 10px;
    }
    </style>
</head>

<body>
    <h2>Danh sách nhân viên</h2>
    <div class="wrapper">
        <a href="add_nhanvien.php" class="btn-primary">Thêm nhân viên</a>
        <table>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Phòng Ban</th>
                <th>Giới Tính</th>
                <th>Nơi Sinh</th>
                <th>Lương</th>
                <th>Action</th>

            </tr>
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
    
            // Số nhân viên trên mỗi trang
            $so_nhan_vien_tren_trang = 5;
    
            // Xác định trang hiện tại
            if (isset($_GET['trang'])) {
                $trang = $_GET['trang'];
            } else {
                $trang = 1;
            }
    
            // Tính vị trí bắt đầu của các nhân viên trong truy vấn
            $start = ($trang - 1) * $so_nhan_vien_tren_trang;
    
            // Truy vấn dữ liệu từ bảng NHANVIEN và PHONGBAN
            $sql = "SELECT NHANVIEN.Ma_NV, NHANVIEN.Ten_NV, PHONGBAN.Ten_Phong, NHANVIEN.Phai, NHANVIEN.Noi_Sinh, NHANVIEN.Luong 
                    FROM NHANVIEN 
                    INNER JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong 
                    LIMIT $start, $so_nhan_vien_tren_trang";
            $result = $conn->query($sql);
            //
            // Hiển thị dữ liệu
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Ma_NV"] . "</td>";
                    echo "<td>" . $row["Ten_NV"] . "</td>";
                    echo "<td>" . $row["Ten_Phong"] . "</td>";
                    echo "<td>";
                    if ($row["Phai"] == "NAM") {
                        echo "<img src='assets\public\man.jpg' alt='Man' width='50px'>";
                    } else {
                        echo "<img src='assets\public\woman.jpg' alt='Woman' width='50px'>";
                    }
                    echo "</td>";
                    echo "<td>" . $row["Noi_Sinh"] . "</td>";
                    echo "<td>" . $row["Luong"] . "</td>";
                    echo "<td class='action'>
                        <button><a href='#'>Edit</a></button>
                        <button><a href='delete_nhanvien.php'>Delete</a></button>

            </td>";

            echo "</tr>";
            }
            } else {
            echo "<tr>
                <td colspan='6'>Không có nhân viên nào</td>
            </tr>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </table>
    </div>

    <!-- Phân trang -->
    <div>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Truy vấn tổng số nhân viên
        $sql = "SELECT COUNT(*) AS total FROM NHANVIEN";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_records = $row['total'];

        // Tính số trang
        $total_pages = ceil($total_records / $so_nhan_vien_tren_trang);

        // Hiển thị liên kết phân trang
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?trang=" . $i . "'>" . $i . "</a> ";
        }
        ?>
    </div>
</body>

</html>