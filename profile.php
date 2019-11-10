<?php 
session_start();
include('connection.php');
include('auth.php');

$id = $_SESSION['staff'];

$details = mysql_fetch_array(mysql_query("select *, concat_ws(' ',sname,mname,fname) as name from staff where staffid = '$id'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
tr:nth-child(odd){ background-color:#EEE} 
tr:nth-child(even){ background-color:#CCC}
</style>
</head>
<body>
<form method="post">
<table width="100%">
<tr>
<td colspan="2" style="background-color:#FFF"><img src="photos/<?php echo $id.'.jpg' ?>" height="120" width="120"  /></td
</tr>
<tr>
<td><strong>Name</strong></td>
<td><?php echo $details['name']; ?></td>
</tr>
<tr>
<td><strong>Sex</strong></td>
<td><?php echo $details['sex']=="F"?"Female":"Male"; ?></td>
</tr>
<tr>
<td><strong>Phone</strong></td>
<td><?php echo $details['phone']; ?></td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td><?php echo $details['email']; ?></td>
</tr>
<tr>
<td><strong>Address</strong></td>
<td><?php echo $details['address']; ?></td>
</tr>
<tr>
<td><strong>Next of Kin</strong></td>
<td><?php echo $details['nkin']; ?></td>
</tr>
<tr>
<td><strong>Next of Kin Address</strong></td>
<td><?php echo $details['nkaddress']; ?></td>
</tr>
<tr>
<td><strong>Referee</strong></td>
<td><?php echo $details['referee']; ?></td>
</tr>
<tr>
<td><strong>Status</strong></td>
<td><?php echo $details['status']==1?"Active":"Inactive"; ?></td>
</tr>
</table>
</form>
</body>
</html>