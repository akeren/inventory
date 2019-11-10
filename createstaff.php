<?php
session_start();
include('connection.php');
include('auth.php');

if(isset($_POST['create'])){
	$sname = $_POST['sname']; 
	$fname = $_POST['fname'];
	$mname = $_POST['mname']; 
	$sex = $_POST['sex']; 
	$dob = $_POST['dob']; 
	$phone = $_POST['phone'];
	$email = $_POST['email']; 
	$dod = date('Y-n-d'); 
	$address = $_POST['address']; 
	$referee = $_POST['referee']; 
	$nkin = $_POST['nkin']; 
	$qualification = $_POST['qual'];
	
	$image = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$type = $_FILES['file']['type'];
	$tmp = $_FILES['file']['tmp_name'];
	//File size and extension
	$max = 1048576;
	$extension = strtolower(substr($image, strpos ($image, '.') +1));
//Upload codes
if (isset($image)) {
if (empty($image)) {
echo '<script>alert("Please choose an image to upload");</script>';
} elseif ($size > $max) {
echo '<script>alert("Your image must not exceed 1MB");</script>';
} elseif ($extension != 'jpg' && $extension != 'jpeg' && $extension !='gif' && $extension !='png') {
echo '<script>alert("Only images in JPG, JPEG, GIF and PNG are acceptable!");</script>';
} else {
	
	$check = mysql_num_rows(mysql_query("select * from staff where staffid = '$email'"));
	
	if($check < 1){
	
	$image = $email.".jpg";
$location = 'photos/';
move_uploaded_file($tmp, $location.$image);
	
	$create = mysql_query("insert into staff(staffid, sname, fname, mname, sex, dob, phone, email, dod, address, referee, nkin, qualification, status) values('$email', '$sname', '$fname', '$mname', '$sex', '$dob', '$phone', '$email', '$dod', '$address', '$referee', '$nkin', '$qualification', '1')");
	
	if($create){
		$createLogin = mysql_query("insert into login(username, password, role, status) values('$email','$email','staff','1')");
		 $msg = '<font color="#00F" size="+2">Staff Created Successfully!</font>';
	}
	else {
		$msg = '<font color="#F00" size="+2">Staff Creation Failed!</font>';
	}
}
else{ 		$msg = '<font color="#F00" size="+2">Staff Email Already Exist!</font>';
}
}}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<body>
<form method="post" enctype="multipart/form-data">
<table width="100%">
<tr><td></td><td><?php echo $msg!=""?$msg:"" ?></td><td rowspan="15" valign="top"><img id="list" height="120" width="120"  /></td></tr>
<tr>
<td width="35%"><strong>Surname</strong></td>
<td width="65%"><input type="text" name="sname" required placeholder="Surname" /></td>
</tr>
<tr>
<td><strong>First Name</strong></td>
<td><input type="text" name="fname" required  placeholder="First Name"  /></td>
</tr>
<tr>
<td><strong>Middle Name</strong></td>
<td><input type="text" name="mname"  placeholder="Middle Name"  /></td>
</tr>
<tr>
<td><strong>Sex</strong></td>
<td>
<select name="sex" required style="width:205px;" >
<option value="">--Sex--</option>
<option value="F">Female</option>
<option value="M">Male</option>
</select>
</td>
</tr>
<tr>
<td><strong>Passport</strong></td>
<td><input type="file" name="file" id="upfile" accept="image/jpeg, image/png, image/jpg, image/gif" required  placeholder="Date of Birth"  /></td>
</tr>
<tr>
<td><strong>DOB</strong></td>
<td><input type="text" name="dob" required  placeholder="Date of Birth"  /></td>
</tr>
<tr>
<td><strong>Phone</strong></td>
<td><input type="text" name="phone" required placeholder="Phone Number"  /></td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td><input type="email" name="email" required placeholder="Email"  /></td>
</tr>
<tr>
<td><strong>Next of Kin</strong></td>
<td><input type="text" name="nkin" required  placeholder="Next of Kin" /></td>
</tr>
<tr>
<td><strong>Qualification</strong></td>
<td><input type="text" name="qual" required placeholder="Qualification"  /></td>
</tr>
<tr>
<td><strong>Referee</strong></td>
<td><input type="text" name="referee" required placeholder="Referee"  /></td>
</tr>
<tr>
<td><strong>Next of Kin Address</strong></td>
<td><textarea name="nkaddress" cols="26" rows="4" style="resize:none" placeholder="Next of Kin Address"></textarea></td>
</tr><tr>
<td><strong>Address</strong></td>
<td><textarea name="address" cols="26" rows="4" style="resize:none" placeholder="Employee Address"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="create" value="CREATE STAFF" style="background-color:#2B5555; color:#FFF;" /></td>
</tr>
</table>
</form>
<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
     /* if (!f.type.match('image.*')) {
        continue;
      }
*/
      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '" width="120" height="120"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
		  		  		  document.getElementById("list").src=e.target.result;

        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('upfile').addEventListener('change', handleFileSelect, false);
 



  
</script>
</body>
</html>