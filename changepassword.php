<?php 
session_start();
include('connection.php');
include('auth.php');
$user = $_SESSION['staff'];
if(isset($_POST['login'])){
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	$verifypass = $_POST['verifypass'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	
	$log = mysql_fetch_array(mysql_query("select * from staff where staffid='$user'"));
	if($oldpass == $log['password']){
		if($newpass == $verifypass){
		$updateStaff = mysql_query("update staff set question = '$question', answer = '$answer' where staffid = '$user'");
		$updateLogin = mysql_query("update login set password = '$newpass', initial = '0' where username = '$user'");
		$message = '<font color="#00F">Password Security System Updated Successfully<b>!</b> Please Wait...</font>';
		?><script>setInterval("redirects()",5000);</script><?php
		}
		else $message =  '<font color="#F00">Password Does Not Match<b>!</b></font>';
					} 
	else 	 $message =  '<font color="#F00">Wrong Password <b>!</b></font>';		

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$shop?></title>
<script>
function redirects(){
	window.location = "index.php";
}

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
	padding:3px;
}
input[type=text], input[type=email]{
	width:200px;
	height:20px;
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
<tr><td width="43%"></td>
<td width="57%" valign="top" style="padding-bottom:50px; color:#2F5E5E"><strong>PASSWORD SECURITY SYSTEM</strong></td></tr>
<tr><td></td><td><strong><?=$message?></strong></td></tr>
<tr>
<td><strong>Old Password</strong></td>
<td><input type="text" name="oldpass" style="height:20px;" placeholder="Old Password" required oninvalid="setCustomValidity('Pls Enter Your Old Password! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td><strong>New Password</strong></td>
<td><input type="text" name="newpass" style="height:20px;" placeholder="New Password" required oninvalid="setCustomValidity('Pls Enter Your New Password! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td><strong>Confirm Password</strong></td>
<td><input type="text" name="verifypass" style="height:20px;"  placeholder="Confirm Password" required oninvalid="setCustomValidity('Pls Enter Password Again! ')"
    onchange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td><strong>Security Question</strong></td>
<td><textarea rows="3" cols="26" style="resize:none;" name="question" placeholder="Security Question" required oninvalid="setCustomValidity('Pls Enter Security Question! ')" onChange="try{setCustomValidity('')}catch(e){}"></textarea></td>
</tr>
<tr>
<td><strong>Answer<br />
(<font size="-1">You will require this whenever you forget your password</font>)</strong></td>
<td><input type="text" name="answer" maxlength="15" style="height:20px;"  placeholder="Answer" required oninvalid="setCustomValidity('Pls Enter The Answer to Your Question! ')" onChange="try{setCustomValidity('')}catch(e){}"/></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="SUBMIT" name="login" style="background-color:#2B5555; color:#FFF;"  /></td>
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