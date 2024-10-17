<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['fullname']);
unset($_SESSION['id']);// Xóa session
session_destroy();
header('Location: login.php');
?>