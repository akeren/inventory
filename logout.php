<?php
session_start();
session_destroy();
$_SESSION['logged'] = 0;
header("location:login.php");
?>