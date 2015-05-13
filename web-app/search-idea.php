<?php
include "header-main.php";
$auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}


$account=$_SESSION['account'];
$acc_query="select name from account_master where id =". $account;
	$acc_result=mysql_query($acc_query) or die ("Could not execute query ($acc_query) because ".mysql_error());
$acc_row=mysql_fetch_array($acc_result);
?>
<script type="text/javascript">
	//<![CDATA[
	
	/*
	        A "Reservation Date" example using two datePickers
	        --------------------------------------------------
	
	        * Functionality
	
	        1. When the page loads:
	                - We clear the value of the two inputs (to clear any values cached by the browser)
	                - We set an "onchange" event handler on the startDate input to call the setReservationDates function
	        2. When a start date is selected
	                - We set the low range of the endDate datePicker to be the start date the user has just selected
	                - If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value
	
	        * Caveats (aren't there always)
	
	        - This demo has been written for dates that have NOT been split across three inputs
	
	*/
	
	function makeTwoChars(inp) {
	        return String(inp).length < 2 ? "0" + inp : inp;
	}
	
	function initialiseInputs() {
	        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
	        document.getElementById("sd").value = "";
	        document.getElementById("ed").value = "";
	
	        // Add the onchange event handler to the start date input
	        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
	}
	
	var initAttempts = 0;
	
	function setReservationDates(e) {
	        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
	        // until they become available (a maximum of ten times in case something has gone horribly wrong)
	
	        try {
	                var sd = datePickerController.getDatePicker("sd");
	                var ed = datePickerController.getDatePicker("ed");
	        } catch (err) {
	                if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
	                return;
	        }
	
	        // Check the value of the input is a date of the correct format
	        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");
	
	        // If the input's value cannot be parsed as a valid date then return
	        if(dt == 0) return;
	
	        // At this stage we have a valid YYYYMMDD date
	
	        // Grab the value set within the endDate input and parse it using the dateFormat method
	        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
	        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");
	
	        // Set the low range of the second datePicker to be the date parsed from the first
	        ed.setRangeLow( dt );
	        
	        // If theres a value already present within the end date input and it's smaller than the start date
	        // then clear the end date value
	        if(edv < dt) {
	                document.getElementById("ed").value = "";
	        }
	}
	
	function removeInputEvents() {
	        // Remove the onchange event handler set within the function initialiseInputs
	        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
	}
	
	datePickerController.addEvent(window, 'load', initialiseInputs);
	datePickerController.addEvent(window, 'unload', removeInputEvents);
	
	//]]>
	</script>
	<form name="search-idea" method="post" action="view-openidea.php">
	<input type="hidden" name="status" value="search">
	<table align="center" class="theme-details">
	<tr><th colspan="2" class="theme-details-m"><?php echo $acc_row['name']; ?> - Search for Innovations</th></tr>
	<tr><td align="right">Idea Short Description</td><td><input type="text" name="short_desc" size="32"></td></tr>
	<tr><td align="right">Theme</td><td>
						<select name="req_theme" > <!--onChange="checktype(this.value)" -->
						<option value="-1">--Select the Theme--</option>
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
						</select>
	</td></tr>
	
	<tr><td align="right">Submitted by</td><td><input type="text" name="submitted_by" size="32"></td></tr>
	<tr><td align="right">Posted between</td><td><input class="format-y-m-d divider-dash" type="text" name="sd" id="sd" size="10"> &nbsp;and <input class="format-y-m-d divider-dash" type="text" name="ed" id="ed" size="10"></td></tr>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" disabled value="Submit"></td></tr>
	</table>
	</form>
<?php
include "footer.php";
?>
