<?php 
session_start();
include('connection.php');
include('auth.php');
date_default_timezone_set('Africa/Lagos');
$datesold = date('Y-n-d');;

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
<td class="print" colspan="2" align="center">ALL SALES REPORT FOR <?php 
	$date = getdate(strtotime(date('Y-n-d h:i:s')));

echo strtoupper($date[month].' '. $date[mday].date('S',strtotime(date('Y-n-d h:i:s'))).' '.$date[year].' at '.date('g:i A',strtotime(date('Y-n-d h:i:s')))); ?></td>
</tr>
</table>
<?PHP
$users = mysql_query("select distinct soldby from sales where datesold = '$datesold'");

while($staff = mysql_fetch_array($users)){
$user = $staff['soldby'];
	$log = mysql_fetch_array(mysql_query("select concat_ws(' ',sname,mname,fname) as name from staff where staffid='$user'"));

$select = mysql_query("select s.*, i.description from sales s join items i on i.itemid = s.itemid where soldby = '$user' and datesold = '$datesold' order by i.description asc");
?>
<table width="100%" style="border-collapse:collapse; border-left:0px; border-right:0px" border="0">
<tr>
<td >NAME</td>
<td><?php echo $log['name']; ?></td>
</tr>
</table>

<table width="100%" style="border-collapse:collapse; border-left:0px; border-right:0px" border="1">
<?php 
if(mysql_num_rows($select) > 0 ){
?>
<tr style="color:#FFF; background-color:#3F7C7C">
<td>ITEM</td>
<td>QUANTITY SOLD</td>
<td>PRICE (&#8358;)</td>
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
<td colspan="2"><strong>TOTAL</strong></td>
<td colspan="2">&#8358;<?php echo $total; ?></td>
</tr>
<tr>
<td colspan="4" style="border:0px">&nbsp;</td>
</tr>

<?php } }
if(mysql_num_rows($users) > 0){?>
<tr>
<td align="center" id="noprint" colspan="4" onclick="window.print()"><a href="#">[PRINT]</a></td>
</tr>
<?php } ?>
</table>
</form>
</body>
</html>