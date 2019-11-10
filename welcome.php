<?php 
session_start();
include('connection.php');
include('auth.php');
$user = $_SESSION['staff'];
	$log = mysql_fetch_array(mysql_query("select concat_ws(' ',sname,mname,fname) as name from staff where staffid='$user'"));

if(isset($_GET['id'])){
$update = mysql_query("update balance set status ='0' where staffid = '$user'");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
a{ text-decoration:none;
	}
	a:hover{
text-decoration:underline; color:#F00;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
echo '<h3>'.$log['name'].',</h3>';
?>
You are welcome to <?=$shop;?> 
<?php 
	$balance = mysql_query("select * from balance where staffid='$user' and status ='1'");
while($mybalance = mysql_fetch_array($balance)){
?>
<center><p><strong>You had a deficit of &#8358;<?php echo $mybalance['balance'].' on '.$mybalance['date']; ?>, this is to inform you that the amount will be deducted from your monthly salary. </strong></p></center>
<center><p>Thank YOu.</p></center>
<?php } if(mysql_num_rows($balance) > 0){?>
<center><a href="?id='1'">OK</a></center>
<?php } ?>
</body>
</html>