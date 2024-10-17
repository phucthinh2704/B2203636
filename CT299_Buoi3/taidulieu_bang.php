<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//tao chuoi luu cau lenh sql
$sql = "SELECT * FROM student";
//thuc thi cau lenh sql va dua doi tuong vao $result
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    print_r($result);
    echo '<br>';
    echo '<br>';
    //Cach 2: show theo tung dong voi for
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Hoten: " . $row["fullname"] . " " .
            $row["email"] . ' ngaysinh: ' . $row['Birthday'] . "<br>";
    }
    echo '<br>';
    echo '<br>';
    //xoa ket qua cu tu o tren
    $result->free_result();

    //Cach 3: trinh bay voi bang html
    //load du lieu moi len dua vao bien result
    $result = $conn->query($sql);
    $result_all = $result->fetch_all();
    print_r($result_all);
    // trinh bay du lieu trong 1 bang html
    //tieu de bang
    echo "<table
border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th><
/tr>";
    // output data of each row
    foreach ($result_all as $row) {
        //dinh dang de hien thi ngay thang theo dd-mm-yyyy

        $date = date_create($row[3]);

        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] .
            "</td><td>" . $row[2] . "</td><td>" .
            $date->format('d-m-Y')
            . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 ket qua tra ve";
}
$conn->close();
