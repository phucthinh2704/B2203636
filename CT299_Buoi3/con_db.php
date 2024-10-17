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
// sql to create table
$sql = "CREATE TABLE student (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(50) NOT NULL,
email VARCHAR(50),
Birthday date,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE
CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
echo "Table student created successfully";
} else {
echo "Error creating table: " . $conn->error;
}
$conn->close();
?>