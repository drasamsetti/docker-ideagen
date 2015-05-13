<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];

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


function checkform(form)
{
    if(form.name.value.length==0)
	{
	  	alert("Please enter the Theme Name");
	  	form.name.value="";
	  	form.name.focus();
	  	return false;
	}
	if(form.descp.value.length==0)
	{
	  	alert("Please enter the Theme Description");
	  	form.descp.value="";
	  	form.descp.focus();
	  	return false;
	}
	if(form.category.value=='0')
  	{
  		alert("Please select the Category");
  		form.category.value="";
  		form.category.focus();
  		return false;
  	}
  	if(form.exp_date.value.length==0)
	{
	  	alert("Please enter the Expiry Date in the format (yyyy-mm-dd)");
	  	form.exp_date.value="";
	  	form.exp_date.focus();
	  	return false;
	}



}

function populatedata()
{

//alert ('We are in Populate data');
//document.getElementById('cscprbusponsor').value="OCTO";
//myForm.cscprreqtheme.selectedIndex=2;
myForm.cscprbusponsor.value="OCTO";
//myForm.cscprfund.selectedIndex=1;
myForm.cscprfund.value="No";
//myForm.cscproverview.value="Project Overview in few words";
myForm.cscprprobstat.value="Problem Statement in few words";
myForm.cscprcustseg.selectedIndex=1;
myForm.cscpruvp.value="Unique Value prop of our project/expt";
//myForm.cscprsolndesc.value="Solution desc of our project";
myForm.cscprsolnfeatures.value="Solution features of our project";
myForm.cscprmetric1.selectedIndex=1;
myForm.cscprmetric2.selectedIndex=3;
myForm.cscprmetric3.selectedIndex=5;
myForm.cscprmetric1measure.value="KM1M";
myForm.cscprmetric2measure.value="KM2M";
myForm.cscprmetric3measure.value="KM3M";
myForm.cscprkeymetric.selectedIndex=2;
myForm.cscprkeycharacteristics.selectedIndex=4;
//myForm.cscprexptname.value="Demo Project Data";
//myForm.cscprchannel[1].checked=true;
//myForm.cscprunfairadv[0].checked=true;
myForm.cscprchannel.value="Paid";
myForm.cscprunfairadv.value="Yes";
//myForm.cscprcoststruct[1].checked=true;
//myForm.cscprcoststruct[3].checked=checked;
//myForm.cscprcoststruct[5].checked=true;
//myForm.cscprrevstream[2].checked=true;
//myForm.cscprrevstream[4].checked=true;
//myForm.cscprrevstreamass[1].checked=true;
//myForm.cscprrevstreamass[3].checked=true;
return true
}

function techreq()
{
	//alert ("Technical Requirement checked : "+myForm.cscprtechreq.value);
	if (myForm.cscprtechreq.value=="Yes")
		myForm.prrejected.disabled=true;
	else
		myForm.prapproved.disabled=true;
		
	return true
}

function validateForm()
{
	//alert ('In Valide form JS');
	if ((document.getElementById('cscprreqtheme').value == null) || (document.getElementById('cscprreqtheme').value == '-1'))
	{
		alert ('Please select idea theme');
		document.getElementById('cscprreqtheme').focus();
		return false
	}
	if ((document.getElementById('cscprexptname').value == ''))
	{
		alert ('Please enter experiment/project name');
		document.getElementById('cscprexptname').focus();
		return false
	}
	if ((document.getElementById('cscprbusponsor').value == ''))
	{
		alert ('Please enter BU Sponsor');
		document.getElementById('cscprbusponsor').focus();
		return false
	}
	if ((document.getElementById('cscproverview').value == ''))
	{
		alert ('Please enter Overview');
		document.getElementById('cscproverview').focus();
		return false
	}
	if ((document.getElementById('cscprprobstat').value == ''))
	{
		alert ('Please enter Problem statement');
		document.getElementById('cscprprobstat').focus();
		return false
	}
	/*if ((document.getElementById('cscprregion').value == null) || (document.getElementById('cscprregion').value == '-1'))
	{
		alert ('Please select Region');
		document.getElementById('cscprregion').focus();
		return false
	}*/
	if ((document.getElementById('cscpruvp').value == ''))
	{
		alert ('Please enter Unique Value Proposition');
		document.getElementById('cscpruvp').focus();
		return false
	}
	if ((document.getElementById('cscprsolndesc').value == ''))
	{
		alert ('Please enter Solution Descriptions');
		document.getElementById('cscprsolndesc').focus();
		return false
	}
	if ((document.getElementById('cscprsolnfeatures').value == ''))
	{
		alert ('Please enter Solution Features');
		document.getElementById('cscprsolnfeatures').focus();
		return false
	}
	if ((document.getElementById('cscprmetric1').value == null) || (document.getElementById('cscprmetric1').value == '-1'))
	{
		alert ('Please select Key Metric 1');
		document.getElementById('cscprmetric1').focus();
		return false
	}
	if ((document.getElementById('cscprmetric2').value == null) || (document.getElementById('cscprmetric2').value == '-1'))
	{
		alert ('Please select Key Metric 2');
		document.getElementById('cscprmetric2').focus();
		return false
	}
	if ((document.getElementById('cscprmetric3').value == null) || (document.getElementById('cscprmetric3').value == '-1'))
	{
		alert ('Please select Key Metric 3');
		document.getElementById('cscprmetric3').focus();
		return false
	}
	
	if ((document.getElementById('cscprmetric1measure').value == ''))
	{
		alert ('Please enter Measure for Key Metric 1');
		document.getElementById('cscprmetric1measure').focus();
		return false
	}
	if ((document.getElementById('cscprmetric2measure').value == ''))
	{
		alert ('Please enter Measure for Key Metric 2');
		document.getElementById('cscprmetric2measure').focus();
		return false
	}
	if ((document.getElementById('cscprmetric3measure').value == ''))
	{
		alert ('Please enter Measure for Key Metric 3');
		document.getElementById('cscprmetric3measure').focus();
		return false
	}
	if ((document.getElementById('cscprkeymetric').value == null) || (document.getElementById('cscprkeymetric').value == '-1'))
	{
		alert ('Please select Primary Metric');
		document.getElementById('cscprkeymetric').focus();
		return false
	}
	if ((document.getElementById('cscprkeycharacteristics').value == null) || (document.getElementById('cscprkeycharacteristics').value == '-1'))
	{
		alert ('Please select Key Characteristics');
		document.getElementById('cscprkeycharacteristics').focus();
		return false
	}
	if ((document.getElementById('cscprcustseg').value == null) || (document.getElementById('cscprcustseg').value == '-1'))
	{
		alert ('Please select Customer Segment');
		document.getElementById('cscprcustseg').focus();
		return false
	}
	
	var coststructitemsChecked = checkArray(myForm, "cscprcoststruct[]");
    //alert("You selected " + itemsChecked.length + " items");
    if (coststructitemsChecked.length == 0) {
      //alert("The items selected were:\n\t" + itemsChecked);
	  alert ('Please choose various Cost Structure');
	  document.getElementById('cscprcoststruct[]').focus();
	  return false;
    }
	
	var revstreamitemsChecked = checkArray(myForm, "cscprrevstream[]");
    //alert("You selected " + itemsChecked.length + " items");
    if (revstreamitemsChecked.length == 0) {
      //alert("The items selected were:\n\t" + itemsChecked);
	  alert ('Please choose various Revenue Stream');
	  document.getElementById('cscprrevstream[]').focus();
	  return false;
    }
	
	var revstreamassitemsChecked = checkArray(myForm, "cscprrevstreamass[]");
    //alert("You selected " + itemsChecked.length + " items");
    if (revstreamassitemsChecked.length == 0) {
      //alert("The items selected were:\n\t" + itemsChecked);
	  alert ('Please choose various Revenue Stream Assumptions');
	  document.getElementById('cscprrevstreamass[]').focus();
	  return false;
    }
    
	//alert (document.getElementById('cscprcoststruct[]').checked);
	//alert (document.myForm.cscprcoststruct[1].checked);
	
	/*if ((document.myForm.cscprcoststruct[1].checked == false) && (document.myForm.cscprcoststruct[2].checked == false) && (document.myForm.cscprcoststruct[3].checked == false) && (document.myForm.cscprcoststruct[4].checked == false) && (document.myForm.cscprcoststruct[5].checked == false))
	if (document.getElementById('cscprcoststruct[]').checked == false)
	{
		alert ('Please choose various Cost Structure');
		document.getElementById('cscprcoststruct[]').focus();
		return false
	}
	/*
	if ((document.myForm.cscprcoststruct[1].checked == false) && (document.myForm.cscprcoststruct[2].checked == false) && (document.myForm.cscprcoststruct[3].checked == false) && (document.myForm.cscprcoststruct[4].checked == false) && (document.myForm.cscprcoststruct[5].checked == false))
	{
		alert ('Please choose various Cost Structure');
		document.getElementById('cscprcoststruct').focus();
		return false
	}
	
	if ((document.myForm.cscprrevstream[1].checked == false) && (document.myForm.cscprrevstream[2].checked == false) && (document.myForm.cscprrevstream[3].checked == false) && (document.myForm.cscprrevstream[4].checked == false))
	{
		alert ('Please choose various Revenue Stream');
		document.getElementById('cscprrevstream').focus();
		return false
	}
	if ((document.myForm.cscprrevstreamass[1].checked == false) && (document.myForm.cscprrevstreamass[2].checked == false) && (document.myForm.cscprrevstreamass[3].checked == false) && (document.myForm.cscprrevstreamass[4].checked == false))
	{
		alert ('Please choose various Revenue Stream Assessment');
		document.getElementById('cscprrevstreamass').focus();
		return false
	}
	
	if ((document.myForm.cscprunfairadv.checked == false))
	{
		alert ('Please choose Unfair Advantage option');
		document.getElementById('cscprunfairadv').focus();
		return false
	}
	if ((document.myForm.cscprfund.checked == false))
	{
		alert ('Please choose BU Funded option');
		document.getElementById('cscprfund').focus();
		return false
	}
	if ((document.myForm.cscprchannel.checked == false))
	{
		alert ('Please choose Channel option');
		document.getElementById('cscprchannel').focus();
		return false
	}
	*/
	if(uaradioValue = checkRadio(myForm.cscprunfairadv)) {
      //alert("You selected " + radioValue);
      //return true;
    } else {
      alert ('Please choose Unfair Advantage option');
		document.getElementById('cscprunfairadv').focus();
		return false
    }
	
	if(buradioValue = checkRadio(myForm.cscprfund)) {
      //alert("You selected " + radioValue);
      //return true;
    } else {
      alert ('Please choose BU Funded option');
		document.getElementById('cscprfund').focus();
		return false
    }
	
	if(chradioValue = checkRadio(myForm.cscprchannel)) {
      //alert("You selected " + radioValue);
     // return true;
    } else {
      alert ('Please choose Channel option');
		document.getElementById('cscprchannel').focus();
		return false
    }
}

function checkRadio(field)
{
  for(var i=0; i < field.length; i++) {
    if(field[i].checked) return field[i].value;
  }
  return false;
}

function checkArray(form, arrayName)
{
  var retval = new Array();
  for(var i=0; i < form.elements.length; i++) {
    var el = form.elements[i];
    if(el.type == "checkbox" && el.name == arrayName && el.checked) {
      retval.push(el.value);
    }
  }
  return retval;
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

/*if(isset($_REQUEST['prconfirm']))
{



}
else
{		
*/		
?>

<form id="myForm" action="completecapturedidea-summarypr.php?req_no=<?php echo $req_no;?>" method="POST" onsubmit="return validateForm();">

<!--onsubmit="document.getElementById('prapproved').disabled=true;document.getElementById('prapproved').value='Submitting, please wait...';"-->

		<table border="0" width="90%" height="60%">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellpadding="2" cellspacing="2" >
			<tr><th class="theme-details-l">Update Idea Details</th></tr>
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
							<td>Idea Theme:<span style="color:red;">*</span></td>
							
							<td ><select name="cscprreqtheme" title="Select the Idea theme for your idea" id="cscprreqtheme" class="controltext" >
							<option value="-1">--Select the Idea Theme--</option>
							<?php 
								$themesql="select * from csc_lr_metadata where meta_name = 'CTO' and meta_type='request_theme'"; //and meta_code=".$row['request_theme'];
								$request_themes=mysql_query($themesql);
							
								//$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' ";
								//$request_themes=mysql_query($sql);
								while($request_theme = mysql_fetch_array($request_themes))
								{
							?>
									<option value="<?php echo $request_theme['meta_code'];?>" <?php if ($row['request_theme']==$request_theme['meta_code']) {?> selected <?php }?>><?php echo $request_theme['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Experiment/Project Name:<span style="color:red;">*</span></td><td ><input type="text" title="Enter the Experiment/Project Name" name="cscprexptname" id="cscprexptname" class="controltext" value="<?php echo $row['expt_shortname'];?>" /></td>

							<td>BU Sponsor:<span style="color:red;">*</span></td><td ><input type="text" title="Enter the BU Sponsor" name="cscprbusponsor" id="cscprbusponsor" class="controltext" value="<?php echo $row['bu_sponsor'];?>" /></td>
						</tr>
						<tr>
							<td>Overview:<span style="color:red;">*</span></td><td ><textarea title="Enter the Overview" name="cscproverview" id="cscproverview" rows="3" class="controltext" ><?php echo $row['overview'];?></textarea></td>

							<td>Problem Statement:<span style="color:red;">*</span></td><td ><textarea title="Enter the Problem Statement" name="cscprprobstat" id="cscprprobstat" class="controltext" rows="3" ><?php echo $row['problem_statement'];?></textarea></td>

							
						</tr>
						<tr>
							<td>Unique Value Proposition (UVP):<span style="color:red;">*</span></td><td><textarea title="Enter the Unique Value Proposition" name="cscpruvp" id="cscpruvp" class="controltext" rows="3" ><?php echo $row['unique_value_proposition'];?></textarea></td>

							<td>Solution Description:<span style="color:red;">*</span></td><td><textarea title="Enter the Solution Description" name="cscprsolndesc" id="cscprsolndesc" class="controltext" rows="3" ><?php echo $row['solution_brief'];?></textarea></td>

							<td>Solution Features:<span style="color:red;">*</span></td><td><textarea title="Enter the Solution Features" name="cscprsolnfeatures" id="cscprsolnfeatures" class="controltext" rows="3" ><?php echo $row['solution_features'];?></textarea></td>
						</tr>
						<tr>
							<td>Key Metric1:<span style="color:red;">*</span></td><td><select title="Select the Key Metric 1" name="cscprmetric1" id="cscprmetric1" class="controltext" >
							<option value="-1">--Select the Key Metric1--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics1=mysql_query($sql);
								while($key_metric1 = mysql_fetch_array($key_metrics1))
								{
							?>
									<option value="<?php echo $key_metric1['meta_code'];?>" <?php if ($row['key_metric_1']==$key_metric1['meta_code']) {?> selected <?php }?>><?php echo $key_metric1['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric2:<span style="color:red;">*</span></td><td><select title="Select the Key Metric 2" name="cscprmetric2" id="cscprmetric2" class="controltext" >
							<option value="-1">--Select the Key Metric2--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics2=mysql_query($sql);
								while($key_metric2 = mysql_fetch_array($key_metrics2))
								{
							?>
									<option value="<?php echo $key_metric2['meta_code'];?>" <?php if ($row['key_metric_2']==$key_metric2['meta_code']) {?> selected <?php }?>><?php echo $key_metric2['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric3:<span style="color:red;">*</span></td><td><select title="Select the Key Metric 3" name="cscprmetric3" id="cscprmetric3" class="controltext" >
							<option value="-1">--Select the Key Metric3--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics3=mysql_query($sql);
								while($key_metric3 = mysql_fetch_array($key_metrics3))
								{
							?>
									<option value="<?php echo $key_metric3['meta_code'];?>" <?php if ($row['key_metric_3']==$key_metric3['meta_code']) {?> selected <?php }?>><?php echo $key_metric3['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
						</tr>
						<tr>
							<td>Key Metric1 Measure:<span style="color:red;">*</span></td><td><input type="text" title="Enter the Key Metric 1 Measure" name="cscprmetric1measure" id="cscprmetric1measure" class="controltext" value="<?php echo $row['key_metric_1_measure'];?>"  /></td>

							<td>Key Metric2 Measure:<span style="color:red;">*</span></td><td><input type="text" title="Enter the Key Metric 2 Measure" name="cscprmetric2measure" id="cscprmetric2measure" class="controltext" value="<?php echo $row['key_metric_2_measure'];?>"  /></td>

							<td>Key Metric3 Measure:<span style="color:red;">*</span></td><td><input type="text" title="Enter the Key Metric 3 Measure" name="cscprmetric3measure" id="cscprmetric3measure" class="controltext" value="<?php echo $row['key_metric_3_measure'];?>"  /></td>
						</tr>
						<tr>
							<td>Primary Metrics that matters:<span style="color:red;">*</span></td><td><select title="Select the Primary Metric that matters" name="cscprkeymetric" id="cscprkeymetric" class="controltext" >
							<option value="-1">--Select the Primary Metrics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'primary_metric' ";
								$primary_metrics=mysql_query($sql);
								while($primary_metric = mysql_fetch_array($primary_metrics))
								{
							?>
									<option value="<?php echo $primary_metric['meta_code'];?>" <?php if ($row['primary_metrics_matters']==$primary_metric['meta_code']) {?> selected <?php }?>><?php echo $primary_metric['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Key Characteristics:<span style="color:red;">*</span></td><td><select title="Select the Key Characteristics" name="cscprkeycharacteristics" id="cscprkeycharacteristics" class="controltext" >
							<option value="-1">--Select the Key Characteristics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_characteristics' ";
								$key_characteristics=mysql_query($sql);
								while($key_characteristic = mysql_fetch_array($key_characteristics))
								{
							?>
									<option value="<?php echo $key_characteristic['meta_code'];?>" <?php if ($row['key_characteristics']==$key_characteristic['meta_code']) {?> selected <?php }?>><?php echo $key_characteristic['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Customer Segment:<span style="color:red;">*</span></td><td ><select title="Select the Customer Segment" name="cscprcustseg" id="cscprcustseg" class="controltext" >
							<option value="-1">--Select the Customer Segment--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'customer_segment' ";
								$customer_segments=mysql_query($sql);
								while($customer_segment = mysql_fetch_array($customer_segments))
								{
							?>
									<option value="<?php echo $customer_segment['meta_code'];?>" <?php if ($row['customer_segment']==$customer_segment['meta_code']) {?> selected <?php }?>><?php echo $customer_segment['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							<!--<td>Channels: </td><td><input type="radio" name="cscprchannel" class="controltext" value="Free"/> Free <br/><input type="radio" name="cscprchannel" class="controltext" value="Paid"/> Paid</td>-->
							
						</tr>
						<!--<tr>							
							<td>Cost Structure: </td><td><textarea name="cscprcoststruct" class="controltext" rows="3" ><?php echo $row['cost_structure'];?></textarea></td>

							<td>Revenue Stream: </td><td><textarea name="cscprrevstream" class="controltext" rows="3" ><?php echo $row['revenue_stream'];?></textarea></td>
					
							<td>Revenue Stream Assumptions: </td><td><textarea name="cscprrevstreamass" class="controltext" rows="3" ><?php echo $row['revenue_stream_assumptions'];?></textarea></td>
						</tr>-->
						<tr>							
							<td>Cost Structure:<span style="color:red;">*</span></td><td><input type="checkbox" title="Choose the Cost Structures" name="cscprcoststruct[]" id="cscprcoststruct[]" class="controltext" value="Customer Acquisition Cost"/> Customer Acquisition Cost <br/><input type="checkbox" name="cscprcoststruct[]"  class="controltext" value="Distribution Cost"/> Distribution Cost <br/><input type="checkbox" name="cscprcoststruct[]"  class="controltext" value="Hosting"/> Hosting<br/><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="People"/> People<br/><input type="checkbox" name="cscprcoststruct[]"  class="controltext" value="Other Cost"/> Other Cost</td>

							<td>Revenue Stream:<span style="color:red;">*</span></td><td><input type="checkbox" title="Choose the Revenue Streams" name="cscprrevstream[]" id="cscprrevstream[]" class="controltext" value="Subscription"/> Subscription <br/><input type="checkbox" name="cscprrevstream[]"  class="controltext" value="Ads"/> Ads <br/><input type="checkbox" name="cscprrevstream[]" class="controltext" value="Freemium"/> Freemium<br/><input type="checkbox" name="cscprrevstream[]"  class="controltext" value="Others"/> Others</td>
					
							<td>Revenue Stream Assumptions:<span style="color:red;">*</span></td><td><input type="checkbox" title="Choose the Revenue Stream Assumptions" name="cscprrevstreamass[]" id="cscprrevstreamass[]" class="controltext" value="Life Time Value"/> Life Time Value <br/><input type="checkbox" name="cscprrevstreamass[]"  class="controltext" value="Gross Margin"/> Gross Margin <br/><input type="checkbox" name="cscprrevstreamass[]"  class="controltext" value="Break-Even Point"/> Break-Even Point<br/><input type="checkbox" name="cscprrevstreamass[]"  class="controltext" value="Others"/> Others</td>
						</tr>
						<tr>						
							<td>Unfair Advantage:<span style="color:red;">*</span></td><td><!--<input type="text" name="cscprunfairadv" class="controltext" value="<?php echo $row['unfair_advantage'];?>" readonly />-->
							<input type="radio" title="Select the Unfair Advantage option" name="cscprunfairadv" id="cscprunfairadv" class="controltext"  value="Yes" <?php if ($row['unfair_advantage']=='Yes') {?> checked <?php }?> > Yes
							<br/><input type="radio" name="cscprunfairadv"  class="controltext"  value="No" <?php if ($row['unfair_advantage']=='No') {?> checked <?php }?> > No
							</td>
							
							<td>Funding Provided by Business:<span style="color:red;">*</span></td><td><!--<input type="text" name="cscprfund" class="controltext" value="<?php echo $row['funding_by_business'];?>" readonly />-->
							<input type="radio" title="Select the BU Funded option" name="cscprfund" id="cscprfund" class="controltext"  value="Yes" <?php if ($row['funding_by_business']=='Yes') {?> checked <?php }?> > Yes
							<br/><input type="radio" name="cscprfund"  class="controltext"  value="No" <?php if ($row['funding_by_business']=='No') {?> checked <?php }?> > No
							<input type="hidden" name="cscprfundhid" class="controltext" value="<?php echo $row['funding_by_business'];?>">
							</td>						
							<!--<td>Unfair Advantage: </td><td><input type="radio" name="cscprunfairadv" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprunfairadv" class="controltext" value="No"/> No</td>

							<td>Funding Provided by Business: </td><td><input type="radio" name="cscprfund" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprfund" class="controltext" value="No"/> No</td>-->

							<td>Channels:<span style="color:red;">*</span></td><td><!--<input type="text" name="cscprchannel" class="controltext" value="<?php echo $row['channels'];?>" readonly />-->
							<input type="radio" title="Select the Channel option" name="cscprchannel" id="cscprchannel" class="controltext"  value="Free" <?php if ($row['channels']=='Free') {?> checked <?php }?> > Free
							<br/><input type="radio" name="cscprchannel"  class="controltext"  value="Paid" <?php if ($row['channels']=='Paid') {?> checked <?php }?> > Paid
							</td>
							<!--<td colspan="2" align="right"><!--<input type="button" name="populatedemodata" value="Populate Demo Data" onclick="populatedata();">&nbsp;&nbsp;&nbsp;<input type="submit" name="prsubmit" Value="Submit" > &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='index.php'"></td>-->
						</tr>
						<tr>
							<td colspan="6"><hr width="100%"></td>
						</tr>
						<tr>
							<?php
							/*if ($row['experiment_current_snapshot']!='111')
							{
								if ($row['experiment_current_snapshot']!='211')
								{
									if ($row['experiment_current_snapshot']!='411') 
									{
										if ($row['experiment_current_snapshot']!='451')
										{
											if ($row['experiment_current_snapshot']!='731')
											{
							//echo " Inside not Eq. 111,211, etc status <br/>";
							*/
							?>
							<td colspan="4">Comments: &nbsp;&nbsp;&nbsp;<textarea name="cscprcomments" id="cscprcomments" class="controltext" rows="3" cols="100"><?php echo $row['Comments'];?></textarea> </td>
							<?php
								/*			}
											else
											{
							?>
							<td colspan="4">Comments: &nbsp;&nbsp;&nbsp;<textarea name="cscprcomments" readonly class="controltext" rows="3" cols="100"><?php echo $row['Comments'];?></textarea> </textarea></td>								
							<?php										
											}
										}
									}
								}
							}
							*/
							?>	
							<td colspan="2" align="right"><input type="hidden" name="cscprreqno" class="controltext" value="<?php echo $row['request_num'];?>" />
							<br/> <br/>
							<?php
							/*if ($_SESSION['role']!='4')
							{
							//echo " Inside not Eq. 4 role <br/>";
							if (($_SESSION['role']=='5') || ($_SESSION['role']=='8'))
							{
							//echo " Inside Eq. 5 or 8 role <br/>";
							if ($row['experiment_current_snapshot']!='731')
							{
							?>
							<input type="submit" name="prapproved" id="prapproved" class="controltext" value="<?php if ($row['experiment_current_snapshot']=='300') echo 'Pick Idea for POC Plan'; elseif ($row['experiment_current_snapshot']=='311') echo 'Submit POC Plan for TDC'; else echo 'Update Status'; ?>" >
							<?php
							}
							}
							elseif ($_SESSION['role']=='7')
							{
							//echo " Inside Eq. 7 role <br/>";
								if ($row['experiment_current_snapshot']=='400')
								{
							?>
							Technical Agreement : <input type="radio" name="cscprtechreq" class="controltext" value="Yes" onclick="techreq();" > Yes <input type="radio" name="cscprtechreq" class="controltext" value="No" onclick="techreq();" > No &nbsp;&nbsp;<br/>
								<?php
								}
								//if (($row['experiment_current_snapshot']!='111') || ($row['experiment_current_snapshot']!='211') || ($row['experiment_current_snapshot']!='411') || ($row['experiment_current_snapshot']!='451'))
								if ($row['experiment_current_snapshot']!='411') 
								{
								if ($row['experiment_current_snapshot']!='451')
								{
								//echo " Inside not Eq. 111, etc status <br/>";
								?>
							<br/><input type="submit" name="prapproved" class="controltext" value="Approved" >&nbsp;&nbsp;&nbsp;
							<input type="submit" name="prrejected" class="controltext" Value="Rejected" > &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" name="pronhold" class="controltext" Value="On Hold" >
							<?php 
								}
								}
							}
							else
							{
							//if ((mysql_real_escape_string($row['experiment_current_snapshot'])<>'111') || (mysql_real_escape_string($row['experiment_current_snapshot'])<>'211') || (mysql_real_escape_string($row['experiment_current_snapshot'])<>'411') || (mysql_real_escape_string($row['experiment_current_snapshot'])<>'451'))
							if ($row['experiment_current_snapshot']!='111')
							{
							if ($row['experiment_current_snapshot']!='211')
							{
							//echo " Inside not Eq. 111,211, etc status <br/>";
							?>
							<input type="submit" name="prapproved" class="controltext" value="Approved" >&nbsp;&nbsp;&nbsp;
							<input type="submit" name="prrejected" class="controltext" Value="Rejected" > &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" name="pronhold" class="controltext" Value="On Hold" >
							<?php
							}
							}
							}
							}
							//echo "Status :".$row['experiment_current_snapshot'];
							*/
							?>
							<input type="submit" name="prsubmit" id="prsubmit" class="controltext" Value="Submit and Move to IRB Template Upload"> <br/><br/>
							<input type="button" name="prcommentdetails" value="View All Comments" class="controltext" onclick="window.open('ViewAllComments.php?req_no='+<?php echo $req_no;?>,'_blank','toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=700, height=300');">&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" class="controltext" onclick="javascript:history.back();">
							<br/><br/>
							<input type="button" name="populatedemodata" class="controltext" value="Populate Demo Data" onclick="populatedata();">
							<br/><br/><span style="color:red;">* Mandatory fields</span></td>
						</tr>
						</table>
						</div>
						<div class="hide" id="agenda">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>						
							<td>Question 1: </td><td><input type="text" name="cscpragendaans1" /></td>
						</tr>
						<tr>						
							<td>Question 2: </td><td><input type="text" name="cscpragendaans2" /></td>
						</tr>
						<tr>						
							<td>Question 3: </td><td><input type="text" name="cscpragendaans3" /></td>
						</tr>
						<tr>						
							<td>Question 4: </td><td><input type="text" name="cscpragendaans4" /></td>
						</tr>
						<tr>						
							<td>Question 5: </td><td><input type="text" name="cscpragendaans5" /></td>
						</tr>
						<tr>						
							<td colspan="2" align="right"><input type="button" name="prsubmit" Value="Submit" onclick="self.location='?load=index/summary'"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='?load=index/home'"></td>
						</tr>
						</table>
						</div>
						<div class="hide" id="paper">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td>Paper theme: </td>
							<td><select name="papertheme">
								<option value="-1">--Select Paper Theme--</option>
								<option value="1">Paper Theme 1</option>
								<option value="2">Paper Theme 2 </option>
								</select></td>
						</tr>
						<tr>
							<td>Upload Paper: </td>
							<td><input type="file" name="fileToUpload" id="fileToUpload">
								<input type="submit" value="Upload Paper" name="submit"></td>
						</tr>
						<tr>						
							<td colspan="2" align="right"><input type="button" name="prsubmit" Value="Submit" onclick="self.location='?load=index/summary'"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='?load=index/home'"></td>
						</tr>
						</table>
						</div>
					</table>
					<?php
						}
					}					
					?>
					</div>
					<br/>
				</td>&nbsp;&nbsp;&nbsp;
				</tr>
			</table>
		</td>
	</tr>
	</table>
	</form>

<?php
//}
include "footer.php";
?>