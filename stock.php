<?php 
session_start();
include('connection.php');
include('auth.php');

if(isset($_GET['id'])){
	mysql_query("update items set status = case when status < 1 then 1 when status > 0 then 0 end where itemid = '{$_GET['id']}'");
}

if(isset($_POST['update'])){
	mysql_query("update items set price ='{$_POST['desc']}' where itemid = '{$_POST['id']}'");
}

$select = mysql_query("select * from items where status = '1' order by description asc");

$edit = $_GET['edit'];
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
<form method="post">
<table width="100%" style="border-collapse:collapse;" border="1">
<?php 
if(mysql_num_rows($select) > 0 ){
?>
<tr style="color:#FFF; background-color:#3F7C7C">
<td>ITEM</td>
<td>PRICE &#8358;</td>
<td>QUANTITY LEFT</td>
<td>UPDATTE</td>
</tr>
<?php 
$no = 1;
while($items = mysql_fetch_array($select)){
?>
<tr>
<td><?php echo $items['description']; ?></td>
<td><?php echo $items['price']; ?></td>
<td><?php echo $items['quantity']; ?></td>
<td><a href="updateStock.php?id=<?php echo $items['itemid']; ?>" >Update</a></td>
</tr>
<?php $no++; }}
else{ ?>
<tr>
<td colspan="4" align="center"><strong>No Item Found in Stock!</strong></td>
</tr>
<?php } ?>
</table>
</form>
</body>
</html>