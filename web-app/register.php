<?php
	include "header-main.php";



        
	
	if(isset($_REQUEST['sub']))
	{


                $sub=$_REQUEST['sub'];
		$short_id=mysql_real_escape_string($_POST['short_id']);
		$password=mysql_real_escape_string(md5($_POST['password']));
		$name=mysql_real_escape_string($_POST['name']);
		$mgr_name=mysql_real_escape_string($_POST['mgr_name']);
		$mgr_email=mysql_real_escape_string($_POST['mgr_email']);
		
		$account=mysql_real_escape_string($_POST['account']);
		$category=mysql_real_escape_string($_POST['category']);
		$qid=mysql_real_escape_string($_POST['secqtn']);
		$secans=mysql_real_escape_string($_POST['secans']);
		$role="user";
                //R
                //wednesday
                $q_admin="Select count(*) as c from emp_master";

                $result_ad=mysql_query($q_admin);
                $row_ad=mysql_fetch_array($result_ad);
                    $c1=$row_ad['c'];
                   
                // end
                    $q_no_user_in_account="Select count(short_id) from emp_master where account='$account' and role=5";
                  //  echo $q_no_user_in_account;
                    $res_no_user=  mysql_query($q_no_user_in_account);
                    $row_no_user=mysql_fetch_array($res_no_user);
                 $no_user=intval($row_no_user[0]);
                //  echo  $no_user;
                $q_mgr="Select * from emp_master where role=5 and account='$account'";
                $result_mgr=mysql_query($q_mgr);
               $row_mgr=mysql_fetch_array($result_mgr);
               
           if(mysql_num_rows($result_mgr)==0 && $no_user>0)
           {


               echo "<div align='center'><h3> Please Enter the Correct Manager Name OR Manager is not registered User  </h3>";
               echo "<br /><br /><input type='button' name='ok' value='Ok' onclick='window.location=\"register.php\"'></input></div>";
               
               ?>
<script>

</script>


<?php
               die;
               return 0;

           }
		  
        $query="insert into temp_user(short_id,password,name,account,category,role,status,mgr_name,mgr_sid,QID,secanswer) values ('$short_id','$password','$name','$account','$category','$role','pending','$mgr_name','$mgr_email','$qid','$secans')";
        mysql_query($query); // or die ("Could not execute query ($query) because ".mysql_error());
		if(mysql_errno ()==1062)
                {
                    echo "<script>alert('You Already registered. Please, Wait for Approval or Click on forget Password')</script>";
                    die;
                }
        $query2="select short_id, name from emp_master a, role_master b where a.role=b.id and b.role_name='institute_admin' and a.account=$account";
        $result=mysql_query($query2) or die ("Could not execute query ($query2) because ".mysql_error());
        $headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: innovation@csc.com';
        $subject="Idea Generation Tool: New User Registration";
        while($row=mysql_fetch_row($result))
        {
        	$to=$row[0];
        	$admin_name=$row[1];
        	$message="Dear $admin_name,\n\nThis is is to notify that a new user \"$name\" has requested for an account. Please perform necessary action by going to this link:\n ($url/new-user.php) \n\nRegards,\nThe Idea Generation Team.";
        	@mail($to, $subject, $message, $headers);
        }
        
        echo "<div align=\"center\">Thank you. Your request for an account has been sent to the admins. You will get an email, and can login once it has been approved.</div>";
// setcookie("login", "", time()-3600);
       //    session_destroy();
           ?>

<script language="Javascript">
<!--
 alert(" Congratulation Registration has been done Successfully !! Please Waiting for Approval");
	window.location="index.php";
//-->
</script>

	<?php
	}
	else
	{
		?>
<script language="javascript">
function checkform(form)
{
	function isValidEmail(email, required) {
    if (required==undefined) {   // if not specified, assume it's required
        required=true;
    }
    if (email==null) {
        if (required) {
            return false;
        }
        return true;
    }
    if (email.length==0) {  
        if (required) {
            return false;
        }
        return true;
    }
    if (! allValidChars(email)) {  // check to make sure all characters are valid
        return false;
    }
    if (email.indexOf("@csc.com") < 1) { //  must contain @, and it must not be the first character
        return false;
    } else if (email.lastIndexOf(".") <= email.indexOf("@")) {  // last dot must be after the @
        return false;
    } else if (email.indexOf("@") == email.length) {  // @ must not be the last character
        return false;
    } else if (email.indexOf("..") >=0) { // two periods in a row is not valid
	return false;
    } else if (email.indexOf(".") == email.length) {  // . must not be the last character
	return false;
    }
    return true;
	}
	function allValidChars(email) {
	  var parsed = true;
	  var validchars = "abcdefghijklmnopqrstuvwxyz0123456789@.-_";
	  for (var i=0; i < email.length; i++) {
	    var letter = email.charAt(i).toLowerCase();
	    if (validchars.indexOf(letter) != -1)
	      continue;
	    parsed = false;
	    break;
	  }
	  return parsed;
	}





	if(form.short_id.value=="")
       {
		alert("Please enter a valid email address for user-id");
		form.short_id.value="";
		form.short_id.focus();
		return false;
	}
	if (!isValidEmail(form.short_id.value))
	{
        alert("Please enter a valid email address for User ID");
		form.short_id.value="";
		form.short_id.focus();
		return false;
    }
	
	if(form.name.value=="")
    {
		alert("Please enter Name");
		form.name.value="";
		form.name.focus();
		return false;
	}

        if(form.password.value=="")
    {   


		alert("Please enter Password");

		form.password.value="";
		form.password.focus();
		return false;
	}
        
         if(form.password.value!="")
    {

          var c=form.password.value.toString();
           var count = c.length;
           if(count<8)
		{alert("Please enter Password having 8 Characters ");

		form.password.value="";
		form.password.focus();
		return false;
                }
	}

	if(form.password2.value=="")
    {
		alert("Please re-enter Password");
		form.password2.value="";
		form.password2.focus();
		return false;
	}

        if(form.password.value!=form.password2.value)
            {
                alert("Re-entered Password Should be same as Password");
                form.password2.value="";
		form.password2.focus();

                return false;

            }
	


	if(form.mgr_name.value=="")
    {
		alert("Please enter Manager's Name");
		form.mgr_name.value="";
		form.mgr_name.focus();
		return false;
	}

        if (!isValidEmail(form.mgr_email.value))
	{
        alert("Please enter a valid email address for Manager's Email Address");
		form.mgr_email.value="";
		form.mgr_email.focus();
		return false;
    }
	if(form.account.value=="0")
    {
		alert("Please select an Account");
		form.account.focus();
		return false;
	}
	if(form.category.value=="0")
    {
		alert("Please select a Category");
		form.category.focus();
		return false;
	}
}
</script>
		<table align="center"  class="theme-details" border="1">
	<tr><th class="theme-details-l" colspan="5">Register for an Account</th></tr>
		<tr>
		<td>
		<form name="register" action="register.php" method="POST" onsubmit="return checkform(this)">
		
		<table cellpadding="1" bgcolor="white" cellspacing="0" border="0" width="1%">
					
					  <tr><td>
					  <table bgcolor="#cbdced" border="0" cellpadding="2" cellspacing="0"  width="1%">
					  <tr><td>
					  <table bgcolor="#eeeeee" border="0" cellpadding="2" cellspacing="0" width="100%">
					  <tr><td bgcolor="#ffffff" valign="top"  align="center">
					  <table cellspacing="0" cellpadding="8" width="700"  bgcolor="#ffffff" border="0">
					    <tr><td colspan="2" valign="top">
					  <span class="gaia ops gsl">
					  <FONT COLOR="#0000A0" size="3">Get started with Idea Generation</FONT>
					  <br>
					  </span>
					  </td></tr>
					 
					          <tr>
					          <td>User ID(Email Address)</td>
					          <td><input type="text" name="short_id" size="20"></td>
					          </tr>
					          
					          <tr>
					          <td>Full Name</td>
					          <td><input type="text" name="name" size="20"></td>
					          </tr>
					                 				         
					          <tr>
					          <td>Password</td>
					          <td><input type="password" name="password" size="20"></td>
					          </tr>
					          
					          <tr>
					          <td>Re-enter Password</td>
					          <td><input type="password" name="password2" size="20"></td>
					          </tr>
					          
					          <tr>
					          <td>Enter Manager's Name</td>
					          <td><input type="text" name="mgr_name" size="20"></td>
					          </tr>
					          
					          <tr>
					          <td>Enter Manager's Email Address</td>
					          <td><input type="text" name="mgr_email" size="20"></td>
					          </tr>
					          
					          <tr>
					          <td>Account</td>
					          <td><select name="account">
					          		<option value="0">Select an Account</option>
					          		<?php
					          			$query="select * from account_master";
					          			$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());;
					          			while($row=mysql_fetch_array($result))
					          			{
					          				?>
					          				<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
					          				<?php
										}
					          		?>
					          		</select>					          
					          </td>
					          </tr>
					          
					          <tr>
					          <td>Category</td>
					          <td><select name="category">
					          		<option value="0">Select a Category</option>
					          		<?php
					          			$query="select * from category_master";
					          			$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());;
					          			while($row=mysql_fetch_array($result))
					          			{
					          				?>
					          				<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
					          				<?php
										}
					          		?>
					          		</select>
					          </td>
					          
					          
					          
					          
					          </tr>            
					          <tr><td>Secret Question</td><td>

									<select name="secqtn" id="secqtn" >
										<option value="-1"><?php echo 'Select Secret Question'; ?></option>
										<?php 
											$sql="select QID, Question from secquestion ";
											$secqtn=mysql_query($sql);
											while($secretqtn = mysql_fetch_array($secqtn))
											{
											?>
												<option value="<?php echo $secretqtn['QID']; ?>"><?php echo $secretqtn['Question']; ?></option>
											<?php
											}
										?>
									</select>

								</td></tr>
 
								<tr><td>Secret Answer:</td><td>

									<input type="text" name="secans" maxlength="60">

								</td></tr>

					          <tr>
					          <td>
					          <INPUT type="submit" name="sub" value="Submit">
					          </td>
					          </tr>
					          
					  </table>
					  </td></tr>
					  </table>
					  </td></tr></table></td></tr></table></form></td></tr></table>
	<?php
	}
include "footer.php";
?>