<?php 
session_start();
include('connection.php');
include('auth.php');
date_default_timezone_set('Africa/Lagos');

$soldby = $_SESSION['staff'];
$datesold = date('Y-n-d');

if(isset($_POST['sale'])){
	

		$n = 0;
		foreach($_POST['itemid'] as $item){
		$amount = $_POST['amount'][$n];
		$quantity = $_POST['quantity'][$n];
		$itemid = $_POST['itemid'][$n];
		$salesid = $user.$itemid.date('Ymdhis');
		$yes = 0;

			$sale = mysql_query("insert into sales(salesid, soldby, datesold, qty, amount, itemid, status) values('$salesid', '$soldby', '$datesold', '$quantity', '$amount', '$itemid', '1')");

		$update = mysql_query("update items set quantity = (quantity - $quantity) where itemid = '$itemid'");
		if($sale){
			$yes++;
		}
		$n++;
		}

		if($yes >0){
			echo '<script>alert("Sales Made Successfully");</script>';
		}
		else	echo '<script>alert("Sales Failed!");</script>';

}

$select = mysql_query("select * from items order by description asc");
$dayended = mysql_num_rows(mysql_query("select * from days where daydate = '$datesold'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MAKE SALES</title>
<style>
tr:nth-child(odd){ background-color:#EEE} 
tr:nth-child(even){ background-color:#CCC}
a{
	text-decoration:none;
}
</style>
<script>
function show(id, chk){
	
	if(chk.checked){
		document.getElementById(id).style.display = 'block';
		document.getElementById(id).setAttribute("required","required");
	}
	else{
		document.getElementById(id).value = '';
		document.getElementById(id).style.display = 'none';
	}
	
}

function totals(id1, id2, id3, id4){
	quantity = document.getElementById(id1).value;
	qleft = document.getElementById(id3).value;
	price = document.getElementById(id2).value;
	previous = document.getElementById("total").value;
	if(previous == ""){ previous = 0 };
	if(quantity == ""){ quantity = 0; }
	if(qleft >= quantity){
	total = (parseInt(quantity) * parseInt(price)) + parseInt(previous);
	
	
	document.getElementById("total").value = total;
	document.getElementById("sales").innerHTML = total ;
	}else if(qleft <= quantity){
	total = (parseInt(quantity) * parseInt(price)) + parseInt(previous);
	
	
	document.getElementById("total").value = total;
	document.getElementById("sales").innerHTML = total ;
	}
		else{
	alert("Entered Quantity is Too Much!");
	document.getElementById(id1).style.display = "none";
	document.getElementById(id4).checked = false;
	}
}


</script>
</head>
<body style="margin-top:0px;">
<form method="post">
<div style="position:fixed; float:left; margin-top:0px; background-color:#FFF; height:50px; width:100%;">
<table width="100%">
<tr style="background-color:#FFF;">
<td width="23%" style="color:#F00">SALES : &#8358;<span id="sales">0</span></td>
<td width="55%" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:28px;"><center><?=$shop?><br /><?=$address?></center></td>
<td width="22%" ><a href="index.php"><img src="images/home.png" height="42" width="42" title="HOME" /></a> &nbsp;&nbsp;&nbsp;<a href="logout.php"><img src="images/logout.jpg" height="42" width="42" title="LOGOUT" /></a></td>
</tr>
</table>
</div>
<br />
<br />
<br />
<br />
<?php if($dayended < 1){ ?>

<table width="100%" style="border-collapse:collapse;" border="1">
<?php 
if(mysql_num_rows($select) > 0 ){
?>
<tr style="color:#FFF; background-color:#3F7C7C">
<td>ITEM</td>
<td>QUANTITY LEFT</td>
<td>PRICE</td>
<td>QUANTITY</td>
<td>PICK ITEM(S)</td>
</tr>
<?php 
$no = 1;
while($items = mysql_fetch_array($select)){
?>
<tr>
<td><?php echo $items['description']; ?></td>
<td><?php echo $items['quantity']; ?><input type="hidden" value="<?php echo $items['quantity']; ?>" id="<?php echo $no."q"?>"  /></td>
<td><?php echo $items['price']; ?>
<input type="hidden" value="<?php echo $items['price']; ?>" id="<?php echo $no.'p'; ?>" name="amount[]"  />
<input type="hidden" value="<?php echo $items['itemid']; ?>"  name="itemid[]"  />
</td>
<td><input  id="<?php echo $no; ?>" type="text" placeholder="Quantity" onkeyup="totals('<?php echo $no;?>', '<?php echo $no."p";?>', '<?php echo $no."q";?>', '<?php echo $no."c";?>')" name="quantity[]" style="display:none;" /></td>
<td><input type="checkbox" name="item[]" onclick="show('<?php echo $no;?>', this)" id="<?php echo $no."c" ?>"  /></td>
<?php $no++;
} ?>
</tr>
<tr>
<td colspan="5" align="center"><input type="submit" name="sale" value="MAKE SALES" />
<input type="hidden" id="total"  /></td>
</tr>
<?php  } 
else{ ?>
<tr>
<td colspan="5" align="center"><strong>No Item Found!</strong></td>
</tr>
<?php } ?></table>
<?php }else{ ?>
<p align="center"><strong>Sales Have Ended For Today</strong></p>
<?php } ?>
</form>
</body>
</html>