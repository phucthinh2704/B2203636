<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý thêm mới hoặc cập nhật chuyên ngành
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_major'])) {
    $major_id = $_POST['major_id'];
    $major_name = $_POST['major_name'];
    
    // Kiểm tra xem mã chuyên ngành đã tồn tại chưa
    $check_sql = "SELECT id FROM major WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $major_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        // Nếu mã đã tồn tại, cập nhật tên chuyên ngành
        $update_sql = "UPDATE major SET name_major = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $major_name, $major_id);
        
        if ($update_stmt->execute()) {
            echo "<p style='color: green;'>Cập nhật chuyên ngành thành công</p>";
        } else {
            echo "<p style='color: red;'>Lỗi cập nhật: " . $update_stmt->error . "</p>";
        }
        $update_stmt->close();
    } else {
        // Nếu mã chưa tồn tại, thêm mới chuyên ngành
        $insert_sql = "INSERT INTO major (id, name) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ss", $major_id, $major_name);
        
        if ($insert_stmt->execute()) {
            echo "<p style='color: green;'>Thêm chuyên ngành mới thành công</p>";
        } else {
            echo "<p style='color: red;'>Lỗi thêm mới: " . $insert_stmt->error . "</p>";
        }
        $insert_stmt->close();
    }
    
    $check_stmt->close();
}

// Câu lệnh SQL để lấy thông tin sinh viên và chuyên ngành
$sql = "SELECT s.id, s.fullname, s.email, s.birthday, 
               m.id AS major_id, m.name_major AS name_major
        FROM student s
        LEFT JOIN major m ON s.major_id = m.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sinh viên và chuyên ngành</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Thêm hoặc cập nhật chuyên ngành</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="major_id">Mã chuyên ngành:</label>
        <input type="text" id="major_id" name="major_id" required><br><br>
        <label for="major_name">Tên chuyên ngành:</label>
        <input type="text" id="major_name" name="major_name" required><br><br>
        <input type="submit" name="add_major" value="Thêm/Cập nhật chuyên ngành">
    </form>

    <h2>Danh sách sinh viên</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Mã chuyên ngành</th>
            <th>Tên chuyên ngành</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['birthday'] . "</td>";
                echo "<td>" . ($row['major_id'] ?? 'Chưa có') . "</td>";
                echo "<td>" . ($row['major_name'] ?? 'Chưa có') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
$conn->close();
?>