<?php 
session_start();
include('connection.php');
include('auth.php');
date_default_timezone_set('Africa/Lagos');
$datesold = date('Y-n-d');

if(isset($_POST['submit'])){

	$n = 0;
	foreach($_POST['user'] as $staff){
	$amount = $_POST['amount'][$n];
	$sales = $_POST['sales'][$n];
	$balance = $sales - $amount;
	$balanceid = $staff.$datesold;

	$submit = mysql_query("insert into balance(balanceid, staffid, sales, amountsubmited, balance, date, status) values('$balanceid', '$staff', '$sales', '$amount', '$balance', '$datesold', '1')");
	$n++;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
tr:nth-child(odd){ background-color:#EEE} 
tr:nth-child(even){ background-color:#CCC}
a{
	text-decoration:none;
	display:block;
}
.print{
display:none;
}
@media print{
#noprint{
display:none;
}
.print{
display:table-cell;
}
}
</style>
</head>
<body>
<form method="post">
<table width="100%" style="border-collapse:collapse; " border="1">

<tr style="color:#FFF; background-color:#3F7C7C">
<td>NAME</td>
<td>EXPECTED AMOUNT</td>
<td>AMOUNT HANDED OVER</td>
</tr>
<?PHP
$users = mysql_query("select distinct soldby from sales where datesold = '$datesold'");

while($staff = mysql_fetch_array($users)){
$user = $staff['soldby'];
	$log = mysql_fetch_array(mysql_query("select concat_ws(' ',sname,mname,fname) as name from staff where staffid='$user'"));

	$sales = mysql_fetch_array(mysql_query("select sum(amount * qty) as sales from sales where soldby = '$user' and datesold='$datesold'"));
?>

<tr>
<td><?php echo $log['name']; ?><input type="hidden" name="user[]" value="<?php echo $user; ?>" /></td>
<td><?php echo $sales['sales']; ?><input type="hidden" name="sales[]" value="<?php echo $sales['sales']; ?>" /></td>
<td><input type="text" placeholder='Amount Submitted' name="amount[]" required /></td>
</tr>
<?php } ?>
<tr>
<td></td>
<td colspan="2" style="border:0px"><input name="submit" type="submit" value="SUBMIT" /></td>
</tr>

</table>
</form>
</body>
</html>