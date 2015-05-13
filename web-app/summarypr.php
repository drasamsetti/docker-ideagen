<?php
error_reporting(0);
//////////////////////////////////////////////////////////////////////////////////////////
//                                                                       	   			//
// NOTICE OF COPYRIGHT                                                   	   			//
//                                                                       	   			//
//                                                                       	   			//
//Copyright (C) 2010 onwards  Computer Sciences Corporation  http://www.csc.com    		//
//                                                                       	   			//
// This program is free software: you can redistribute it and/or modify  	   			//
// it under the terms of the GNU General Public License as published by  	   			//
// the Free Software Foundation, either version 3 of the License, or     	   			//
// (at your option) any later version.                                   	   			//
//                                                                                 		//
// This program is distributed in the hope that it will be useful,                 		//
// but WITHOUT ANY WARRANTY; without even the implied warranty of                  		//
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                   		//
// GNU General Public License for more details.                                    		//
//                                                                                 		//
//  You should have received a copy of the GNU General Public License              		//
//  along with this program.If not, see <http://www.gnu.org/licenses/>.            		//
//							                           									//
// @Created by Biswakalyana Mohanty                                                      //
// @date 2013-10-21                                                      	   			//
// @version 1.0								       										//
// @description:                             	    //
//                                                                              		//
//////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];
 $reviewer_type=$_SESSION['role'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}

/****Fetch the value from previous page and assign it into variable ***/

if(isset($_REQUEST['prconfirm']))
{

	$challenge_type=mysql_real_escape_string($_POST['cscprchallengetype']);
	$req_theme=mysql_real_escape_string($_POST['cscprreqtheme']);
	$business_funded=mysql_real_escape_string($_POST['cscprfund']);
	$bu_sponsor=mysql_real_escape_string($_POST['cscprbusponsor']);
	$overview=mysql_real_escape_string($_POST['cscproverview']);
	$prob_stat=mysql_real_escape_string($_POST['cscprprobstat']);
	$cust_seg=mysql_real_escape_string($_POST['cscprcustseg']);
	$uvp=mysql_real_escape_string($_POST['cscpruvp']);
	$soln_desc=mysql_real_escape_string($_POST['cscprsolndesc']);
	$soln_features=mysql_real_escape_string($_POST['cscprsolnfeatures']);
	$metric1=mysql_real_escape_string($_POST['cscprmetric1']);
	$metric2=mysql_real_escape_string($_POST['cscprmetric2']);
	$metric3=mysql_real_escape_string($_POST['cscprmetric3']);
	$metric1_measure=mysql_real_escape_string($_POST['cscprmetric1measure']);
	$metric2_measure=mysql_real_escape_string($_POST['cscprmetric2measure']);
	$metric3_measure=mysql_real_escape_string($_POST['cscprmetric3measure']);
	$key_metric=mysql_real_escape_string($_POST['cscprkeymetric']);
	$key_characteristics=mysql_real_escape_string($_POST['cscprkeycharacteristics']);
	$channel=mysql_real_escape_string($_POST['cscprchannel']);
	$cost_struct=mysql_real_escape_string($_POST['cscprcoststruct']);
	$rev_stream=mysql_real_escape_string($_POST['cscprrevstream']);
	$rev_stream_assess=mysql_real_escape_string($_POST['cscprrevstreamass']);
	$expt_name=mysql_real_escape_string($_POST['cscprexptname']);
	$region=mysql_real_escape_string($_POST['cscprregion']);
	
	$path=mysql_real_escape_string($_POST['fileupload']);
	$filename=explode('/',$path);
	//echo $filename[0] . "sec part ".$filename[1]. "<br/>";
	$target_path1;
	$upd_path;
	if($path!="")
	{
		$target_path1 = "files/";
		$upd_path = $target_path1.$filename[1];
		if(rename($path, $upd_path))
		{
			echo "Open Idea File Uploaded!!!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
/*
	if(!empty($_POST['cscprcoststruct'])) {
		$checked_count = count($_POST['cscprcoststruct']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprcoststruct'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($i!=0){
		$comma=",";
		}
		$cost_struct = $cost_struct . $comma . $selected;
		$i++;
		}
	}

	if(!empty($_POST['cscprrevstream'])) {
		$checked_count = count($_POST['cscprrevstream']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprrevstream'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($j!=0){
		$comma=",";
		}
		$rev_stream = $rev_stream . $comma . $selected;
		$j++;
		}
	}
	//$rev_stream=mysql_real_escape_string($_POST['cscprrevstream']);
	
	if(!empty($_POST['cscprrevstreamass'])) {
		$checked_count = count($_POST['cscprrevstreamass']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprrevstreamass'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($k!=0){
		$comma=",";
		}
		$rev_stream_assess = $rev_stream_assess . $comma . $selected;
		$k++;
		}
	}
	*/
	//$rev_stream_assess=mysql_real_escape_string($_POST['cscprrevstreamass']);
	$unfair_adv=mysql_real_escape_string($_POST['cscprunfairadv']);
	$email=$_SESSION['short_id']; //$_SESSION['login'];

$ideacat='ongoing';	
$sql = "INSERT INTO `csc_lr_experiment_req`(`request_theme`, `idea_category`, `document_link`, `expt_shortname`, `overview`, `problem_statement`, `customer_segment`, `unique_value_proposition`, `solution_brief`, `solution_features`, `key_metric_1`, `key_metric_1_measure`, `key_metric_2`, `key_metric_2_measure`, `key_metric_3`, `key_metric_3_measure`, `primary_metrics_matters`, `channels`, `cost_structure`, `revenue_stream`, `revenue_stream_assumptions`, `unfair_advantage`, `funding_by_business`, `bu_sponsor`, `key_characteristics`, `owner_email_id`, `experiment_current_snapshot`,`region_id`) VALUES ('$req_theme','$ideacat','$upd_path','$expt_name','$overview','$prob_stat','$cust_seg','$uvp','$soln_desc','$soln_features','$metric1','$metric1_measure','$metric2','$metric2_measure','$metric3','$metric3_measure','$key_metric','$channel','$cost_struct','$rev_stream','$rev_stream_assess','$unfair_adv','$business_funded','$bu_sponsor','$key_characteristics','$email','51','$region')";

//echo $sql;

mysql_query($sql);

$sqlreq = "select max(request_num) as req_no from `csc_lr_experiment_req`";
$req_nums = mysql_query($sqlreq);
$req_number;

while($reqt_num = mysql_fetch_array($req_nums))
{
	$req_number = $reqt_num['req_no'];
}

if ($business_funded=='Yes')
{
	$curr_status='61';
	$sqlupd1="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`='$req_number'";
	mysql_query($sqlupd1);
	$cmt='As BU Funded Yes, Ideas sent to Regional CTO for approval';
	$act='Approved as BU Funded is Yes';
	$sqlqry1="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_number','$reviewer_type','$email','$cmt','$act')";
	//echo $sqlqry1."<br/>";
	mysql_query($sqlqry1);
}
else
{
	$curr_status='71';
	$sqlupd2="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`='$req_number'";
	mysql_query($sqlupd2);
	$cmt='As BU Funded No, this Ideas has been forwarded to Ingenuity Worx for further review';
	$act='Rejected as BU Funded is No';
	$sqlqry2="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_number','$reviewer_type','$email','$cmt','$act')";
	//echo $sqlqry2."<br/>";
	mysql_query($sqlqry2);
	?>
	<script> alert ('As BU Funded No, this Ideas has been forwarded to Ingenuity Worx for further review');
	</script>
	<?php
}

print "<br/><br/>Ongoing Idea Added Successfully ";
print "<br/><br/>Notification will be sent (Work in Progress) ";

echo "<meta http-equiv='refresh' content='5;url=viewsubmittedideas.php'>";

}
else
{

	$challenge_type=mysql_real_escape_string($_POST['cscprchallengetype']);
	
	$req_theme=mysql_real_escape_string($_POST['cscprreqtheme']);

	$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' and meta_code = ".$req_theme;
	
	//echo $sql;
					$req_themes=mysql_query($sql);
					while($reqt_theme = mysql_fetch_array($req_themes))
					{
						$req_theme_name = $reqt_theme['meta_text'];
					}
	$business_funded=mysql_real_escape_string($_POST['cscprfund']);
	$bu_sponsor=mysql_real_escape_string($_POST['cscprbusponsor']);
	$overview=mysql_real_escape_string($_POST['cscproverview']);
	$prob_stat=mysql_real_escape_string($_POST['cscprprobstat']);
	$cust_seg=mysql_real_escape_string($_POST['cscprcustseg']);
	
	$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'customer_segment' and meta_code = ".$cust_seg;
					$cust_segs=mysql_query($sql);
					while($cus_segs = mysql_fetch_array($cust_segs))
					{
						$cus_segs_name = $cus_segs['meta_text'];
					}
	
	$uvp=mysql_real_escape_string($_POST['cscpruvp']);
	$soln_desc=mysql_real_escape_string($_POST['cscprsolndesc']);
	$soln_features=mysql_real_escape_string($_POST['cscprsolnfeatures']);
	$metric1=mysql_real_escape_string($_POST['cscprmetric1']);
	$metric2=mysql_real_escape_string($_POST['cscprmetric2']);
	$metric3=mysql_real_escape_string($_POST['cscprmetric3']);
	$metric1_measure=mysql_real_escape_string($_POST['cscprmetric1measure']);
	$metric2_measure=mysql_real_escape_string($_POST['cscprmetric2measure']);
	$metric3_measure=mysql_real_escape_string($_POST['cscprmetric3measure']);
	$key_metric=mysql_real_escape_string($_POST['cscprkeymetric']);
	$region=mysql_real_escape_string($_POST['cscprregion']);
	
	$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'primary_metric' and meta_code = ".$key_metric;
					$key_metrics=mysql_query($sql);
					while($key_met = mysql_fetch_array($key_metrics))
					{
						$key_met_name = $key_met['meta_text'];
					}
	
	$key_characteristics=mysql_real_escape_string($_POST['cscprkeycharacteristics']);
	
	$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_characteristics' and meta_code = ".$key_characteristics;
					$key_characteristic=mysql_query($sql);
					while($key_char = mysql_fetch_array($key_characteristic))
					{
						$key_char_name = $key_char['meta_text'];
					}
	
	$channel=mysql_real_escape_string($_POST['cscprchannel']);
	$expt_name=mysql_real_escape_string($_POST['cscprexptname']);
	$i=0;
	if(!empty($_POST['cscprcoststruct'])) {
		$checked_count = count($_POST['cscprcoststruct']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprcoststruct'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($i!=0){
		$comma=",";
		}
		$cost_struct = $cost_struct . $comma . $selected;
		$i++;
		}
	}
	$j=0;
	if(!empty($_POST['cscprrevstream'])) {
		$checked_count = count($_POST['cscprrevstream']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprrevstream'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($j!=0){
		$comma=",";
		}
		$rev_stream = $rev_stream . $comma . $selected;
		$j++;
		}
	}
	//$rev_stream=mysql_real_escape_string($_POST['cscprrevstream']);
	$k=0;
	if(!empty($_POST['cscprrevstreamass'])) {
		$checked_count = count($_POST['cscprrevstreamass']);
		//echo "Count of Cost ".$checked_count;
		$comma="";
		
		foreach($_POST['cscprrevstreamass'] as $selected) {
		//echo "<p>".$selected ."</p>";
		if ($k!=0){
		$comma=",";
		}
		$rev_stream_assess = $rev_stream_assess . $comma . $selected;
		$k++;
		}
	}
	//$rev_stream_assess=mysql_real_escape_string($_POST['cscprrevstreamass']);
	$unfair_adv=mysql_real_escape_string($_POST['cscprunfairadv']);
	$email=$_SESSION['short_id']; //$_SESSION['login'];

	$target_path;
	if($_FILES['uploadedfile']['name']!="")
	{
		$target_path = "temp/";
		$target_path = $target_path."WinningIdea_".$email."_".basename( $_FILES['uploadedfile']['name']);
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			echo "Open Idea File Uploaded!";
			//include "footer.php";
			//die;
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}	

?>
	<form ="SummaryForm" action="summarypr.php" method="POST" enctype="multipart/form-data" >
    <div id="pane">
        <div id="submenus">

        </div>
        <!--<div id="userid"><img src="<?php echo WEB_PATH; ?>/content/images/commonimages/access.png" height="15" width="15" style="border: none; padding-right: 5px; padding-top: 5px"/>
            <?php
            //$session = new Session();
            //$session->welcome();
            ?>
        </div>
        <hr />-->
        <!--<div class="bigContainer">-->

		<table border="0" width="90%" height="60%">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellpadding="2" cellspacing="2" >
			<tr>
				<td width="100%">
					<div class="laasasidediv">
					<table border="1" style="border-style:solid;border-width:1px;border-color:#6E6E6E;" width="100%" cellpadding="2" cellspacing="0">
						<tr>
							<td colspan="6"><h3>Proposal Request Summary</h3></td>
						</tr>
						<tr>
							<td colspan="2"><span class="cscprsummary">Challenge Type:</span> <div class="cscprtext"><input type="hidden" name="cscprchallengetype" value="<?php echo $challenge_type;?>"><?php echo $challenge_type;?></div></td>
							
							<td colspan="2"><span class="cscprsummary">Experiment Name:</span> <div class="cscprtext"><input type="hidden" name="cscprexptname" value="<?php echo $expt_name;?>"><?php echo $expt_name;?></div></td>

							<td colspan="2"><span class="cscprsummary">Key Characteristics: </span><div class="cscprtext"><input type="hidden" name="cscprkeycharacteristics" value="<?php echo $key_characteristics;?>"><?php echo $key_char_name; ?></div></td>
						</tr>
						<tr>
							<td colspan="2"><span class="cscprsummary">Idea Theme:</span> <div class="cscprtext"><input type="hidden" name="cscprreqtheme" value="<?php echo $req_theme;?>"><?php echo $req_theme_name;?></div></td>

							<td colspan="2"><span class="cscprsummary">Funding Provided by Business:</span> <div class="cscprtext"><input type="hidden" name="cscprfund" value="<?php echo $business_funded;?>"/><?php echo $business_funded; ?></div></td>

							<td colspan="2"><span class="cscprsummary">BU Sponsor:</span> <div class="cscprtext"><input type="hidden" name="cscprbusponsor" value="<?php echo $bu_sponsor;?>" /><?php echo $bu_sponsor; ?></div></td>
						</tr>
						<tr>
							<td rowspan="2"><span class="cscprsummary">Problem </span><br/> <div class="cscprtext"><input type="hidden" name="cscprprobstat" value="<?php echo $prob_stat;?>" /><?php echo $prob_stat; ?></div></td>

							<td ><span class="cscprsummary">Solution </span><br/> <div class="cscprtext"><input type="hidden" name="cscprsolndesc" value="<?php echo $soln_desc;?>" /><?php echo $soln_desc; ?></div></td>

							<td  rowspan="2"><span class="cscprsummary">Unique Value Proposition (UVP) </span><br/> <div class="cscprtext"><input type="hidden" name="cscpruvp" value="<?php echo $uvp;?>" /><?php echo $uvp; ?></div></td>
							
							<td ><span class="cscprsummary">Unfair Advantage </span><br/> <div class="cscprtext"><input type="hidden" name="cscprunfairadv" value="<?php echo $unfair_adv;?>" /> <?php echo $unfair_adv; ?></div></td>
							
							<td rowspan="2" colspan="2"><span class="cscprsummary">Customer Segment</span> <br/> <div class="cscprtext"><input type="hidden" name="cscprcustseg" value="<?php echo $cust_seg;?>" /><?php echo $cus_segs_name; ?></div></td>
						</tr>
						<tr>
							<td ><span class="cscprsummary">Key Metrics </span><br/> <div class="cscprtext"><input type="hidden" name="cscprkeymetric" value="<?php echo $key_metric;?>" /><?php echo $key_met_name; ?></div></td>

							<td ><span class="cscprsummary">Channels </span><br/> <div class="cscprtext"><input type="hidden" name="cscprchannel" value="<?php echo $channel;?>" /><?php echo $channel; ?></div></td>
						</tr>
						<tr>						
							<td colspan="3"><span class="cscprsummary">Cost Structure </span><br/> <div class="cscprtext"><input type="hidden" name="cscprcoststruct" value="<?php echo $cost_struct;?>" /><?php echo $cost_struct; ?></div></td>
							
							<td colspan="3"><span class="cscprsummary">Revenue Streams </span><br/> <div class="cscprtext"><input type="hidden" name="cscprrevstream" value="<?php echo $rev_stream;?>" /><?php echo $rev_stream; ?></div></td>
						</tr>
						<tr><td colspan="6" align="right"><input type="hidden" name="cscproverview" value="<?php echo $overview;?>" /><input type="hidden" name="cscprsolnfeatures" value="<?php echo $soln_features;?>" />
						<input type="hidden" name="cscprmetric1" value="<?php echo $metric1;?>" /><input type="hidden" name="cscprmetric2" value="<?php echo $metric2;?>" /><input type="hidden" name="cscprmetric3" value="<?php echo $metric3;?>" />
						<input type="hidden" name="cscprmetric1measure" value="<?php echo $metric1_measure;?>" /><input type="hidden" name="cscprmetric2measure" value="<?php echo $metric2_measure;?>" /><input type="hidden" name="cscprmetric3measure" value="<?php echo $metric3_measure;?>" />
						<input type="hidden" name="cscprregion" value="<?php echo $region;?>" /><input type="hidden" name="cscprrevstreamass" value="<?php echo $rev_stream_assess;?>" /><input type="hidden" name="fileupload" readonly value="<?php echo $target_path;?>">
						<input type="submit" name="prconfirm" id="prconfirm" Value="Confirm"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="javascript:history.back();"></td></tr>
					</table>
					</div>
					<br/>
				</td>
				</tr>
				
			</table>
		</td>
	</tr>
	</table>
	</form>
<br/><br/>
       <!-- </div>-->
	   
<?php
}
include "footer.php";
?>