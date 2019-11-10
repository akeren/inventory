<?php
session_start();
if ($_SESSION["logged"] == 1) {
//Do Nothing
} else {
//$redirect = $_SERVER["PHP_SELF"];
header("Refresh: 4; URL=login.php");
echo '<font size="+2" color="#FF0000">Your session has expired. You are being redirected to the login page!</font><br>';
echo '(<font size="+1">If your browser doesn\'t support this, <a href="login.php">click here</a></font>)';
die();
}
?>