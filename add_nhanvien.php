<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin: 0 auto;
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <h2>Thêm Nhân Viên</h2>
    <form action="handleadd_nhanvien.php" method="post">
        <label for="maNV">Mã NV:</label>
        <input type="text" id="maNV" name="maNV">

        <label for="tenNV">Tên NV:</label>
        <input type="text" id="tenNV" name="tenNV">

        <label for="phongBan">Phòng Ban:</label>
        <input type="text" id="phongBan" name="phongBan">

        <label for="gioiTinh">Giới Tính:</label>
        <select id="gioiTinh" name="gioiTinh">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select>

        <label for="noiSinh">Nơi Sinh:</label>
        <input type="text" id="noiSinh" name="noiSinh">

        <label for="luong">Lương:</label>
        <input type="text" id="luong" name="luong">

        <input type="submit" value="Thêm Nhân Viên">
    </form>
</body>

</html>