<?php 
session_start();
include('connection.php');
include('auth.php');
$select = mysql_query("select *, concat_ws(' ', sname, mname, fname) as name from staff order by sname asc");
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
</style>
</head>
<body>
<table width="100%" style="border-collapse:collapse;" border="1">
<tr style="color:#FFF; background-color:#3F7C7C">
<td>S/N</td>
<td>NAME</td>
<td>PHONE</td>
<td>EMAIL</td>
<td>ADDRESS</td>
<td>STATUS</td>
</tr>
<?php 
$no = 1;
while($staff = mysql_fetch_array($select)){
?>
<tr>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $no; ?></a></td>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $staff['name']; ?></a></td>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $staff['phone']; ?></a></td>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $staff['email']; ?></a></td>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $staff['address']; ?></a></td>
<td><a href="details.php?id=<?php echo $staff['staffid']; ?>" title="<?php echo $staff['name']; ?>"><?php echo $staff['status']==1?"Active":"Inactive"; ?></a></td>
</tr>
<?php $no++; } ?>
</table>
</body>
</html>