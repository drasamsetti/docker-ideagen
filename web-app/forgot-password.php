<?php
include "header-main.php";
?>
<script type="text/javascript">


function checkform(form)
{   
    if(form.cpass.value.length==0)
	{
	  	alert("Please enter Current Password");
	  	form.cpass.value="";
	  	form.cpass.focus();
	  	return false;
	}
	if(form.npass1.value.length==0)
	{
	  	alert("Please enter New Password");
	  	form.npass1.value="";
	  	form.npass1.focus();
	  	return false;
	}
	if(form.npass2.value.length==0)
	{
	  	alert("Please enter New Password Again");
	  	form.npass2.value="";
	  	form.npass2.focus();
	  	return false;
	}
	if(form.npass1.value!=form.npass2.value)
  	{
  		alert("New Passwords do not match");
  		form.npass1.value="";
  		form.npass2.value="";
  		form.npass1.focus();
  		return false;
  	}
 }
</script>
<?php
if(isset($_REQUEST['submit']))
{
	$email=$_REQUEST['email'];
	
	$equery="select * from emp_master where short_id='$email'";
	$eresult=mysql_query($equery);
	if(mysql_num_rows($eresult)==0)
	{
		echo "<div align='center'>No user with this userid! <a href='forgot-password.php'>Go back and try again</a>";
	}
	else
	{
		function generatePassword($length=8,$level=3)
		{
			list($usec, $sec) = explode(' ', microtime());
			srand((float) $sec + ((float) $usec * 100000));
			
			$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
			$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
			
			$password  = "";
			$counter   = 0;
			
			while ($counter < $length)
			{
				$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
				// All character must be different
				if (!strstr($password, $actChar))
				{
					$password .= $actChar;
					$counter++;
				}
	   		}
			return $password;
		}
		$pass=generatePassword();
		$hpass=md5($pass);
		$uquery="update emp_master set password='$hpass' where short_id='$email'";
		$uresult=mysql_query($uquery);
		$headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: jjanarthanan@csc.com';
		$subject="Idea Generation Tool: Password Reset";
		$to=$email;
		//$to="kboovaragan@csc.com";
		$name_query="select name from emp_master where short_id='$email'";
		$name_result=mysql_query($name_query) or die ("Could not execute query ($name_query) because ".mysql_error());
		$name_row=mysql_fetch_array($name_result);
		$name=$name_row['name'];
		$message="Dear $name,\n\nThis is is to notify that your password has been reset to: \"$pass\".\n\nRegards,\nThe Idea Generation Team.";
		mail($to, $subject, $message, $headers);
		echo "<div align='center'>Your password has been reset and emailed to you. <a href='index.php'>Go to Home</a>";
	}
}
else
{
	?>
	<form name="forgot-password" method="post" action="forgot-password.php" onsubmit="return checkform(this)">
	<table align="center" class="theme-details">
	<tr><th colspan="2" class="theme-details-m">Forgot Password</th></tr>
	<tr><td align="right">Enter User ID (Email)</td><td><input type="text" name="email" size="32"></td></tr>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Submit"></td></tr>
	</table>
	</form>

<?php
}
include "footer.php";
?>