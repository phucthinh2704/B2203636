<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select id, fullname, email from customers where email = '" . $_POST["email"] . "' and
password = '" . md5($_POST["pass"]) . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    // $cookie_name = "user";
    // $cookie_value = $row['email'];
    // setcookie($cookie_name, $cookie_value, time() + (86400 / 24), "/");
    // setcookie("fullname", $row['fullname'], time() + (86400 / 24), "/");
    // setcookie("id", $row['id'], time() + (86400 / 24), "/");
    $_SESSION['user'] = $row['email'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['id'] = $row['id'];
    header('Location: homepage.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    //Tro ve trang dang nhap sau 3 giay
    header('Refresh: 3;url=login.php');
}
$conn->close();
