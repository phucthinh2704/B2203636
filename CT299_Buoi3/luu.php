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
$date = date_create($_POST["birth"]);
$sql = "INSERT INTO student (fullname, email, birthday) VALUES('" . $_POST["name"] . "', '" . $_POST["email"] . "', '" . $date->format('Y-m-d') . "')";

if ($conn->query($sql) == TRUE) {
    echo "Them sinh vien thanh cong";

    header('Location: taidulieu_bang1.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
