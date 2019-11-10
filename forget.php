<?php
ob_start(); 
include('connection.php');

session_start();

if(isset($_POST['login'])){
	$user = $_POST['username'];
	$dob = $_POST['dob'];
	
	$log = mysql_fetch_array(mysql_query("select * from staff where staffid='$user' and dob = '$dob'"));
	if($log){
		$_SESSION['lost'] = $user;
	header('location:question.php');
	} 
	else{
	 $message =  '<font color="#F00">Wrong Staff Credentials <b>!</b></font>';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$shop?></title>
<script>
function disableRightClick(e)

{

  var message = "Right click disabled";

  

  if(!document.rightClickDisabled) // initialize

  {

    if(document.layers) 

    {

      document.captureEvents(Event.MOUSEDOWN);

      document.onmousedown = disableRightClick;

    }

    else document.oncontextmenu = disableRightClick;

    return document.rightClickDisabled = true;

  }

  if(document.layers || (document.getElementById && !document.all))

  {

    if (e.which==2||e.which==3)

    {

      alert(message);

      return false;

    }

  }

  else

  {

    alert(message);

    return false;

  }

}

disableRightClick();


</script>
<style>
td{
	padding:5px;
}
</style>
</head>
<body style="margin-top:0px;">
<form method="post">
<table height="400" width="75%" align="center" border="0" bordercolor="#2C5656">
<tr>
<td colspan="2" valign="middle" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:28px; color:#FFF;" bgcolor="#2F5E5E"><?=$shop?><br /><?=$address?></td>
</tr>
<tr>
<td style="border-left:0px;" align="center">
<table width="100%">
<tr><td></td><td valign="top" style="padding-bottom:50px; color:#2F5E5E"><strong>PASSWORD RECOVERY</strong></td></tr>
<tr><td></td><td><strong><?=$message?></strong></td></tr>
<tr>
<td><strong>Username</strong></td>
<td><input type="text" name="username" style="height:30px; width:50%; border-radius:0px 10px 0px 10px" placeholder="Username" required oninvalid="setCustomValidity('Pls Enter Username! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td><strong>Date of Birth</strong></td>
<td><input type="text" name="dob" style="height:30px; width:50%; border-radius:0px 10px 0px 10px;"  placeholder="Password" required oninvalid="setCustomValidity('Pls Enter DOB! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="SUBMIT" name="login" style="background-color:#2B5555; color:#FFF; height:30px; border-radius:0px 10px 0px 10px"  /></td>
</tr>
</table>
</td>
</tr>
<tr>
    <td align="center" colspan="2" style=" background-color:#cccccc;"><?=$company?></td>
</tr>
</table>

</form>
</body>
</html>