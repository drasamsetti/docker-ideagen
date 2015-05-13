<?php
	error_reporting(0);
	
	//include('config.php');	// include your code to connect to DB in the Config file.
	//include('initial_header.php');
	include "header-main.php";
	
	$query = sprintf("SELECT * FROM emp_master WHERE short_id='%s'",mysql_real_escape_string($_POST[shortid]));
	$result=mysql_query($query) or die("Could not execute query");
	$row=mysql_fetch_object($result);
	if(mysql_num_rows($result)>0)
	{
		$_SESSION['shortid'] = $_POST[shortid];
		$QID = $row->QID;
		$query="SELECT * FROM secquestion WHERE QID = $QID";

		$result=mysql_query($query) or die("Could not execute query because: ".mysql_error());

		if( ( $value = mysql_num_rows($result) ) > 0)
		{
			$row=mysql_fetch_object($result);
			$Question = $row->Question;
  		}
		else
		{
			// Error: Secret Question not Set
		}

		$query="select * from emp_master WHERE short_id = '$_SESSION[shortid]'";

		$result=mysql_query($query) or die("Could not execute query because: ".mysql_error());

		if( ( $value = mysql_num_rows($result) ) > 0)
		{
			$row=mysql_fetch_object($result);
			$_SESSION['dbAnswer'] = $row->secanswer;
		}
		?>
		<div align="center">
<p><font face="Arial"color="000000" size="2">Please enter your Answer</font></p>
<form name="form2" method="post" action="csc_lr_forgetpw_2.php">

<FIELDSET style="border-style:solid;border-width:3px;border-color:#BDBDBD;noshade:noshade;align:center;width:300px;height:125px">   
<LEGEND style="color:#000000;padding-left:1px;padding-right:1px;font-size:14px;font-weight:bold;" >CSC IdeaGen Forget Password</LEGEND>

<table>
<tr>
<td><b>UserName :</b></td>
<td><font type="arial" size="2"><?php echo $_SESSION['shortid']; ?></font></td>
<tr>
<td><b>Secret Question :</b></td><td><font type="arial" size="2"><?php echo "$Question"; ?></font></td>
</tr>
</td>
</tr>
<tr>
<td><b>Answer :</b></td>
<td><input name="SecAnswer" type="password" id="SecAnswer" size="16" maxlength="36"></td>
</tr>
<tr align='center'>
<td>
<input type="submit" name="Submit" value="Set Password">
</td>
</tr>
</table>
</FIELDSET>
</form>
</div>
<?php
	}
	else
	{
		if($_POST[shortid])
		{
		?>
		<script language="Javascript">
		alert("Sorry, <?php echo $_POST[shortid] ?> not exist");
		<!--
		window.location="csc_lr_forgetpw.php";
		//-->
		</script>				
		<?php
		}
		else
		{
		?>
		<script language="Javascript">
		alert("Provide a valid UserName");
		<!--
		window.location="csc_lr_forgetpw.php";
		//-->
		</script>				
		<?php
		}
	?>
		<br>
		<br>
		<a href="csc_lr_forgetpw.php">Go to Password Recovery!</a>
		</br>
		</br>
	<?php
}
?>

<div>&nbsp;</div>

<!--<table class="plain" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td colspan="3" bgcolor="#cc0000"><img alt="" src="index_files/Px_Clear.gif" 
nbvnbv height="6" width="794"></td>
					</tr>
					
				</tbody>
			</table>  -->

	<?php include("footer.php"); ?>	