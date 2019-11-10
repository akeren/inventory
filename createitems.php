<?php 
session_start();
include('connection.php');
include('auth.php');

if(isset($_POST['create'])){
	$total = mysql_num_rows(mysql_query("select * from items")) + 1;
	$desc = $_POST['desc'];
	$price = $_POST['price'];
	$quantity= $_POST['quantity'];
	$itemid = substr($desc, 0, 3).$total;
	
	$create = mysql_query("insert into items(`itemid`, `description`, `price`, `quantity`, `status`) values('$itemid', '$desc', '$price', '$quantity', '1')") or die(mysql_error());
	
	if($create) $msg = '<font color="#00F" size="+2">Item Created Successfully</font>';
	else  $msg = '<font color="#F00" size="+2">Item Creation Failed!</font>';
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form method="post">
<table width="100%">
<tr>
<td></td>
<td><?php echo $msg!=""?$msg:"" ?></td>
</tr>
<tr>
<td><strong>Item Description</strong></td>
<td><input type="text" name="desc" required style="width:200px;"  /></td>
</tr>

<tr>
<td><strong>Price</strong></td>
<td><input type="text" name="price" required style="width:200px;"  /></td>
</tr>

<tr>
<td><strong>Quantity</strong></td>
<td><input type="text" name="quantity" required style="width:200px;"  /></td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="create" value="CREATE ITEM" style="background-color:#478F8F; color:#FFF;"  /></td>
</tr>

</table>
</form>
</body>
</html>