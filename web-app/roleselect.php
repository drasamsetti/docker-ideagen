<?php

//include "header_temp.php";

/*$auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}
*/
error_reporting(0);
include "check-session.php";
include "connection.php";
?>
<form name="roleselect" action="index.php" method="POST">
<?php

//$short_id=$_SESSION['short_id'];
$short_id=$_GET['user'];
//$account=$_SESSION['account'];

//echo "Short ID : ".$short_id;
//echo "<br/>Session Short id : ".$_SESSION['short_id'];

				?>
				<link href="table/table.css" rel="stylesheet" type="text/css" />
				<table width="100%" class="main">
					<tr><td colspan="2" height="10%">
						<table cellspacing = "0" cellpadding = "0" border = "0" width="100%" class="main" style = "border:0px solid black">
						<tr>
							<td width = "205"><img src = "images/logo.png" border = "0" height = "140"></td>
							<td valign = "bottom" align = "right">
							<table style="margin-top:10px;padding:0px;border:0px solid" cellpadding="0" cellspacing="0" width="100%" >
							<tbody>
								<tr height = "33">
                                    <td style = "background:#ccc;" align = 'center'><b> <?php //echo $zz; ?></b></td>
									<td style = "background:#ccc;" align = 'right'><!--<b><a href="http://innovation.in.csc.com">Office of Innovation</a> | <a href="http://www.csc.com">Global Site</a> | <a href="help/index.php?page=<?php //echo $_SERVER['SCRIPT_NAME']; ?>" target="_blank">Help</a></b>--></td>
									<td style = "background:url('images/footer-csc.gif') center right no-repeat;width:120px;"></td>
								</tr>
							</tbody>
						</table></td>
						</tr>
						</table></td></tr>
						<tr><td>&nbsp;</td><td><br/><br/>
				<div>Switch Role as : </div><div><select name="login_role" class="controltext">
				<?php
				//$cnt=0;
				$sqlqry="select * from role_trans where emp_short_id='$short_id'";
				$sqlrole=mysql_query($sqlqry);
				
				//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","Regional CTO");
				//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO");
				
				//$_SESSION['lastrole'];
				//echo "<br/>SQL Query : ".$sqlqry;
				while($rolechk=mysql_fetch_array($sqlrole))
				{
				$temp=$rolechk['role_id'];
				?>
				<option value="<?php echo $rolechk['role_id'];?>"><?php echo $_SESSION['emp_role'][$temp];?></option>
				<?php
					//echo "Role : ".$rolechk['role_id']."<br/>";
					//$_SESSION['lastrole']=$rolechk['role_id'];
					//$_SESSION['role']=$rolechk['role_id'];
					//$cnt=$cnt+1;
					
				}

?>
</select></div>
<br/><div><input type="submit" name="rolesubmit" class="controltext" value="Choose a Role to Continue"></div>
</td>
</tr>
</table>
</form>

<?php
include "footer.php";
?>
