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
$sql = "SELECT * FROM major";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // trinh bay voi bang html
    //load du lieu moi len dua vao bien result
    $result = $conn->query($sql);
    $result_all = $result->fetch_all(MYSQLI_ASSOC);
    //print_r($result_all);
    // trinh bay du lieu trong 1 bang html
    //tieu de bang
?>
    <h1>Bang du lieu MAJOR</h1>
    <table
        border=1>
        <tr>
            <th>ID</th>
            <th>MAJOR NAME</th>
            <th colspan="2">Hanh dong</th>
        </tr>
        <?php
        // output data of each row
        foreach ($result_all as $row) {

            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name_major"] . "</td><td>";

        ?>
            <form method="post" action="major_xoa.php">

                <input type="submit" name="action" value="xoa" />
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            </form>
            <?php
            echo "</td>";
            echo "<td>";

            ?>
            <form method="post" action="major_edit.php">

                <input type="submit" name="action" value="sua" />
                <input type="hidden" name="id" value="<?php echo

                                                        $row['id']; ?>" />
            </form>
    <?php
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 ket qua tra ve";
    }
    $conn->close();
    ?>