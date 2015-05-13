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
$idea_theme;
$exptname;
$overview;
while($chkflag = mysql_fetch_array($chkqry))
{
	$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$chkflag['request_theme'];
	$req_theme=mysql_query($themesql);
		
	while($reqt_theme = mysql_fetch_array($req_theme))
	{
		$idea_theme = $reqt_theme['meta_text'];
	}
	$bufunded = $chkflag['funding_by_business'];
	$exptname = $chkflag['expt_shortname'];
	$overview = $chkflag['overview'];
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
/*	$action='Executive Summary Uploaded';
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
*/	
	$action='IRB Offering Business Plan Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$drmurl = $getmyurl['comments'];
	}
	
	$action='IRB Business Plan Financial Uploaded';
	$sqlurl = "SELECT * FROM  `trans_master` where `req_no`='$req_no' and `action_taken`='$action'";
	$fetchurl = mysql_query($sqlurl);
	
	while($getmyurl = mysql_fetch_array($fetchurl))
	{
		$tkmurl = $getmyurl['comments'];
	}
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

	$moreinfo=mysql_real_escape_string($_POST['cscmoreinfo']);
	$comments=mysql_real_escape_string($_POST['cscprcomments']);
	$curr_status;
	
	if ($bufunded=="Yes")
	{
		if ($moreinfo=='Yes')
		{
			$curr_status='300';
		}
		else
		{
			$curr_status='211';
		}
	}
	else
	{
		if ($moreinfo=='Yes')
		{
			$curr_status='241';
		}
		else
		{
			$curr_status='211';
		}
	}

	if ($bufunded=="Yes")
	{
		if ($curr_status=='300')
		{
			$action_taken="Submitted to ATD";
		}
		elseif ($curr_status=='211')
		{
			$action_taken="Idea Response submission in progress";
		}
		else
		{
			$action_taken="Approved";
		}
	}
	else
	{
		if ($curr_status=='241')
		{
			$action_taken="IRB Decision - Pending";
		}
		elseif ($curr_status=='211')
		{
			$action_taken="Idea Response submission in progress";
		}
		else
		{
			$action_taken="Approved";
		}
	}
	
	$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
	//echo $sql."<br/>";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";
	//echo $sqlins."<br/>";
	mysql_query($sqlins);
	
print "<br/><br/>Updated Successfully ";
print "<br/><br/>Notification will be sent (Work in Progress) ";


echo "<meta http-equiv='refresh' content='5;url=viewirbreviewideasvoting.php'>";
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

</script>

<form name="account" action="<?php echo $_SERVER['PHP_SELF'].'?req_no='.$req_no?>" method="POST" enctype="multipart/form-data">
	<br/><br/>
	<table id="skillview" width="100%">
		<tr><th colspan="4" class="theme-details-l">For IRB - Review</th></tr>
		<tr><td>Idea Theme : </td><td colspan="3"><?php echo $idea_theme; ?></td></tr>
		<tr class="alt"><td>Experiment /Project Name : </td><td colspan="3"><?php echo $exptname; ?></td></tr>
		<tr><td>Overview : </td><td colspan="3"><?php echo $overview; ?></td></tr>
		<!--<tr class="alt"><td colspan="4"><a href="<?php echo $esurl;?>">Executive Summary</a></td><!--<td colspan="2">- <a href="<?php echo $esurl;?>">View Executive Summary<input type="button" name="execsummarydownload" class="controltext" value="Download Executive Summary" /></a></td></tr>
		<tr><td colspan="4"><a href="<?php echo $odurl;?>">Offering Description</a></td><!--<td colspan="2">- View Offering Description<input type="button" name="offeringdescdownload" class="controltext" value="Download Offering Description" /></a></td></tr>
		<tr class="alt"><td colspan="4"><a href="<?php echo $maurl;?>">Market Assessment</a></td><!--<td colspan="2">- View Market Assessment<input type="button" name="marketassessdownload" class="controltext" value="Download Market Assessment" /></a></td></tr>
		<tr><td colspan="4"><a href="<?php echo $fpurl;?>">Financial Projection</a></td><!--<td colspan="2">- View Financial Projection<input type="button" name="finanprojdownload" class="controltext" value="Download Financial Projection" /></a></td></tr>-->
		<tr class="alt"><td colspan="4"><a href="<?php echo $drmurl;?>">IRB Offering Business Plan</a></td><!--<td colspan="2">- View Dependencies, Risk and Mitigation<input type="button" name="deprismitdownload" class="controltext" value="Download Dependencies, Risk and Mitigation" /></a></td>--></tr>
		<tr><td colspan="4"><a href="<?php echo $tkmurl;?>">IRB Business Plan Financial</a></td><!--<td colspan="2">- View Timelines and Key Milestones<input type="button" name="timekeymiledownload" class="controltext" value="Download Timelines and Key Milestones" /></a></td>--></tr>
		<tr class="alt"><td>Submission Detailed enough : </td><td colspan="3"><input type="radio" name="cscmoreinfo" class="controltext" value="Yes" onclick="fncheck();"> Yes &nbsp;&nbsp; <input type="radio" name="cscmoreinfo" class="controltext" value="No" onclick="fncheck();"> No</td></tr>
		<tr ><td>Comments : </td><td colspan="3"><textarea name="cscprcomments" class="controltext" rows="3" cols="100"></textarea></td></tr>
		<tr class="alt"><td colspan="4" align="right"><input type="submit" name="irbapproved" disabled class="controltext" value="Approved" />&nbsp;&nbsp;<input type="button" name="irbcancel" class="controltext" value="Cancel" onclick="javascript:history.back();" /><input type="hidden" name="cscbufunded" value="<?php echo $bufunded;?>" />
		<!--<input type="button" name="irbonhold" class="controltext" value="On Hold" />&nbsp;&nbsp;<input type="button" name="irbrejected" class="controltext" value="Rejected" />&nbsp;&nbsp;<?php if ($bufunded=='No') {?><input type="button" name="irbvoting" class="controltext" value="Follow IRB Voting Process" /><?php }?>--></td></tr>
		<!--<tr class="alt"><td>Decision Remarks: </td><td colspan="3"><textarea name="cscprdecision" class="controltext" rows="3" cols="100"></textarea></td></tr>-->
	</table>
	
</form>

<?php
}
include "footer.php";
?>