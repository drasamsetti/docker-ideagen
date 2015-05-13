<?php
error_reporting(0);
include "header-main.php";

 $auth=$_SESSION['auth_no'];
 
 $req_no = $_GET['req_no'];
 $reviewer_type=$_SESSION['role'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
	$owneremail = $_SESSION['short_id'];
	$sql = "SELECT * FROM  `csc_lr_experiment_req` where `owner_email_id`='$owneremail' and `experiment_current_snapshot`='1'";
	$winningidea = mysql_query($sql);

if (isset($_REQUEST['essubmit']))
{
	//echo "Inside essubmit<br/>";
	$target_path;
	if($_FILES['uploadexecsummary']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploadexecsummary']['name']);
		if(move_uploaded_file($_FILES['uploadexecsummary']['tmp_name'], $target_path))
		{
			echo "Executive Summary File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Executive Summary Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='111' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
}

if (isset($_REQUEST['odsubmit']))
{
	//echo "Inside odsubmit<br/>";
	$target_path;
	if($_FILES['uploadofferingdesc']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploadofferingdesc']['name']);
		if(move_uploaded_file($_FILES['uploadofferingdesc']['tmp_name'], $target_path))
		{
			echo "Offering Description File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Offering Description Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='121' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
	
}

if (isset($_REQUEST['masubmit']))
{
	//echo "Inside masubmit<br/>";
	$target_path;
	if($_FILES['uploadmarketassess']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploadmarketassess']['name']);
		if(move_uploaded_file($_FILES['uploadmarketassess']['tmp_name'], $target_path))
		{
			echo "Market Assessment File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Market Assessment Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='131' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
	
}

if (isset($_REQUEST['fpsubmit']))
{
	//echo "Inside fpsubmit<br/>";
	$target_path;
	if($_FILES['uploadfinanproj']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploadfinanproj']['name']);
		if(move_uploaded_file($_FILES['uploadfinanproj']['tmp_name'], $target_path))
		{
			echo "Financial Projection File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Financial Projection Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='141' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
	
}

if (isset($_REQUEST['drmsubmit']))
{
	//echo "Inside drmsubmit<br/>";
	$target_path;
	if($_FILES['uploaddeprismit']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploaddeprismit']['name']);
		if(move_uploaded_file($_FILES['uploaddeprismit']['tmp_name'], $target_path))
		{
			echo "Dependencies, Risk & Mitigation File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Dependencies, Risk & Mitigation Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='151' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
	
}

if (isset($_REQUEST['tkmsubmit']))
{
	//echo "Inside tkmsubmit<br/>";
	$target_path;
	if($_FILES['uploadtimekeymile']['name']!="")
	{
		
		$target_path = 'files/'.$req_no;
		//echo $target_path;
		If(!file_exists($target_path)) //part A
		{
			mkdir($target_path); //part B
		} 
		$target_path = $target_path."/";
		$target_path = $target_path."WinningIdea_".$owneremail."_".basename( $_FILES['uploadtimekeymile']['name']);
		if(move_uploaded_file($_FILES['uploadtimekeymile']['tmp_name'], $target_path))
		{
			echo "Timeline and KeyMilestone File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		echo "In File upload Else loop";
	}
	
	$comments = $target_path;
	$action_taken='Timeline and KeyMilestone Uploaded';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='161' where request_num='$req_no'";
	mysql_query($sql);
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$comments','$action_taken')";
	mysql_query($sqlins);
	
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Executive Summary Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag1'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag1']='ESU';
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Offering Description Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag2'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag2']='ODU';
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Market Assessment Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag3'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag3']='MAU';
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Financial Projection Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag4'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag4']='FPU';
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Dependencies, Risk & Mitigation Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag5'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag5']='DRMU';
}

$sqlqry="select * from `trans_master` where `req_no`='$req_no' and `action_taken`='Timeline and KeyMilestone Uploaded'";
$irb_trans = mysql_query($sqlqry);
$_SESSION['flag6'];
while($irb_tran = mysql_fetch_array($irb_trans))
{
	$_SESSION['flag6']='TKMU';
}
	
if (isset($_REQUEST['irbreviewsubmit']))
{
	//echo "Inside irbreviewsubmit<br/>";
	
	
	//$comments = 'File Path : '.$target_path;
	$action_taken='Idea Winner Submitted with IRB Review templates (filled)';
	
	$sql = "update `csc_lr_experiment_req` set `experiment_current_snapshot`='171' where request_num='$req_no'";
	mysql_query($sql);
	
	
	
	$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `action_taken`) VALUES ('$req_no','$reviewer_type','$owneremail','$action_taken')";
	mysql_query($sqlins);
	
	echo "<meta http-equiv='refresh' content='5;url=viewsubmittedideas.php'>";
}	

 $sqlsel= "select * from `csc_lr_experiment_req` where request_num='$req_no'";
	$curstatuses=mysql_query($sqlsel);
	$currstatus;
	while($curstatus = mysql_fetch_array($curstatuses))
	{
		$currstatus = $curstatus['experiment_current_snapshot'];
	}

?>
<script>
function fnchkfileexists()
{
	alert ('Inside JS');
	var x = document.getElementsByTagName('input');
	alert (x.length);
	//alert (x.value);
	//for (i = 1;i <= x.length; i++)
	//{
	//	alert (x[i].value);
	//}
	//alert (document.account.essubmit.clicked);
	if (document.account.essubmit.clicked==true)
	{
		if (document.account.uploadexecsummary.value=="")
		{
			alert ('Please select the Appropriate Executive Summary File and the click on Upload');
			return false;
		}
	}
	
}
</script>
<form name="account" action="<?php echo $_SERVER['PHP_SELF'].'?req_no='.$req_no?>" method="POST" enctype="multipart/form-data">
	<br/><br/>
		<table id="skillview" width="100%">
		<tr><th colspan="4" class="theme-details-l">Investment Request Process - Business Case Template</th></tr>
		<tr align="left"><th></th><th></th><th></th><!--<th>Owner</th>--><th>Status Uploaded Y/N</th></tr>
		<tr><td>Executive Summary</td><td><a href="templates/executive_summary_template.xls"><input type="button" name="execsummarydownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploadexecsummary"><input type="submit" name="essubmit" value="Publish Executive Summary" /></td><td><?php if ($_SESSION['flag1']=='ESU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr class="alt"><td>Offering Description</td><td><a href="templates/offering_dscr_Template_v1.docx"><input type="button" name="offeringdescdownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploadofferingdesc"><input type="submit" name="odsubmit" value="Publish Offering Description" /></td><td><?php if ($_SESSION['flag2']=='ODU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr><td>Market Assessment</td><td><a href="templates/Market_Strategy_Template.docx"><input type="button" name="marketassessdownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploadmarketassess"><input type="submit" name="masubmit" value="Publish Market Assessment" /></td><td><?php if ($_SESSION['flag3']=='MAU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr class="alt"><td>Financial Projection</td><td><a href="templates/IRB-Business_Plan_Financials_template_v1.8.xlsx"><input type="button" name="finanprojdownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploadfinanproj"><input type="submit" name="fpsubmit" value="Publish Financial Projection" /></td><td><?php if ($_SESSION['flag4']=='FPU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr><td>Dependencies, Risks and Mitigation</td><td><a href="templates/Depend_stakehoder_template.docx"><input type="button" name="deprismitdownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploaddeprismit"><input type="submit" name="drmsubmit" value="Publish Dependencies, Risk & Mitigation" /></td><td><?php if ($_SESSION['flag5']=='DRMU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr class="alt"><td>Timelines and Key Milestones</td><td><a href="templates/Timelines_milestones.xls"><input type="button" name="timekeymiledownload" class="controltext" value="Download Template" /></a></td><td><input type="file" class="controltext" name="uploadtimekeymile"><input type="submit" name="tkmsubmit" value="Publish Timeline and KeyMilestone" /></td><td><?php if ($_SESSION['flag6']=='TKMU') {?><img src="images/tick.jpg" border="0"><?php }?></td></tr>
		<tr><td colspan="4" align="right">
		<input type="submit" name="irbreviewsubmit" value="Submit for IRB Review" 
		<?php 
			if (($_SESSION['flag1']=='') || ($_SESSION['flag2']=='') || ($_SESSION['flag3']=='') || ($_SESSION['flag4']=='') || ($_SESSION['flag5']=='') || ($_SESSION['flag6']=='')) 
					{ 
					?>
			disabled
			<?php }	
			elseif ($currstatus=='171')
					{
					?>
			disabled
					<?php
			}
		?> ></td></tr>
		</table>
		<!--<div align="right">
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>
		<div>
		<?php
		//chk = md5(201f00b5ca5d65a1c118e5e32431514c);
		//echo "Value is ".chk;
		
		?>
		</div>-->
		<!--<table width = "100%" cellpadding = "2" cellspacing = "0" style = "font-size:0.9em">
		</table>
	<p align="center"><input type="button" name="btnClose" id="btdClose" Value="Close" onclick="javascript:window.close()"></p>-->
	</form>
	
	<br/><br/>

<?php
//}
include "footer.php";
?>