<?php
	error_reporting(0);
	
	//include('config.php');	// include your code to connect to DB in the Config file.
	//include('initial_header.php');
	include "header-main.php";
?>
<br>
<script language="Javascript">

// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;
// Minimum no of digits in an Employee id.
var minDigitsInextn = 6;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function isNumeric(value)
{   var i;
    for (i = 0; i < value.length; i++)
    {   
        // Check that current character is number.
        var c = value.charAt(i);
        if (((c < "0") || (c > "5"))) return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}
function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
var bracket=3
strPhone=trim(strPhone)
if(strPhone.indexOf("+")>1) return false
if(strPhone.indexOf("-")!=-1)bracket=bracket+1
if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
var brchr=strPhone.indexOf("(")
if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

/*function ValidateForm(){
	var Phone=document.frmSample.txtPhone
	
	if ((Phone.value==null)||(Phone.value=="")){
		alert("Please Enter your Phone Number")
		Phone.focus()
		return false
	}
	if (checkInternationalPhone(Phone.value)==false){
		alert("Please Enter a Valid Phone Number")
		Phone.value=""
		Phone.focus()
		return false
	}
	return true
 }*/

function isNumeric(value) {
		if (value != null && !value.toString().match(/^[-]?\d*\.?\d*$/))
		return false;
  return true;
}

function employeeid(value) {
		if (value != null && !value.toString().match(/^[-]?\d*\.?\d*$/))
		return false;
  return true;
}

function qntity(value) {
		if (value != null && !value.toString().match(/^[-]?\d*\.?\d*$/))
		return false;
  return true;
}

/**
 * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */

function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)+1 ==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true					
	}

function checkme() // Define function checkme
{

	if ((document.forms[0].FirstName.value == "") || (document.forms[0].LastName.value == "") || (document.forms[0].empID.value == "") || (document.forms[0].shortid.value == "") || (document.forms[0].password.value == "") || (document.forms[0].Cpassword.value == "") || (document.forms[0].email.value == "") || (document.forms[0].extn.value == "") || (document.forms[0].mobile.value == "") || (document.forms[0].Ansr.value == ""))
    	{
    		alert("You did not enter values for mandatory fields. Please provide them.");
    		return(false);
		
    	}
    	if ((document.forms[0].Location.selectedIndex == 0) || (document.forms[0].Question.selectedIndex == 0))
    	{
    		alert("You did not enter values for mandatory fields. Please provide them.");
    		return(false);
		
    	}
	if (document.forms[0].password.value !== document.forms[0].Cpassword.value)
    	{
    		alert("Mismatch between passwords!!.");
    		return(false);
		
    	}
	var emailID=document.forms[0].email
	
	
	if (echeck(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}
	
	var Phone=document.forms[0].mobile
	
	if (checkInternationalPhone(Phone.value)==false){
		alert("Please Enter a Valid Mobile Number")
		Phone.value=""
		Phone.focus()
		return false
	}

	var extnn=document.forms[0].extn

	if (isNumeric(extnn.value)==false){
		alert("Please Enter a Valid Extention")
		extnn.value=""
		extnn.focus()
		return false
		return (isNumeric(extnn.value) && value.length >= minDigitsInextn);
	}

	var emplID=document.forms[0].empID

	if (employeeid(emplID.value)==false){
		alert("Please Enter a Valid Employee ID")
		emplID.value=""
		emplID.focus()
		return false
	}

	var qty=document.forms[0].quantity

	if (qntity(qty.value)==false){
		alert("Please Enter a Valid Quantity no.")
		qty.value=""
		qty.focus()
		return false
	}
	return true
	
}
function emailpop()
{
var shtid=document.forms[0].shortid
var eml=document.forms[0].email
eml.value=shtid.value + "@csc.com"
return true
}

</script>

<br/>

<div align="center">
<para><font face="Arial"color="000000" size="2">Please enter your username and click on the Submit button</font></para>
<form name="form1" method="post" action="csc_lr_forgetpw_1.php">

<FIELDSET style="border-style:solid;border-width:3px;border-color:#BDBDBD;noshade:noshade;align:center;width:300px;height:100px">   
<LEGEND style="color:#000000;padding-left:1px;padding-right:1px;font-size:14px;font-weight:bold;" >CSC IdeaGen Forget Password</LEGEND>

<table>
<tr>
<td><b>UserName :</b></td>
<td>
<input name="shortid" type="text" id="shortid" size="16" maxlength="36">
</td>
</tr>
<tr align='center'>
<td>
<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Submit"></td></tr>
</td>
</tr>
</table>
</table>
</FIELDSET>
</form>
</div>

<div>&nbsp;</div>

<!--<table class="plain" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td colspan="3" bgcolor="#cc0000"><img alt="" src="index_files/Px_Clear.gif" 
nbvnbv height="6" width="794"></td>
					</tr>
					
				</tbody>
			</table>  -->

	<?php include("footer.php"); ?>	
