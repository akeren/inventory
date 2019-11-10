<?php 
ob_start();
include('connection.php');

session_start();

if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	$log = mysql_fetch_array(mysql_query("select * from login where username='$user'"));
	if($log){
	if($pass == $log['password']){
				if($log['status']==1){
			$_SESSION['staff'] = $log['username'];
			$_SESSION['role'] = $log['role'];
			$_SESSION["logged"] = 1;
			$_SESSION["loggin"] = true;
			
				if($log['initial']==1){
					header('location:changepassword.php');
				}
				else{
			header('location:index.php');
				}
				}
				else 	 $message =  '<font color="#F00">Your Login is Not Active <b>!</b></font>';		
	} 				else 	 $message =  '<font color="#F00">Wrong Password <b>!</b></font>';		

	} 
	else{
	 $message =  '<font color="#F00">Invalid Login Credentials <b>!</b></font>';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
a{
	text-decoration:none;
}
a:hover{
	text-decoration:underline;
	color:#F00;
}
</style>
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
</head>
<body style="margin-top:0px;">
<form method="post">
<table height="600" width="75%" align="center" border="0" bordercolor="#2C5656">
<tr>
<td colspan="2" valign="middle" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:28px; color:#FFF;" bgcolor="#2F5E5E"><?=$shop?><br /><?=$address?></td>
</tr>
<tr>
<td width="50%" height="70%" style="border-right:0px;"><?php include('slider.html'); ?></td>
<td style="border-left:0px;" align="center">
<table width="100%">
<tr><td></td><td valign="top" style="padding-bottom:50px; color:#2F5E5E"><strong>STAFF LOGIN !!!</strong></td></tr>
<tr><td></td><td><strong><?=$message?></strong></td></tr>
<tr>
<td><strong>Username</strong></td>
<td><input type="text" name="username" style="height:30px; width:50%; border-radius:0px 10px 0px 10px;" placeholder="Username" required oninvalid="setCustomValidity('Pls Enter Username! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td><strong>Password</strong></td>
<td><input type="password" name="password" style="height:30px; width:50%; border-radius:0px 10px 0px 10px;"  placeholder="Password" required oninvalid="setCustomValidity('Pls Enter Password! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="LOG IN" name="login" style="background-color:#2B5555; color:#FFF;  width:20%; height:30px; border-radius:0px 10px 0px 10px;"  /></td>
</tr><tr>
<td></td>
<td style="padding-top:10px;"><a href="forget.php">Forget Password ?</a></td>
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