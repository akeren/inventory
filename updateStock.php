<?php 
session_start();
include('connection.php');
include('auth.php');

$id = $_GET['id'];

if(isset($_POST['update'])){
	$total = mysql_num_rows(mysql_query("select * from purchase where item = '$id'")) + 1;
	$purchaseid = $id.$total;
	$quantity = $_POST['quantity'];
	$date = date('Y-n-d');
	$update = mysql_query("update items set quantity = quantity + '$quantity' where itemid = '$id'");
	$insert = mysql_query("insert into purchase(purchaseid, item, quantity, date, status) values('$purchaseid', '$id', '$quantity', '$date', '1')");
	
	if($update==1 && $insert==1){
		$msg = '<font color="#00F">Stock Updated Successfully!</font>';
	}
	else{
			$msg = '<font color="#F00">Stock Failed to  Update!</font>';
}
	
}

$items = mysql_fetch_array(mysql_query("select * from items where itemid = '$id'"));

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
<tr>
<td colspan="2" align="center"><?php echo $msg!=""?$msg:"" ?></td>
</tr>
<tr>
<td>ITEM</td>
<td><?php echo $items['description']; ?></td>
</tr>
<tr>
<td>PRICE</td>
<td><?php echo $items['price']; ?></td>
</tr>
<tr>
<td>QUANTITY LEFT</td>
<td><?php echo $items['quantity']; ?></td>
</tr>
<tr>
<td>QUANTITY PURCHASED</td>
<td><input type="text" name="quantity" placeholder="Quantity Purchased" required  /></td>
</tr>
<tr>
<td></td>
<td><input name="update" type="submit" value="UPDATE STOCK" style="background-color:#2B5555; color:#FFF;" /></td>
</tr></table>
</form>
</body>
</html>