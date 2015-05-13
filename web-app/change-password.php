<?php
include "header-main.php";

/*if($auth==0)
{
    //echo "<h1>you are not authorised ";
   // die;
}*/
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
	$cpass=md5($_REQUEST['cpass']);
	$npass1=md5($_REQUEST['npass1']);
	$npass2=md5($_REQUEST['npass2']);
	$short_id=$_SESSION['short_id'];
	
	$cquery="select * from emp_master where short_id='$short_id' and password='$cpass'";
	$cresult=mysql_query($cquery);
	if(mysql_num_rows($cresult)==0)
	{
		echo "<div align='center'>Current Password is incorrect! <a href='change-password.php'>Go back and try again</a>";
	}
	elseif($npass1==$npass2)
	{
		$nquery="update emp_master set password='$npass1' where short_id='$short_id'";
		//echo $nquery."<br />";
		$nresult=mysql_query($nquery);
		echo "<div align='center'>Password updated! <a href='index.php'>Go to Home</a>";
	}
}
else
{
	?>
	<form name="change-password" method="post" action="change-password.php" onsubmit="return checkform(this)">
	<table align="center" class="theme-details">
	<tr><th colspan="2" class="theme-details-m">Change Password</th></tr>
	<tr><td align="right">Enter Current Password</td><td><input type="password" name="cpass" size="32"></td></tr>
	<tr><td align="right">Enter New Password</td><td><input type="password" name="npass1" size="32"></td></tr>
	<tr><td align="right">Enter New Password Again</td><td><input type="password" name="npass2" size="32"></td></tr>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Submit"></td></tr>
	</table>
	</form>

<?php
}
include "footer.php";
?>