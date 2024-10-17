<!DOCTYPE HTML>
<html>
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
$sql = "select * FROM student WHERE ID='" . $id . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<body>
    <?php print_r($row) ?>
    <form action="sua.php" method="post">
        ID:<input type="text" name="id" value="<?php echo $row['id']; ?>"><br>
        Name: <input type="text" name="fullname" value="<?php echo
                                                        $row['fullname']; ?>"><br>
        E-mail: <input type="text" name="email" value="<?php echo
                                                        $row['email']; ?>"><br>
        Birthday: <input type="date" name="birth" value="<?php echo
                                                            $row['Birthday']; ?>"><br><input type="submit">
    </form>
</body>

</html>