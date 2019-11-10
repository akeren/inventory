<?php 
session_start();
include('connection.php');
include('auth.php');
$user = $_SESSION['staff'];
date_default_timezone_set('Africa/Lagos');
$date = date('Y-n-d');
	$log = mysql_fetch_array(mysql_query("select concat_ws(' ',sname,mname,fname) as name from staff where staffid='$user'"));

$select = mysql_query("select s.*, i.description from sales s join items i on i.itemid = s.itemid where soldby = '$user' and datesold = '$date' order by i.description asc");

if(isset($_POST['end'])){
$insert = mysql_query("insert into days(daydate, status) values('$date', '1')");
}

$dayended = mysql_num_rows(mysql_query("select * from days where daydate = '$date'"));


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
<table width="100%" style="border-collapse:collapse;" border="0">
<tr>
<td colspan="2" align="center" class="print" style="font-size:40px; text-transform:capitalize"><strong><?=$shop?></strong><br /><?=$address?></td>
</tr>
<tr>
<td class="print" colspan="2">&nbsp;</td>
</tr>
<tr>
<td class="print" colspan="2" align="center">SALES REPORT FOR <?php 
	$date = getdate(strtotime(date('Y-n-d h:i:s')));

echo strtoupper($date[month].' '. $date[mday].date('S',strtotime(date('Y-n-d h:i:s'))).' '.$date[year].' at '.date('g:i A',strtotime(date('Y-n-d h:i:s')))); ?></td>
</tr>
<tr>
<td class="print">NAME</td>
<td class="print"><?php echo $log['name']; ?></td>
</tr>
<tr>
<td class="print" colspan="2">&nbsp;</td>
</tr>
</table>

<table width="100%" style="border-collapse:collapse;" border="1">
<?php 
if(mysql_num_rows($select) > 0 ){
?>
<tr style="color:#FFF; background-color:#3F7C7C">
<td>ITEM</td>
<td>QUANTITY SOLD</td>
<td>PRICE</td>
<td>TOTAL</td>
</tr>
<?php 
$no = 1;
$total = 0;
while($items = mysql_fetch_array($select)){
?>
<tr>
<td><?php echo $items['description']; ?></td>
<td><?php echo $items['qty']; ?></td>
<td><?php echo $items['amount']; ?></td>
<td><?php echo $items['amount'] * $items['qty']; ?></td>
</tr>
<?php 
$total = $total + ($items['amount'] * $items['qty']);
$no++; } ?>
<tr>
<td><strong>TOTAL</strong></td>
<td colspan="3"><strong><?php echo $total; ?></strong></td>
</tr>

<tr>
<td align="center" colspan="4">
<?php if($dayended < 1){ ?>
<input name="end" type="submit" value="END DAY" />
<?php }else{ ?>
<p><strong>Sales Have Ended For Today</strong></p>
<?php } ?>
</td>
</tr>

<?php }
else{ ?>
<tr>
<td colspan="4" align="center"><strong>No Item Found!</strong></td>
</tr>
<?php } ?></table>
</form>
</body>
</html>