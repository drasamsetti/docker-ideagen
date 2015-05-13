<?php
//session_start();
//session_register("fgpwd");

	error_reporting(0);
	
	//include('config.php');	// include your code to connect to DB in the Config file.
	//include('initial_header.php');
	include "header-main.php";
	
if( $_POST[Cpassword] == $_POST[password] )
{
	$password=md5($_POST[password]);
	$flag=$_POST['hidflag'];
	$query = sprintf("UPDATE emp_master SET password = '$password' WHERE short_id='%s'",mysql_real_escape_string($_SESSION['shortid']));

	$result = mysql_query($query) or die("Could not execute query because: ".mysql_error());
	if(1 == $result)
	{
		echo "Flag Value :".$flag;
		?>
		<script language="Javascript">
		<!--
			alert("Change Password is Successfull!!");
			window.location="index.php";
		//-->
		</script>
	<?php
	}
	else
	{
		echo "failed to SET the password !!!";
	}
}
else
{

	?>
		<script language="Javascript">
		alert("Sorry, Passowrd mismatch");
		<!--
		window.location="csc_lr_forgetpw.php";
		//-->
		</script>				
	<?php

	echo "I am Sorry Passowrd Mis-match!!!!";
	echo "<br><b>Password</b> and <b>Confirm Password</b> should be same</br>";
?>
	<br>
	<br>
	<a href="csc_lr_forgetpw.php">Go to Password Recovery!</a>
	</br>
<?php
}
?>