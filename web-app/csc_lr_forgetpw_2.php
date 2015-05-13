<?php
//session_start();
//session_register("fgpwd");

	error_reporting(0);
	
	//include('config.php');	// include your code to connect to DB in the Config file.
	//include('initial_header.php');
	include "header-main.php";

?>
<script language="Javascript">

function checkme() // Define function checkme
{
	//alert ("Pwd valus is "+document.form3.password.value);
	//alert ("Pwd valus is "+document.form3.Cpassword.value);
	if ((document.form3.password.value == "") || (document.form3.Cpassword.value == ""))
	{
		alert("You did not enter values atleast in one of the password fields. Please provide them.");
		document.form3.password.value = "";
		document.form3.Cpassword.value = "";
		document.form3.password.focus();
		//document.form3.hidflag.value = "Not Set";
    		return false;	
	}
	if (document.form3.password.value !== document.form3.Cpassword.value)
    	{
    		alert("Mismatch between passwords!!.");
		document.form3.password.value = "";
		document.form3.Cpassword.value = "";
		document.form3.password.focus();
    		return false;
		
    	}
	var Pass=document.form3.password;
	var Cpass=document.form3.Cpassword;
	if(validatePassword(Pass.value, {
									length:   [8, Infinity],
									lower:    1,
									upper:    1,
									numeric:  1,
									special:  1									
								  }
						)==false
	  )
	{
			alert("Please Enter a valid Password!!!");
			alert("Password:\n min length: 8 characters, should contain atleast \n 1-Lower case\n 1-Upper case\n 1-Numeric\n 1-Special Character!!!");
			Pass.value="";
			Cpass.value="";
			Pass.focus();		
			return false
	}

	return true;
}

function validatePassword (pw, options) {
	// default options (allows any password)
	var o = {
		lower:    0,
		upper:    0,
		alpha:    0, /* lower + upper */
		numeric:  0,
		special:  0,
		length:   [0, Infinity],
		custom:   [ /* regexes and/or functions */ ],
		badWords: [],
		badSequenceLength: 0,
		noQwertySequences: false,
		noSequential:      false
	};

	for (var property in options)
		o[property] = options[property];

	var	re = {
			lower:   /[a-z]/g,
			upper:   /[A-Z]/g,
			alpha:   /[A-Z]/gi,
			numeric: /[0-9]/g,
			special: /[\W_]/g
		},
		rule, i;

	// enforce min/max length
	if (pw.length < o.length[0] || pw.length > o.length[1])
		return false;

	// enforce lower/upper/alpha/numeric/special rules
	for (rule in re) {
		if ((pw.match(re[rule]) || []).length < o[rule])
			return false;
	}

	// enforce word ban (case insensitive)
	for (i = 0; i < o.badWords.length; i++) {
		if (pw.toLowerCase().indexOf(o.badWords[i].toLowerCase()) > -1)
			return false;
	}

	// enforce the no sequential, identical characters rule
	if (o.noSequential && /([\S\s])\1/.test(pw))
		return false;

	// enforce alphanumeric/qwerty sequence ban rules
	if (o.badSequenceLength) {
		var	lower   = "abcdefghijklmnopqrstuvwxyz",
			upper   = lower.toUpperCase(),
			numbers = "0123456789",
			qwerty  = "qwertyuiopasdfghjklzxcvbnm",
			start   = o.badSequenceLength - 1,
			seq     = "_" + pw.slice(0, start);
		for (i = start; i < pw.length; i++) {
			seq = seq.slice(1) + pw.charAt(i);
			if (
				lower.indexOf(seq)   > -1 ||
				upper.indexOf(seq)   > -1 ||
				numbers.indexOf(seq) > -1 ||
				(o.noQwertySequences && qwerty.indexOf(seq) > -1)
			) {
				return false;
			}
		}
	}

	// enforce custom regex/function rules
	for (i = 0; i < o.custom.length; i++) {
		rule = o.custom[i];
		if (rule instanceof RegExp) {
			if (!rule.test(pw))
				return false;
		} else if (rule instanceof Function) {
			if (!rule(pw))
				return false;
		}
	}

	// great success!
	return true;
}
</script> 

<?php

	if( $_POST[SecAnswer] == $_SESSION['dbAnswer']  )
	{
?>

	<div align="center">

	<p><font face="Arial"color="000000" size="2">Please Reset your password</font></p>
	<FIELDSET style="border-style:solid;border-width:3px;border-color:#BDBDBD;noshade:noshade;align:center;width:350px;">   
	<LEGEND style="color:#000000;padding-left:1px;padding-right:1px;font-size:14px;font-weight:bold;" >CSC IdeaGen Reset Password</LEGEND>
	


	<form name="form3" method="post" action="csc_lr_forgetpw_3.php" onSubmit=" return checkme();">
	<br/>
	<table>
	<tr>
	<td><b>New Password :</b></td>
	<td><input type="password" name="password" id="password" size="16" maxlength="36"></td>
	</tr>
	<tr>
	<td><b>Confirm Password :</b></td>
	<td><input type="password" name="Cpassword" id="Cpassword" size="16" maxlength="36"></td>
	</tr>
	<tr align='center'>
	<td>
	<td colspan=2 align="center"><input type="submit" name="Submit" value="Update">&nbsp;<input type="reset" name="reset" value="Reset" >
	<input type="hidden" name="hidflag" id="hidflag">
	</td>
	</tr>
	</table>
	</form>

	</FIELDSET>
	</div>

<?php
	}
else
{
	if($_POST[SecAnswer])
		{
		?>
		<script language="Javascript">
		alert("Sorry, Answer mismatch");
		<!--
		window.location="csc_lr_forgetpw.php";
		//-->
		</script>				
		<?php
		}
		else
		{
		?>
		<script language="Javascript">
		alert("Provide a valid Answer");
		<!--
		window.location="csc_lr_forgetpw.php";
		//-->
		</script>				
		<?php
		}
	?>
		<br>
		<br>
		<a href="csc_lr_forgetpw.php">Go to Password Recovery!</a>
		</br>
		</br>
	<?php
}
?>

<div>&nbsp;</div>

<!--<table class="plain" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td colspan="3" bgcolor="#cc0000"><img alt="" src="index_files/Px_Clear.gif"  nbvnbv height="6" width="794"></td>
					</tr>
					
				</tbody>
			</table>  -->

	<?php include("footer.php"); ?>	