<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Nhân viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>THÔNG TIN NHÂN VIÊN</h1>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
        </tr>
        <?php
        // Kết nối đến MySQL
        $conn = mysqli_connect("127.0.0.1", "root", "", "ql_nhansu");

        // Kiểm tra kết nối
        if (!$conn) {
            die("Kết nối đến MySQL thất bại: " . mysqli_connect_error());
        }

        // Phân trang
        $limit = 5; // Số bản ghi hiển thị trên mỗi trang
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        // Truy vấn SQL để lấy dữ liệu với phân trang
        $sql = "SELECT * FROM nhanvien LIMIT $start, $limit";
        $result = mysqli_query($conn, $sql);

        // Hiển thị dữ liệu
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Ma NV"] . "</td>";
                echo "<td>" . $row["Ten_NV"] . "</td>";
                echo "<td>";
                if ($row["Phai"] == "NU") {
                    echo '<img src="nu.png" alt="Woman">';
                } else {
                    echo '<img src="nam.png" alt="Man" class="avatar">';
                }
                echo "</td>";
                echo "<td>" . $row["Noi_Sinh"] . "</td>";
                echo "<td>" . $row["Ma_Phong"] . "</td>";
                echo "<td>" . $row["Luong"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Không có dữ liệu nhân viên";
        }

        // Đếm tổng số bản ghi
        $sql_total = "SELECT * FROM nhanvien";
        $records = mysqli_query($conn, $sql_total);
        $total_records = mysqli_num_rows($records);
        $total_pages = ceil($total_records / $limit);

        // Hiển thị phân trang
        echo "<tr><td colspan='6'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=".$i."'>".$i."</a> ";
        }
        echo "</td></tr>";

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>