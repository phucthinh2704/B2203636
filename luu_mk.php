<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";
$id = $_SESSION['id']; // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `customers` WHERE `password` = '" . md5($_POST["pass"]) . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    if ($_POST["newpass"] !== $_POST["newpass2"]) {
        echo "Error: Passwords not match!";        // Tro ve trang dang nhap sau 3 giay        
        header('Refresh: 3;url=sua_mk.php');
    } else {
        $sql = "UPDATE `customers` SET `password` = '" . md5($_POST["newpass"]) . "'WHERE id = " . $id;
        $conn->query($sql);
        echo "Success: changed password successfully!";        // Tro ve trang dang nhap sau 3 giay       
        header('Refresh: 3;url=homepage.php');
    }
} else {
    echo "Error: wrong password!";    // Tro ve trang dang nhap sau 3 giay   
    header('Refresh: 3;url=sua_mk.php');
}
$conn->close();
