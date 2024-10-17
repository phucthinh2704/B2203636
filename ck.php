<!DOCTYPE html>
<?php
$cookie_name = "user";
$cookie_value = "Nguyen Thanh Hai";
setcookie($cookie_name, $cookie_value, time() + (86400 / 24), "/"); // 86400 = 24*3600 = 1 day
?>
<html>

<body>
    <?php
    if (!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' chua duoc thiet lap, ban vui long bam f5 de thiet lap cookie!";
    } else {
        echo "Cookie '" . $cookie_name . "' da duoc thiet lap!<br>";
        echo "Gia tri la: " . $_COOKIE[$cookie_name];
    }
    ?>
    <p><strong>Note:</strong> You might have to reload the page to see the value of the
        cookie.</p>
</body>

</html>