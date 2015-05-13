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

//echo "Request No is ".$req_no;
//echo "<br/><br/>";

?>
<script type="text/javascript">
function techreq()
{
	//alert ("Technical Requirement checked : "+myForm.cscprtechreq.value);
	if (myForm.cscprtechreq.value=="Yes")
		myForm.prrejected.disabled=true;
	else
		myForm.prapproved.disabled=true;
		
	return true
}

</script>
<style>
.hide{
display:none;
}
.show{
display:block;
}
</style>

<?php
		$sql="select * from csc_lr_experiment_req where request_num=".$req_no;
		$expt_detail=mysql_query($sql);
		
		/****Fetch the value from previous page and assign it into variable ***/

	$comments=mysql_real_escape_string($_POST['cscprcomments']);
	$req_no=mysql_real_escape_string($_POST['cscprreqno']);
	//$aodlink=mysql_real_escape_string($_POST['cscpraodlink']);
	$email=$_SESSION['short_id']; //$_SESSION['login'];
		
	if(isset($_REQUEST['prapproved']))
	{		
		$curr_status='97';
		$action_taken="Approved";
		$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";
		//echo $sqlins;
		mysql_query($sqlins);
		$curr_status='300';
		$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
		//echo $sql;
		mysql_query($sql);
		
		$action_taken="Submitted to ATD";
		$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$action_taken')";
		//echo $sqlins;
		mysql_query($sqlins);
		
		print "<br/><br/>Idea Approved Successfully ";
		print "<br/><br/>Notification will be sent (Work in Progress) ";
		
		echo "<meta http-equiv='refresh' content='5;url=viewtiedideas.php'>";
	}
	else if(isset($_REQUEST['prrejected']))
	{
		$curr_status='98';
		$action_taken="Rejected by Operations";
		$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";
		//echo $sqlins;
		mysql_query($sqlins);
		$curr_status='500';
		$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;
		//echo $sql;
		mysql_query($sql);
		
		//$action_taken="Idea Rejected";
		//$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";
		//echo $sqlins;
		//mysql_query($sqlins);

		print "<br/><br/>Idea Rejected";
		print "<br/><br/>Notification will be sent to concerned resources (Work in Progress) ";

		echo "<meta http-equiv='refresh' content='5;url=viewtiedideas.php'>";

	}
	else
	{
?>

<form id="myForm" action="movetiedideasfwd.php" method="POST" onsubmit="document.getElementById('prapproved').disabled=true;document.getElementById('prapproved').value='Submitting, please wait...';">

<table border="0" width="90%" height="60%">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellpadding="2" cellspacing="2" >
			<tr><th class="theme-details-l">View Tied Idea - Override</th></tr>
			<tr>
				<td width="100%">
					<div class="laasasidediv">
					<?php
				while($row = mysql_fetch_array($expt_detail))
				{
						
					$sql="select meta_text,meta_desc from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
	
	//echo $sql;
					$expt_snapshot=mysql_query($sql);
					while($expt_snapshots = mysql_fetch_array($expt_snapshot))
					{
						$expt_snapshots_text = $expt_snapshots['meta_text'];
						$expt_snapshots_name = $expt_snapshots['meta_desc'];
					
		?>
					<!--<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td colspan="6"><h3>Challenge Request</h3> <hr></td>
						</tr>
						<tr>
							<td >Challenge Type: </td>
							<td ><select name="cscprchallengetype" id="cscprchallengetype" >
							<option value="-1">--Select the Challenge Type--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'challenge_type' ";
								$challenge_types=mysql_query($sql);
								while($challenge_type = mysql_fetch_array($challenge_types))
								{
							?>
									<option value="<?php echo $challenge_type['meta_code'];?>" ><?php echo $challenge_type['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							<td colspan="4">&nbsp;</td>
						</tr>
						</table>-->
						<input type="hidden" name="cscprchallengetype" value="ideachallenge">
						<input type="hidden" name="cscprcurrstatus" value="<?php echo $row['experiment_current_snapshot'];?>">
						<div class="show" id="ongoing">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td colspan="5">&nbsp;</td>
							<td ><span class="cscprstatus">Status :</span><span class="cscprstatustext" > <?php echo $expt_snapshots_name;?></span></td>
						</tr>
						<tr>
							<td colspan="6"><hr width="100%"></td>
						</tr>
						<tr>
							<td>Idea Theme: </td>
							
							<td ><select name="cscprreqtheme" class="controltext" disabled>
							<option value="-1">--Select the Idea Theme--</option>
							<?php 
								$themesql="select * from csc_lr_metadata where meta_name = 'CTO' and meta_type='request_theme' and meta_code=".$row['request_theme'];
								$request_themes=mysql_query($themesql);
							
								//$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' ";
								//$request_themes=mysql_query($sql);
								while($request_theme = mysql_fetch_array($request_themes))
								{
							?>
									<option value="<?php echo $request_theme['meta_code'];?>" selected ><?php echo $request_theme['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Experiment/Project Name: </td><td ><input type="text" name="cscprexptname" class="controltext" value="<?php echo $row['expt_shortname'];?>" readonly /></td>

							<td>BU Sponsor: </td><td ><input type="text" name="cscprbusponsor" class="controltext" value="<?php echo $row['bu_sponsor'];?>" readonly /></td>
						</tr>
						<tr>
							<td>Overview: </td><td ><textarea name="cscproverview" rows="3" class="controltext" readonly><?php echo $row['overview'];?></textarea></td>

							<td>Problem Statement: </td><td ><textarea name="cscprprobstat" class="controltext" rows="3" readonly><?php echo $row['problem_statement'];?></textarea></td>

							<td>Customer Segment: </td><td ><select name="cscprcustseg" class="controltext" disabled>
							<option value="-1">--Select the Customer Segment--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'customer_segment' and meta_code=".$row['customer_segment'];
								$customer_segments=mysql_query($sql);
								while($customer_segment = mysql_fetch_array($customer_segments))
								{
							?>
									<option value="<?php echo $customer_segment['meta_code'];?>" selected><?php echo $customer_segment['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
						</tr>
						<tr>
							<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" class="controltext" rows="3" readonly><?php echo $row['unique_value_proposition'];?></textarea></td>

							<td>Solution Description: </td><td><textarea name="cscprsolndesc" class="controltext" rows="3" readonly><?php echo $row['solution_brief'];?></textarea></td>

							<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" class="controltext" rows="3" readonly><?php echo $row['solution_features'];?></textarea></td>
						</tr>
						<tr>
							<td>Key Metric1: </td><td><select name="cscprmetric1" class="controltext" disabled>
							<option value="-1">--Select the Key Metric1--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_1'];
								$key_metrics1=mysql_query($sql);
								while($key_metric1 = mysql_fetch_array($key_metrics1))
								{
							?>
									<option value="<?php echo $key_metric1['meta_code'];?>" selected><?php echo $key_metric1['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric2: </td><td><select name="cscprmetric2" class="controltext" disabled>
							<option value="-1">--Select the Key Metric2--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_2'];
								$key_metrics2=mysql_query($sql);
								while($key_metric2 = mysql_fetch_array($key_metrics2))
								{
							?>
									<option value="<?php echo $key_metric2['meta_code'];?>" selected><?php echo $key_metric2['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric3: </td><td><select name="cscprmetric3" class="controltext" disabled>
							<option value="-1">--Select the Key Metric3--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_3'];
								$key_metrics3=mysql_query($sql);
								while($key_metric3 = mysql_fetch_array($key_metrics3))
								{
							?>
									<option value="<?php echo $key_metric3['meta_code'];?>" selected><?php echo $key_metric3['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
						</tr>
						<tr>
							<td>Key Metric1 Measure: </td><td><input type="text" name="cscprmetric1measure" class="controltext" value="<?php echo $row['key_metric_1_measure'];?>" readonly /></td>

							<td>Key Metric2 Measure: </td><td><input type="text" name="cscprmetric2measure" class="controltext" value="<?php echo $row['key_metric_2_measure'];?>" readonly /></td>

							<td>Key Metric3 Measure: </td><td><input type="text" name="cscprmetric3measure" class="controltext" value="<?php echo $row['key_metric_3_measure'];?>" readonly /></td>
						</tr>
						<tr>
							<td>Primary Metrics that matters: </td><td><select name="cscprkeymetric" class="controltext" disabled>
							<option value="-1">--Select the Primary Metrics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'primary_metric' and meta_code=".$row['primary_metrics_matters'];
								$primary_metrics=mysql_query($sql);
								while($primary_metric = mysql_fetch_array($primary_metrics))
								{
							?>
									<option value="<?php echo $primary_metric['meta_code'];?>" selected><?php echo $primary_metric['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Key Characteristics: </td><td><select name="cscprkeycharacteristics" class="controltext" disabled>
							<option value="-1">--Select the Key Characteristics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_characteristics' and meta_code=".$row['key_characteristics'];
								$key_characteristics=mysql_query($sql);
								while($key_characteristic = mysql_fetch_array($key_characteristics))
								{
							?>
									<option value="<?php echo $key_characteristic['meta_code'];?>" selected><?php echo $key_characteristic['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Channels: </td><td><!--<input type="text" name="cscprchannel" class="controltext" value="<?php echo $row['channels'];?>" readonly />-->
							<input type="radio" name="cscprchannel" class="controltext" disabled value="Yes" <?php if ($row['channels']=='Free') {?> checked <?php }?> > Free
							<input type="radio" name="cscprchannel" class="controltext" disabled value="No" <?php if ($row['channels']=='Paid') {?> checked <?php }?> > Paid
							</td>
							
						</tr>
						<tr>							
							<td>Cost Structure: </td><td><textarea name="cscprcoststruct" class="controltext" rows="3" readonly><?php echo $row['cost_structure'];?></textarea></td>

							<td>Revenue Stream: </td><td><textarea name="cscprrevstream" class="controltext" rows="3" readonly><?php echo $row['revenue_stream'];?></textarea></td>
					
							<td>Revenue Stream Assumptions: </td><td><textarea name="cscprrevstreamass" class="controltext" rows="3" readonly><?php echo $row['revenue_stream_assumptions'];?></textarea></td>
						</tr>
						<tr>						
							<td>Unfair Advantage: </td><td><!--<input type="text" name="cscprunfairadv" class="controltext" value="<?php echo $row['unfair_advantage'];?>" readonly />-->
							<input type="radio" name="cscprunfairadv" class="controltext" disabled value="Yes" <?php if ($row['unfair_advantage']=='Yes') {?> checked <?php }?> > Yes
							<input type="radio" name="cscprunfairadv" class="controltext" disabled value="No" <?php if ($row['unfair_advantage']=='No') {?> checked <?php }?> > No
							</td>
							
							<td>Funding Provided by Business: </td><td><!--<input type="text" name="cscprfund" class="controltext" value="<?php echo $row['funding_by_business'];?>" readonly />-->
							<input type="radio" name="cscprfund" class="controltext" disabled value="Yes" <?php if ($row['funding_by_business']=='Yes') {?> checked <?php }?> > Yes
							<input type="radio" name="cscprfund" class="controltext" disabled value="No" <?php if ($row['funding_by_business']=='No') {?> checked <?php }?> > No
							<input type="hidden" name="cscprfundhid" class="controltext" value="<?php echo $row['funding_by_business'];?>">
							</td>							

							<td>Document Link: </td><td><input type="hidden" name="fileupload" readonly value="<?php echo $row['document_link'];?>"><a href="<?php echo $row['document_link'];?>" border="0">View Document</a></td>
							<!--<td colspan="2" align="right"><input type="button" name="populatedemodata" value="Populate Demo Data" onclick="populatedata();">&nbsp;&nbsp;&nbsp;<input type="submit" name="prsubmit" Value="Submit" > &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='index.php'"></td>-->
						</tr>
						<tr>
							<td colspan="6"><hr width="100%"></td>
						</tr>
						<tr>
							<td colspan="4">Comments: &nbsp;&nbsp;&nbsp;<textarea name="cscprcomments" class="controltext" rows="3" cols="100"><?php echo $row['Comments'];?></textarea> </td>
							<td colspan="2"><input type="hidden" name="cscprreqno" class="controltext" value="<?php echo $row['request_num'];?>" /><input type="button" name="prcommentdetails" value="View All Comments" class="controltext" onclick="window.open('ViewAllComments.php?req_no='+<?php echo $req_no;?>,'_blank','toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=700, height=300');">&nbsp;&nbsp;
							<br/> <br/>
						</tr>
						<tr>
							<td colspan="6" align="right">
							<input type="submit" name="prapproved" class="controltext" value="Override with Proceed - Approved" >&nbsp;&nbsp;&nbsp;
							<input type="submit" name="prrejected" class="controltext" Value="Override with Decline - Rejected" > &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="prcancel" class="controltext" Value="Cancel" onclick="history.back();" >
							</td>
						</tr>
						</table>
						<?php
							}
						}
						?>
						
</form>

<?php
	}
include "footer.php";
?>