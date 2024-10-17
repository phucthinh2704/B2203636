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
$sql = "INSERT INTO major(name_major) VALUES ('" . $_POST["major_name"] . "')";

if ($conn->query($sql) == TRUE) {
    echo "Them nganh hoc thanh cong";

    header('Location: major_index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
