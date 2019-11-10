<?php
session_start();
include('connection.php');
include('auth.php');

$role = $_SESSION['role'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$shop?></title>
<style>
tr,td{
	border:0px;
	border-collapse:collapse;
}
img{
	cursor:pointer;
}
 
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#274E4E" style="margin-top:0px;">

<table width="80%" bgcolor="#FFF" align="center" border="10" bordercolor="#142727" style="border-collapse:collapse;border-style:solid;">
<tr>
<td colspan="3" height="70" valign="middle" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:28px;"><?=$shop?><br /><?=$address?></td>
</tr>
<tr bgcolor="#142727">
<td colspan="3" style="background-color:#EEE;">
<ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="profile.php" target="kelvin">Staff Profile</a></li>
<?php if($role == "admin"){ ?>
<li><a class="MenuBarItemSubmenu" href="#">Items</a>
  <ul>
  <li><a href="createitems.php" target="kelvin">Create Items</a></li>
  <li><a href="viewitems.php" target="kelvin">View Items</a></li>
  </ul>
</li>
<?php } ?>
  <li><a href="#">Stock</a>
  <ul>
<?php if($role == "admin"){ ?>
  <li><a href="stock.php" target="kelvin">Update Stock</a></li>
<?php } ?>
  <li><a href="viewStock.php" target="kelvin">View Stock</a></li>
  </ul>
  </li>
  <li><a class="MenuBarItemSubmenu" href="makeSales.php">Make Sales</a></li>
  <li><a href="#">View Sales</a>
  <ul>
  <li><a href="salesToday.php" target="kelvin">My Sales Today</a></li>
 <?php if($role == "admin"){ ?>
 <li><a href="staffSales.php" target="kelvin">All Staff Sales</a></li>
  <?php } ?>
</ul>
  </li>
<?php if($role == "admin"){ ?>

  <li><a href="#" class="MenuBarItemSubmenu">Staff</a>
  <ul>
  <li><a href="createstaff.php" target="kelvin">Create Staff</a></li>
  <li><a href="viewstaff.php" target="kelvin">View Staff</a></li>
</ul></li>
  <li><a class="MenuBarItemSubmenu" target="kelvin" href="balanceDay.php">Balance Account</a></li>
<?php } else{?>
  <li><a class="MenuBarItemSubmenu" target="kelvin" href="endDay.php">End Day</a></li>
<?php } ?>
  <li><a href="logout.php">Logout</a></li>
</ul>
</td>
</tr>
<tr>
<td height="500" colspan="3">
<iframe src="welcome.php" name="kelvin" width="99%" frameborder="0" height="600" ></iframe></td>
</tr>

</table>
<hr align="center" width="70%" />
<table style="width:70%; border:0;" align="center">

 <tbody> <tr> 

    <td align="center" style="color:#FFF;"><?=$company?></td>
  </tr></tbody>

</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>