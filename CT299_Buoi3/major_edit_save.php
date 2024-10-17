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
$id = $_POST['id'];
$sql = "UPDATE major set name_major = '".$_POST['major_name']."'";
$sql = $sql. " WHERE ID='".$id."'";

if ($conn->query($sql) == TRUE) {
header('Location: major_index.php');
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>