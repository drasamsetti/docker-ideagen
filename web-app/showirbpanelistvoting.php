<?php
error_reporting(0);
include "connection.php";

 $auth=$_SESSION['auth_no'];
 $reviewer_type=$_SESSION['role'];

/*if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
*/
$req_no = $_GET['req_no'];

$email = $_SESSION['short_id'];

$sql = "SELECT * FROM  `trans_master` where `req_no`='$req_no'";
$irbtemplate = mysql_query($sql);

$sqlirbapp="select * from `emp_master` where `role`='9'";
$irbappr=mysql_query($sqlirbapp);

$sqlqry="select * from trans_master where req_no='$req_no' and `action_taken`='Submitted Voting'";
$sqltrans=mysql_query($sqlqry);

$trans_short_id;
$trans_voting_opt;
$trans_comments;
$n=1;
	while($gettransdet = mysql_fetch_array($sqltrans))
	{
		$trans_short_id[$n] = $gettransdet['email_id'];
		$trans_voting_opt[$n] = $gettransdet['voting_option'];
		$trans_comments[$n] = $gettransdet['comments'];
		//echo "N Value is ".$n." ".$trans_comments[$n]."<br/>";
		$n=$n+1;
	}

?>
<SCRIPT language=JavaScript>
<!-- 
function win(){
window.opener.location.href="ideaunderirbvoting.php?req_no=<?php echo $req_no;?>";
self.close();
//-->
}
</SCRIPT>
<link href="./date/css/demo.css"       rel="stylesheet" type="text/css" />
              <link href="./date/css/datepicker.css" rel="stylesheet" type="text/css" />
              <link href="table/table.css" rel="stylesheet" type="text/css" />
			  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
			<link rel="icon" type="image/png" href="img/CSC_Icon.png" />
<table id="skillview" width="100%">
<tr align="left"><th>IRB Approvers</th><th>Decision</th><th colspan="2">Decision Comments</th></tr>
<?php
		$cnt=1;
		//$n=1;
		$tot=count($trans_short_id);		
		while($getirbappr = mysql_fetch_array($irbappr))
		{
		if ($cnt%2 == 1)
		{
		//else
		//{
		//echo "Cnt Value : ".$cnt." ".$getirbappr['name']." ".$trans_comments[$cnt]."<br/>";
		?>
		<tr class="alt">
			<td><?php echo $getirbappr['name'];?><input type="hidden" name="cscirbapprname" value="<?php echo $getirbappr['name'];?>"><input type="hidden" name="cscirbapprshortid" value="<?php echo $getirbappr['short_id'];?>"></td>
			<td><?php 
			$flag;
			$trans_email;
			for ($x = 1; $x <= $tot; $x++)
			{
			if ($trans_short_id[$x]==$getirbappr['short_id']) 
			{ 
			?>
							<span class="cscprstatustext" > 
							<?php
							if ($trans_voting_opt[$x] == 'Yes')
							{
							?>
							<img src="images/Vote-Yes.jpg" border="0" />
							<?php
							}
							elseif ($trans_voting_opt[$x] == 'No')
							{
							?>
							<img src="images/Vote-No.jpg" border="0" />
							<?php
							}
							elseif ($trans_voting_opt[$x] == 'OnHold')
							{
							?>
							<img src="images/Vote-OnHold.jpg" border="0" />
							<?php
							}
							else
							{
							?>
							<img src="images/NotVoted.jpg" border="0" />
							<?php
							}
							?>
							</span>
							<?php
				//echo $trans_voting_opt[$x]; 
				
				//$trans_email=$trans_email.",".$trans_short_id[$x];
				//$flag=1;
			} 
			}
			
			//$flag=stripos($trans_email,$email);
			//echo $flag." ".$trans_email." ".$getirbappr['short_id'];
						
			?>
			</td>
			<td colspan="2">
			<?php 
			$flag2;
			$trans_email2;
			for ($x = 1; $x <= $tot; $x++)
			{
			if ($trans_short_id[$x]==$getirbappr['short_id']) 
			{ 
				echo $trans_comments[$x]; 
				
				//$trans_email2=$trans_email2.",".$trans_short_id[$x];
				//$flag2=1;
			} 
			}
			//$flag2=stripos($trans_email2,$email);
			
			?>
			</td>
			<!--<td><?php// if ($trans_short_id[$n]==$getirbappr['short_id']) { echo $trans_voting_opt[$n]; }?></td>
			<td><?php// if ($trans_short_id[$n]==$getirbappr['short_id']) { echo $trans_comments[$n]; }?></td>-->
		</tr>
		<?php
		}
		else
		{
		//echo "Cnt Value : ".$cnt." ".$getirbappr['name']." ".$trans_comments[$cnt]."<br/>";
		?>
		<tr>
			<td><?php echo $getirbappr['name'];?><input type="hidden" name="cscirbapprname" value="<?php echo $getirbappr['name'];?>"><input type="hidden" name="cscirbapprshortid" value="<?php echo $getirbappr['short_id'];?>"></td>
			<td><?php 
			$flag1;
			$trans_email1;
			for ($x = 1; $x <= $tot; $x++)
			{
			if ($trans_short_id[$x]==$getirbappr['short_id']) 
			{ 
				?>
							<span class="cscprstatustext" > 
							<?php
							if ($trans_voting_opt[$x] == 'Yes')
							{
							?>
							<img src="images/Vote-Yes.jpg" border="0" />
							<?php
							}
							elseif ($trans_voting_opt[$x] == 'No')
							{
							?>
							<img src="images/Vote-No.jpg" border="0" />
							<?php
							}
							elseif ($trans_voting_opt[$x] == 'OnHold')
							{
							?>
							<img src="images/Vote-OnHold.jpg" border="0" />
							<?php
							}
							else
							{
							?>
							<img src="images/NotVoted.jpg" border="0" />
							<?php
							}
							?>
							</span>
							<?php
				
				//$trans_email1=$trans_email1.",".$trans_short_id[$x];
				//$flag1=1;
			} 
			}
			//$flag1=stripos($trans_email1,$email);
			
			?>
			</td>
			<td colspan="2">
			<?php 
			$flag3;
			$trans_email3;
			for ($x = 1; $x <= $tot; $x++)
			{
			if ($trans_short_id[$x]==$getirbappr['short_id']) 
			{ 
				echo $trans_comments[$x]; 
				
				//$trans_email3=$trans_email3.",".$trans_short_id[$x];
				//$flag3=1;
			} 
			}
			//$flag3=stripos($trans_email3,$email);
			
			?>
			</td>
			<!--<td><?php// if ($trans_short_id[$n]==$getirbappr['short_id']) { echo $trans_voting_opt[$n]; }?></td>
			<td><?php// if ($trans_short_id[$n]==$getirbappr['short_id']) { echo $trans_comments[$n]; }?></td>-->
		</tr>
		<?php
		}
		$cnt=$cnt+1;
		//$n=$n+1;
		
		}
		//}
		
		?>
		
		<tr><td colspan="4"><center><input type=button onClick="win();" value="Close this window"></center></td></tr>

</table>