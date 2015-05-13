<?php
error_reporting(0);
include "header-main.php";

 $auth=$_SESSION['auth_no'];
 $reviewer_type=$_SESSION['role'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}

$req_no = $_GET['req_no'];

$email = $_SESSION['short_id'];

$sqlqry="select * from `csc_lr_experiment_req` where `request_num`='$req_no'";
$chkqry=mysql_query($sqlqry);

$bufunded;
while($chkflag = mysql_fetch_array($chkqry))
{
	$bufunded = $chkflag['funding_by_business'];
}

//echo "BU Funded : ".$bufunded."<br/>";

$sql = "SELECT * FROM  `trans_master` where `req_no`='$req_no'";
$irbtemplate = mysql_query($sql);

//echo $sql."<br/>";

$esurl;
$odurl;
$maurl;
$fpurl;
$drmurl;
$tkmurl;

while($row = mysql_fetch_array($irbtemplate))
{
	$action='Executive Summary Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	//echo $fetchurl."<br/>";
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$esurl = $getmyurl['comments'];
		//echo $esurl."<br/>";
		//echo "Hi" .$getmyurl['comments'];
	}
	
	$action='Offering Description Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	//echo $fetchurl."<br/>";
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$odurl = $getmyurl['comments'];
	}
	
	$action='Market Assessment Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	//echo $fetchurl."<br/>";
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$maurl = $getmyurl['comments'];
	}
	
	$action='Financial Projection Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$fpurl = $getmyurl['comments'];
	}
	
	$action='Dependencies, Risk & Mitigation Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$drmurl = $getmyurl['comments'];
	}
	
	$action='Timeline and KeyMilestone Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$tkmurl = $getmyurl['comments'];
	}
}

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
	
/*
echo $esurl."<br/>";
echo $odurl."<br/>";
echo $maurl."<br/>";
echo $fpurl."<br/>";
echo $drmurl."<br/>";
echo $tkmurl."<br/>";
*/

if(isset($_REQUEST['irbapproved']))
{

	//$moreinfo=mysql_real_escape_string($_POST['cscmoreinfo']);
	$comments=mysql_real_escape_string($_POST['cscprcomments']);
	$voting=mysql_real_escape_string($_POST['cscprirbvoting']);
	$emptotal=mysql_real_escape_string($_POST['hidcnt']);
	$emptotal=$emptotal-1;
	
	
	
	
	//$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
	//echo $sql."<br/>";
	//mysql_query($sql);
	$action_taken='Submitted Voting';
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`, `voting_option`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken','$voting')";
	//echo $sqlins."<br/>";
	
	
	
	if (($comments<>"") && ($voting<>""))
	{
	mysql_query($sqlins);
	
print "<br/><br/>Voting updated Successfully ";
print "<br/><br/>Notification will be sent (Work in Progress) ";

//echo "<meta http-equiv='refresh' content='5;url=viewirbreviewideasvoting.php'>";
	}
	else
	{
		print "<br/><br/>You have not yet Voted !!!";
		print "<br/><br/>Please choose your Voting option, Decision Comment and Submit again";
		
		echo "<meta http-equiv='refresh' content='5;url=ideaunderreviewsvoting.php?req_no=".$req_no."'>";
	}

	$sqlchkqry="select * from trans_master where req_no='$req_no' and `action_taken`='Submitted Voting'";
	$sqltransqry=mysql_query($sqlchkqry);
	$m=1;
	while($gettransdets = mysql_fetch_array($sqltransqry))
	{
		$transaction_short_id[$m] = $gettransdets ['email_id'];
		$transaction_voting_opt[$m] = $gettransdets ['voting_option'];
		$transaction_comments[$m] = $gettransdets ['comments'];
		//echo "N Value is ".$n." ".$trans_comments[$n]."<br/>";
		$m=$m+1;
	}

	$votetotal=count($transaction_short_id);
	$curr_status;
	//echo "Vote Count : ".$votetotal."<br/>";
	//echo "Emp Count : ".$emptotal."<br/>";
	
	if ($votetotal==$emptotal)
	{
		$yescnt=0;
		$nocnt=0;
		$onholdcnt=0;
		for($i=1;$i<=$votetotal;$i++)
		{
			if ($transaction_voting_opt[$i]=='Yes')
			{
				$yescnt=$yescnt+1;
			}
			elseif ($transaction_voting_opt[$i]=='No')
			{
				$nocnt=$nocnt+1;
			}
			else
			{
				$onholdcnt=$onholdcnt+1;
			}
		}	
			//echo "Yes Count : ".$yescnt."<br/>";
			//echo "No Count : ".$nocnt."<br/>";
			
			if (($yescnt > $nocnt) && ($yescnt > $onholdcnt))
			{
				$curr_status = '300';
				$cmt='Majority of IRB Panel Favored this idea';
				$act='Approved by IRB';
				$sqlqry1="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt','$act')";
				//echo $sqlqry1."<br/>";
				mysql_query($sqlqry1);
				$sqlupd="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd."<br/>";
				mysql_query($sqlupd);
				$cmt1='Based on IRB Voting, this idea can be submitted to ATD for implementation';
				$act1='Submitted to ATD';
				$sqlqry2="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt1','$act1')";
				//echo $sqlqry2."<br/>";
				mysql_query($sqlqry2);
			}
			elseif (($yescnt == $nocnt) || ($yescnt == $onholdcnt) || ($onholdcnt > $nocnt) || ($onholdcnt > $yescnt))
			{
				$curr_status = '271';
				$cmt2='There is a Tie on the Voting for this idea, Idea put on Hold';
				$act2='Hold by IRB';
				$sqlqry3="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt2','$act2')";
				//echo $sqlqry3."<br/>";
				mysql_query($sqlqry3);
				$sqlupd1="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd1."<br/>";
				mysql_query($sqlupd1);
			}
			else
			{
				$curr_status = '261';
				$cmt3='Majority of the IRB are not favoring this idea, hence rejected';
				$act3='Rejected by IRB';
				$sqlqry4="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt3','$act3')";
				//echo $sqlqry4."<br/>";
				mysql_query($sqlqry4);
				$sqlupd2="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd2."<br/>";
				mysql_query($sqlupd2);
			}
			
		echo "<br/>"."Voting phase completed Successfully";
		
		echo "<meta http-equiv='refresh' content='5;url=viewirbreviewideasvoting.php'>";
	}
	else
	{
		$yescnt=0;
		$nocnt=0;
		$onholdcnt=0;
		for($i=1;$i<=$votetotal;$i++)
		{
			if ($transaction_voting_opt[$i]=='Yes')
			{
				$yescnt=$yescnt+1;
			}
			elseif ($transaction_voting_opt[$i]=='No')
			{
				$nocnt=$nocnt+1;
			}
			else
			{
				$onholdcnt=$onholdcnt+1;
			}
		}	
		
		$yeschk=$yescnt/$emptotal;
		$nochk=$nocnt/$emptotal;
		$onholdchk=$onholdcnt/$emptotal;
		
		if ($yeschk>0.5)
		{
				$curr_status = '300';
				$cmt='Majority of IRB Panel Favored this idea';
				$act='Approved by IRB';
				$sqlqry1="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt','$act')";
				//echo $sqlqry1."<br/>";
				mysql_query($sqlqry1);
				$sqlupd="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd."<br/>";
				mysql_query($sqlupd);
				$cmt1='Based on IRB Voting, this idea can be submitted to ATD for implementation';
				$act1='Submitted to ATD';
				$sqlqry2="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt1','$act1')";
				//echo $sqlqry2."<br/>";
				mysql_query($sqlqry2);
		}
		elseif ($nochk>0.5)
		{
				$curr_status = '261';
				$cmt3='Majority of the IRB are not favoring this idea, hence rejected';
				$act3='Rejected by IRB';
				$sqlqry4="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt3','$act3')";
				//echo $sqlqry4."<br/>";
				mysql_query($sqlqry4);
				$sqlupd2="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd2."<br/>";
				mysql_query($sqlupd2);
		}
		elseif ($onholdchk>0.5)
		{
				$curr_status = '271';
				$cmt2='There is a Tie on the Voting for this idea, Idea put on Hold';
				$act2='Hold by IRB';
				$sqlqry3="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$cmt2','$act2')";
				//echo $sqlqry3."<br/>";
				mysql_query($sqlqry3);
				$sqlupd1="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
				//echo $sqlupd1."<br/>";
				mysql_query($sqlupd1);
		}
		//echo "Yes Count : ".$yeschk."<br/>";
		//echo "No Count : ".$nochk."<br/>";
		if (($yeschk>0.5) || ($nochk>0.5) || ($onholdchk>0.5))
		{
			echo "<br/>"."Voting phase completed Successfully";
		
			echo "<meta http-equiv='refresh' content='5;url=viewirbreviewideasvoting.php'>";
		}
		else
		{
				
			echo "<br/>"."Voting phase not yet completed";
		
			echo "<meta http-equiv='refresh' content='5;url=viewirbreviewideasvoting.php'>";
		}
	}

}
else
{


?>

<script type="text/javascript">

function fncheck()
{
	var moreinfo;
	//bufunded=document.getElementByName('cscmoreinfo').value;
	moreinfo=document.account.cscmoreinfo.value;
	bufunded=document.account.cscbufunded.value;
	//alert ("Bu Funded "+bufunded);
	if (bufunded=="Yes")
	{
		if (moreinfo=="Yes") 
		{
			document.account.irbapproved.disabled=false;
			document.account.irbapproved.value="Submit to ATD for Implementation";
		}
		else
		{
			document.account.irbapproved.disabled=false;
			document.account.irbapproved.value="Send back to Idea Winner for more information";
		}
	}
	else
	{
		if (moreinfo=="Yes") 
		{
			document.account.irbapproved.disabled=false;
			document.account.irbapproved.value="Submit for IRB Voting Process";
		}
		else
		{
			document.account.irbapproved.disabled=false;
			document.account.irbapproved.value="Send back to Idea Winner for more information";
		}
	}
	
	return true
}

function fnvalidate()
{
		
	if (document.account.cscprirbvoting.value=="")
	{
		alert ('Please provide your voting decision Yes/No ');
		document.account.cscprirbvoting.focus();
		return false;
	}
	if (document.account.cscprcomments.value=="")
	{
		alert ('Please provide your voting decision comments ');
		document.account.cscprcomments.focus();
		return false;
	}
	
	var ans=confirm("Are you sure to Submit your Vote ?");
	if (ans)
	{
		document.getElementById("account").submit();
	}
	else
	{
		alert ('Please check your Voting and Submit again');
	}
	
	return false
}

</script>

<form name="account" id="account" action="<?php echo $_SERVER['PHP_SELF'].'?req_no='.$req_no?>" method="POST" enctype="multipart/form-data">
	<br/><br/>
	<table id="skillview" width="100%">
		<tr><th colspan="4" class="theme-details-l">For IRB - Review - Voting</th></tr>
		<tr class="alt"><td colspan="4"><a href="<?php echo $esurl;?>">Executive Summary</a></td><!--<td colspan="2">- <a href="<?php echo $esurl;?>">View Executive Summary<input type="button" name="execsummarydownload" class="controltext" value="Download Executive Summary" /></a></td>--></tr>
		<tr><td colspan="4"><a href="<?php echo $odurl;?>">Offering Description</a></td><!--<td colspan="2">- View Offering Description<input type="button" name="offeringdescdownload" class="controltext" value="Download Offering Description" /></a></td>--></tr>
		<tr class="alt"><td colspan="4"><a href="<?php echo $maurl;?>">Market Assessment</a></td><!--<td colspan="2">- View Market Assessment<input type="button" name="marketassessdownload" class="controltext" value="Download Market Assessment" /></a></td>--></tr>
		<tr><td colspan="4"><a href="<?php echo $fpurl;?>">Financial Projection</a></td><!--<td colspan="2">- View Financial Projection<input type="button" name="finanprojdownload" class="controltext" value="Download Financial Projection" /></a></td>--></tr>
		<tr class="alt"><td colspan="4"><a href="<?php echo $drmurl;?>">Dependencies, Risk and Mitigation</a></td><!--<td colspan="2">- View Dependencies, Risk and Mitigation<input type="button" name="deprismitdownload" class="controltext" value="Download Dependencies, Risk and Mitigation" /></a></td>--></tr>
		<tr><td colspan="4"><a href="<?php echo $tkmurl;?>">Timelines and Key Milestones</a></td><!--<td colspan="2">- View Timelines and Key Milestones<input type="button" name="timekeymiledownload" class="controltext" value="Download Timelines and Key Milestones" /></a></td>--></tr>
		<tr><th>IRB Approvers</th><th>Decision</th><th colspan="2">Decision Comments</th></tr>
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
				echo $trans_voting_opt[$x]; 
				$trans_email=$trans_email.",".$trans_short_id[$x];
				//$flag=1;
			} 
			}
			
			$flag=stripos($trans_email,$email);
			//echo $flag." ".$trans_email." ".$getirbappr['short_id'];
			if (($flag=="") && ($email==$getirbappr['short_id']))
			{ 
				
			?>
				<input type="radio" name="cscprirbvoting" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprirbvoting" class="controltext"  value="No"/> No <br/><input type="radio" name="cscprirbvoting" class="controltext"  value="OnHold"/> On Hold
			<?php 
			} 
			
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
				$trans_email2=$trans_email2.",".$trans_short_id[$x];
				$flag2=1;
			} 
			}
			$flag2=stripos($trans_email2,$email);
			if (($flag2=="") && ($email==$getirbappr['short_id']))
			{ 
			?>
				<textarea name="cscprcomments"  class="controltext" rows="3" cols="100"></textarea>
			<?php 
			}
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
				echo $trans_voting_opt[$x]; 
				$trans_email1=$trans_email1.",".$trans_short_id[$x];
				$flag1=1;
			} 
			}
			$flag1=stripos($trans_email1,$email);
			if (($flag1=="") && ($email==$getirbappr['short_id']))
			{ 
			?>
			<input type="radio" name="cscprirbvoting" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprirbvoting" class="controltext"  value="No"/> No <br/><input type="radio" name="cscprirbvoting" class="controltext"  value="OnHold"/> On Hold
			<?php 
			} 
			
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
				$trans_email3=$trans_email3.",".$trans_short_id[$x];
				$flag3=1;
			} 
			}
			$flag3=stripos($trans_email3,$email);
			if (($flag3=="") && ($email==$getirbappr['short_id']))
			{ 
			?>
				<textarea name="cscprcomments"  class="controltext" rows="3" cols="100"></textarea>
			<?php 
			}
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
		<!--<tr class="alt"><td>Final Decision as per IRB Approvers : </td><td colspan="3"><textarea name="cscprfinalcomments" class="controltext" rows="3" cols="100"></textarea></td></tr>-->
		<tr class="alt"><td colspan="4" align="right"><input type="hidden" name="hidcnt" value="<?php echo $cnt;?>" /><input type="submit" name="irbapproved" class="controltext" value="Submit Decision" 
		<?php
		$flag4;
			for ($x = 1; $x <= $tot; $x++)
			{
			if ($trans_short_id[$x]==$email) 
			{ 
				//echo $trans_comments[$x]; 
				$flag4=1;
			} 
			}
			if ($flag4=='1')
			{ 
				//echo 'can be disabled';
		?>
			disabled
		<?php
			}
		?>
		/>&nbsp;&nbsp;<input type="hidden" name="cscbufunded" value="<?php echo $bufunded;?>" />
		<!--<input type="button" name="irbonhold" class="controltext" value="On Hold" />&nbsp;&nbsp;<input type="button" name="irbrejected" class="controltext" value="Rejected" />&nbsp;&nbsp;<?php if ($bufunded=='No') {?><input type="button" name="irbvoting" class="controltext" value="Follow IRB Voting Process" /><?php }?>--></td></tr>
		<!--<tr class="alt"><td>Decision Remarks: </td><td colspan="3"><textarea name="cscprdecision" class="controltext" rows="3" cols="100"></textarea></td></tr>-->
	</table>
	
</form>

<?php
}
include "footer.php";
?>