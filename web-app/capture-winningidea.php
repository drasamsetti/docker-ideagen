<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
?>
<script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
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
myForm.cscprreqtheme.selectedIndex=2;
myForm.cscprbusponsor.value="OCTO";
//myForm.cscprfund.selectedIndex=1;
myForm.cscprfund.value="Yes";
myForm.cscproverview.value="Experiment Overview in few words";
myForm.cscprprobstat.value="Problem Statement in few words";
myForm.cscprcustseg.selectedIndex=1;
myForm.cscpruvp.value="Unique Value Proposition of our experiment";
myForm.cscprsolndesc.value="Solution description of our experiment";
myForm.cscprsolnfeatures.value="Solution features of our experiment";
myForm.cscprmetric1.selectedIndex=1;
myForm.cscprmetric2.selectedIndex=3;
myForm.cscprmetric3.selectedIndex=5;
myForm.cscprmetric1measure.value="KM1M";
myForm.cscprmetric2measure.value="KM2M";
myForm.cscprmetric3measure.value="KM3M";
myForm.cscprkeymetric.selectedIndex=2;
myForm.cscprkeycharacteristics.selectedIndex=4;
myForm.cscprexptname.value="Demo Experiment Data";
//myForm.cscprchannel[1].checked=true;
//myForm.cscprunfairadv[0].checked=true;
myForm.cscprchannel.value="Paid";
myForm.cscprunfairadv.value="Yes";
myForm.cscprcoststruct[1].checked=true;
//myForm.cscprcoststruct[3].checked=checked;
//myForm.cscprcoststruct[5].checked=true;
myForm.cscprrevstream[2].checked=true;
//myForm.cscprrevstream[4].checked=true;
myForm.cscprrevstreamass[1].checked=true;
//myForm.cscprrevstreamass[3].checked=true;
return true
}

function fnfilltmdetail()
{
	var name = myForm.cscprteamleader.value;
	document.getElementById('box1').value = name;
	//alert ('Inside Fill in fn'+name);
	return true
}

function fnfilltmsdetail()
{
	var shortid = myForm.cscprteamleadershortid.value;
	//alert ('Inside Fill tms in fn'+shortid);
	var pos = shortid.search("@csc.com");
	
	if (pos=="-1")
	{	
		alert ('Please provide Valid CSC emailid');
		//myForm.cscprteamleadershortid.focus();
		return false
	}
	else
	{
	document.getElementById('boxess1').value = shortid;
	}
	return true
}

function fnchkshortid(cnt)
{
	var shortid = document.getElementById('boxess'+cnt).value;
	
	var pos = shortid.search("@csc.com");
	
	if (pos=="-1")
	{	
		alert ('Please provide Valid CSC emailid');
		//document.getElementById('boxess'+cnt).focus();
		return false
	}
}

function validateForm() {
	//alert ('Inside JS');
    var ideatheme = document.getElementById('cscprreqtheme').value;
	var ideasub = document.getElementById('cscprsubject').value;
	var ideadesc = document.getElementById('cscprideadesc').value;
	//var ideapursue = document.getElementById('cscpursueidea').checked;
	var ideatl = document.getElementById('cscprteamleader').value;
	var ideatlshortid= document.getElementById('cscprteamleadershortid').value;
	//alert ('X Value ');
	//alert (ideapursue);
    if (ideatheme == null || ideatheme == "-1") {
        alert("Winning Idea theme must be selected");
		document.getElementById('cscprreqtheme').focus();
        return false;
    }
	if (ideasub == "")
	{
		alert("Winning Idea Subject must be entered");
		document.getElementById('cscprsubject').focus();
        return false;
	}
	if (ideadesc == "")
	{
		alert("Winning Idea Description must be entered");
		document.getElementById('cscprideadesc').focus();
        return false;
	}
	/*if ((document.getElementById('cscpursueidea')[0].checked == false) && (document.getElementById('cscpursueidea')[1].checked == false))
	{
		alert("Please select an option, whether to pursue the Idea Immediately or not");
		document.getElementById('cscpursueidea').focus();
        return false;
	}
	else 
	{
		if (document.getElementById('cscpursueidea')[1].checked == true)
		{
		var x = confirm('Are you sure to pursue the Idea later ?');
			if (x=="No")
			{
			alert ("Please select the 'Yes' Option to pursue the idea immediately");
			document.getElementById('cscpursueidea').focus();
			return false;
			}
		}
	}*/
	//alert (document.myForm.cscpursueidea[1].checked);
	if (document.myForm.cscpursueidea[1].checked == true)
		{
		var x = confirm('Are you sure to pursue the Idea later ?');
		//alert(x);
			if (x==false)
			{
			alert ("Please select the 'Yes' Option to pursue the idea immediately");
			document.getElementById('cscpursueidea').focus();
			return false;
			}
		}
	if (ideatl == "")
	{
		alert("Please enter the Team Leader Name");
		document.getElementById('cscprteamleader').focus();
        return false;
	}
	if (ideatlshortid == "")
	{
		alert("Please enter the Team Leader ShortID");
		document.getElementById('cscprteamleadershortid').focus();
        return false;
	}
	
}

// jQuery plugin to prevent double submission of forms
jQuery.fn.preventDoubleSubmission = function() {
  $(this).on('submit',function(e){
    var $form = $(this);

    if ($form.data('submitted') === true) {
      // Previously submitted - don't submit again
      e.preventDefault();
    } else {
      // Mark it so that the next submit can be ignored
      $form.data('submitted', true);
    }
  });

  // Keep chainability
  return this;
};

function btndisable()
{

//alert ('In JS');
myForm.prsubmit.disable=true;
myForm.submit();
return true
}

</script>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        if( 5 < n ) {
            alert('You can have 1 Team Leader and 4 Team members in this group');
            return false;
        }
        var box_html = $('<p class="text-box"><label for="box' + n + '">Team Member <span class="box-number">' + n + '</span></label> <input type="text" name="boxes[]" value="" id="box' + n + '" title="Provide Member Name" /> <label for="box1">Email ID </label> <input type="text" name="boxess[]" value="" id="boxess' + n + '" title="Provide Member CSC ShortID" onblur="fnchkshortid(' + n +');" /> <a href="#" class="remove-box">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>
<style>
.hide{
display:none;
}
.show{
display:block;
}
</style>

<form id="myForm" name="myForm" action="capture-summarypr.php" onsubmit="return validateForm();" method="POST" enctype="multipart/form-data" >
<!--onsubmit="document.getElementById('prsubmit').disabled=true;
document.getElementById('prsubmit').value='Submitting, please wait...';"-->

		<table border="0" width="90%" height="60%">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellpadding="2" cellspacing="2" >
			<tr><th class="theme-details-l">Capture Winning Idea</th></tr>
			<tr>
				<td width="100%">
					<div class="laasasidediv">
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
						<input type="hidden" name="cscprchallengetype" value="ideachallenge" class="controltext">
						<div class="show" id="ongoing">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td>Winning Idea Theme:<span style="color:red;">*</span></td>
							
							<td><select title="Select the Winning Idea Theme" id="cscprreqtheme" name="cscprreqtheme" class="controltext" >
							<option value="-1">--Select Idea Theme--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' ";
								$request_themes=mysql_query($sql);
								while($request_theme = mysql_fetch_array($request_themes))
								{
							?>
									<option value="<?php echo $request_theme['meta_code'];?>" ><?php echo $request_theme['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<!--<td>Experiment/Project Name: </td><td><input type="text" name="cscprexptname" class="controltext" /></td>
							
							<td>BU Sponsor: </td><td><input type="text" name="cscprbusponsor" class="controltext" /></td>-->
						</tr>
						<tr>
							<td>Idea Subject:<span style="color:red;">*</span></td><td><textarea title="Enter the Idea Subject" id="cscprsubject" name="cscprsubject" rows="3" cols="100" class="controltext" ></textarea></td>

							<!--<td>Problem Statement: </td><td><textarea name="cscprprobstat" rows="3" class="controltext"></textarea></td>

							<td>Customer Segment: </td><td><select name="cscprcustseg" class="controltext">
							<option value="-1">--Select Customer Segment--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'customer_segment' ";
								$customer_segments=mysql_query($sql);
								while($customer_segment = mysql_fetch_array($customer_segments))
								{
							?>
									<option value="<?php echo $customer_segment['meta_code'];?>" ><?php echo $customer_segment['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>-->
						</tr>
						<tr>
							<!--<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" rows="3" class="controltext"></textarea></td>-->

							<td>Idea Description:<span style="color:red;">*</span></td><td><textarea title="Enter the Idea Description" id="cscprideadesc" name="cscprideadesc" rows="3" cols="100" class="controltext"></textarea></td>

							<!--<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" rows="3" class="controltext"></textarea></td>-->
						</tr>
						<!--<tr>
							<td>Key Metric1: </td><td><select name="cscprmetric1" class="controltext">
							<option value="-1">--Select Key Metric1--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics1=mysql_query($sql);
								while($key_metric1 = mysql_fetch_array($key_metrics1))
								{
							?>
									<option value="<?php echo $key_metric1['meta_code'];?>" ><?php echo $key_metric1['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Key Metric2: </td><td><select name="cscprmetric2" class="controltext">
							<option value="-1">--Select Key Metric2--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics2=mysql_query($sql);
								while($key_metric2 = mysql_fetch_array($key_metrics2))
								{
							?>
									<option value="<?php echo $key_metric2['meta_code'];?>" ><?php echo $key_metric2['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Key Metric3: </td><td><select name="cscprmetric3" class="controltext">
							<option value="-1">--Select Key Metric3--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' ";
								$key_metrics3=mysql_query($sql);
								while($key_metric3 = mysql_fetch_array($key_metrics3))
								{
							?>
									<option value="<?php echo $key_metric3['meta_code'];?>" ><?php echo $key_metric3['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>
						</tr>
						<tr>
							<td>Key Metric1 Measure: </td><td><input type="text" name="cscprmetric1measure" class="controltext"/></td>

							<td>Key Metric2 Measure: </td><td><input type="text" name="cscprmetric2measure" class="controltext"/></td>

							<td>Key Metric3 Measure: </td><td><input type="text" name="cscprmetric3measure" class="controltext"/></td>
						</tr>
						<tr>
							<td>Primary Metrics that matters: </td><td><select name="cscprkeymetric" class="controltext">
							<option value="-1">--Select Primary Metrics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'primary_metric' ";
								$primary_metrics=mysql_query($sql);
								while($primary_metric = mysql_fetch_array($primary_metrics))
								{
							?>
									<option value="<?php echo $primary_metric['meta_code'];?>" ><?php echo $primary_metric['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Key Characteristics: </td><td><select name="cscprkeycharacteristics" class="controltext">
							<option value="-1">--Select Key Characteristics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_characteristics' ";
								$key_characteristics=mysql_query($sql);
								while($key_characteristic = mysql_fetch_array($key_characteristics))
								{
							?>
									<option value="<?php echo $key_characteristic['meta_code'];?>" ><?php echo $key_characteristic['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Channels: </td><td><input type="radio" name="cscprchannel" class="controltext" value="Free"/> Free <br/><input type="radio" name="cscprchannel" class="controltext" value="Paid"/> Paid</td>
						</tr>
						<tr>							
							<td>Cost Structure: </td><td><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="Customer Acquisition Cost"/> Customer Acquisition Cost <br/><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="Distribution Cost"/> Distribution Cost <br/><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="Hosting"/> Hosting<br/><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="People"/> People<br/><input type="checkbox" name="cscprcoststruct[]" class="controltext" value="Other Cost"/> Other Cost</td>

							<td>Revenue Stream: </td><td><input type="checkbox" name="cscprrevstream[]" class="controltext" value="Subscription"/> Subscription <br/><input type="checkbox" name="cscprrevstream[]" class="controltext" value="Ads"/> Ads <br/><input type="checkbox" name="cscprrevstream[]" class="controltext" value="Freemium"/> Freemium<br/><input type="checkbox" name="cscprrevstream[]" class="controltext" value="Others"/> Others</td>
					
							<td>Revenue Stream Assumptions: </td><td><input type="checkbox" name="cscprrevstreamass[]" class="controltext" value="Life Time Value"/> Life Time Value <br/><input type="checkbox" name="cscprrevstreamass[]" class="controltext" value="Gross Margin"/> Gross Margin <br/><input type="checkbox" name="cscprrevstreamass[]" class="controltext" value="Break-Even Point"/> Break-Even Point<br/><input type="checkbox" name="cscprrevstreamass[]" class="controltext" value="Others"/> Others</td>
						</tr>
						<tr>						
							<td>Unfair Advantage: </td><td><input type="radio" name="cscprunfairadv" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprunfairadv" class="controltext" value="No"/> No</td>

							<td>Funding Provided by Business: </td><td><input type="radio" name="cscprfund" class="controltext" value="Yes"/> Yes <br/><input type="radio" name="cscprfund" class="controltext" value="No"/> No</td>

							<td colspan="2" align="right"><input type="button" name="populatedemodata" class="controltext" value="Populate Demo Data" onclick="populatedata();">&nbsp;&nbsp;<input type="submit" name="prsubmit" id="prsubmit" class="controltext" Value="Submit" > &nbsp;&nbsp;<input type="button" name="prcancel" class="controltext" Value="Cancel" onclick="self.location='index.php'"><br/><br/><input type="button" name="prupload" class="controltext" Value="Upload Documents" /></td>
						</tr>-->
						<tr>
						
							<td>Pursue Idea Immediately ?<span style="color:red;">*</span></td><td><input type="radio" title="Choose relevant option, either to Pursue the idea immediatly or not" id="cscpursueidea" name="cscpursueidea" class="controltext" value="Yes"/> Yes <br/><input type="radio" id="cscpursueidea" name="cscpursueidea" checked class="controltext" value="No"/> No</td>
							
						</tr>	
						<tr>
							<!--<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" rows="3" class="controltext"></textarea></td>-->

							<td>Team Leader:<span style="color:red;">*</span></td><td><input type="text" title="Enter the Team Leader Name" id="cscprteamleader" name="cscprteamleader" class="controltext" value="<?php //echo $_SESSION['name'];?>" onblur="fnfilltmdetail();" /></td>

							<!--<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" rows="3" class="controltext"></textarea></td>-->
						</tr>
						
						<tr>
							<!--<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" rows="3" class="controltext"></textarea></td>-->

							<td>Team Leader EmailID:<span style="color:red;">*</span></td><td><input type="text" title="Enter Team Leader CSC Email ID" id="cscprteamleadershortid" name="cscprteamleadershortid" class="controltext" value="<?php //echo $_SESSION['short_id'];?>" onblur="fnfilltmsdetail();" /></td>

							<!--<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" rows="3" class="controltext"></textarea></td>-->
						</tr>
						
						<tr>
							<!--<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" rows="3" class="controltext"></textarea></td>-->

							<td>Document Upload: </td><td><input name="uploadedfile" type="file" title="Please upload relevant document, if any" class="controltext"> <!--<i>Please upload File Less than 2 MB</i>--></td>

							<!--<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" rows="3" class="controltext"></textarea></td>-->
						</tr>
						<!--<tr>
							<td colspan="2" align="right"><!--<input type="button" name="populatedemodata" class="controltext" value="Populate Demo Data" onclick="populatedata();">&nbsp;&nbsp;<input type="submit" name="prsubmit" id="prsubmit" class="controltext" Value="Submit" > &nbsp;&nbsp;<input type="button" name="prcancel" class="controltext" Value="Cancel" onclick="self.location='index.php'"></td>
						</tr>-->
						</table>
						<br/>
						
							<!--<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" rows="3" class="controltext"></textarea></td>

							<td>Idea Description: </td><td><textarea name="cscprsolndesc" rows="3" class="controltext"></textarea></td>-->
							<div class="my-form">
							
								<form role="form" method="post" id="tmdetail" >
								
									<p class="text-box">
									<label for="box1">Team Leader <span class="box-number">1</span></label>
									<input type="text" name="boxes[]" value="" id="box1" class="controltext" title="Provide Member Name" readonly />
									<label for="box1">Email ID </label><input type="text" name="boxess[]" value="" id="boxess1" class="controltext" title="Provide Member CSC EmailID" readonly />
									<a class="add-box" href="#">Add More</a>
									</p>
									
								 <p align="right"><input type="submit" name="prsubmit" id="prsubmit" class="controltext" Value="Submit" > &nbsp;&nbsp;<input type="button" name="prcancel" class="controltext" Value="Cancel" onclick="self.location='index.php'"><br/><br/><span style="color:red;">* Mandatory fields</span></p>
								
								</form>
							</div>
						
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