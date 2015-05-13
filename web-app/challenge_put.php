<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
?>
<script type="text/javascript">


function checkform(form)
{
    if(form.accessto.value=='0')
  	{
  		alert("Please Choose the access yes/no");
  		form.accessto.value="";
  		form.accessto.focus();
  		return false;
  	}
	if(form.cscprchallengetype.value=='0')
  	{
  		alert("Please select the Challenge type");
  		form.cscprchallengetype.value="";
  		form.cscprchallengetype.focus();
  		return false;
  	}
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
	
	if(form.req_theme.value=='0')
  	{
  		alert("Please select the Request Theme type");
  		form.req_theme.value="";
  		form.req_theme.focus();
  		return false;
  	}
  	if(form.start_date.value.length==0)
	{
	  	alert("Please enter the Expiry Date in the format (yyyy-mm-dd)");
	  	form.start_date.value="";
	  	form.start_date.focus();
	  	return false;
	}
	if(form.end_date.value.length==0)
	{
	  	alert("Please enter the Expiry Date in the format (yyyy-mm-dd)");
	  	form.end_date.value="";
	  	form.end_date.focus();
	  	return false;
	}



}
</script>
<?php
$id="";
if(isset($_REQUEST['submit']))
{  $id=$_REQUEST['id'];
	$name=addslashes($_REQUEST['name']);
	$descp=addslashes($_REQUEST['descp']);
	if($id!="")
	{
		$descp="<br/><br/>For more information, please click <a href=\"generate-idea.php?prob_id=$id\">here</a>.";
	}
        $q_cat="Select * From category_master";
        $q_acc="Select * from Account_master where name=";

        $result_cat=mysql_query($q_cat);
        $arr_category=array();
        while($row_cat=mysql_fetch_array($result_cat))
        {
            $arr_category[$row_cat['name']]=$row_cat['id'];
        }
        
	$req_theme=$_REQUEST['req_theme'];
       // echo "<h1>welcome</h1>".$arr_category["Testing"];
	$st_date=$_REQUEST['start_date'];
	$ed_date=$_REQUEST['end_date'];
	$accessto=$_REQUEST['accessto'];
       // echo $account1;
       //$q_acc="Select id from Account_master where name='$account1'";
       //$result_acc=mysql_query($q_acc);
       //$account=$_SESSION['account'];
    /* if(mysql_num_rows($result_acc)!=0)
        {
        //$account=$_SESSION['account'];
      }
      else
      {
          $account=0;
      }*/
// R
      //$account=$_SESSION['account'];
      //$category=$_REQUEST['category'];
	  $challenge_type=$_REQUEST['cscprchallengetype'];
      // end R
       // $category=$arr_category[$category];
	$date=date("Y-m-d");
	if($_FILES['uploadedfile']['name']!="")
	{
		$target_path = "files/";
		$target_path = $target_path."theme_".$_SESSION['short_id']."_".$name."_".basename( $_FILES['uploadedfile']['name']);
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$query="insert into theme_master(name,descp,request_theme,start_date,accessibletoemp,attachment,creator,date,comment,exp_date,challenge_type,account) values('$name','$descp',$req_theme,'$st_date','$accessto','$target_path','".$_SESSION['short_id']."', '$date','challenge','$ed_date',$challenge_type,16)";
			$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
			$query2="select max(id) from theme_master where creator='".$_SESSION['short_id']."'";
			$result2=mysql_query($query2) or die ("Could not execute query ($query2) because ".mysql_error());
			$row2=mysql_fetch_array($result2);
			$theme_id=$row2[0];

			if(!$result||!$result2)					
			{
				unlink($target_path);
			}
			
			
		}
		else
		{
			echo "There was an error uploading the file, please try again!";
		}
	}
	else
	{
		$query="insert into theme_master(name,descp,request_theme,start_date,accessibletoemp,attachment,creator,date,comment,exp_date,challenge_type,account) values('$name','$descp',$req_theme,'$st_date','$accessto','$target_path','".$_SESSION['short_id']."', '$date','challenge','$ed_date',$challenge_type,16)";
		$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
		$query2="select max(id) from theme_master where creator='".$_SESSION['short_id']."'";
		$result2=mysql_query($query2) or die ("Could not execute query ($query2) because ".mysql_error());
		$row2=mysql_fetch_array($result2);
		$theme_id=$row2[0];
		
		//die;
	}
        ?>
<script>
    alert("Submitted Successfully");
window.location="challenge_put.php"
</script>
<?php
}
else
{
	if($id!="")
	{
		$innovation_query="select short_desc, category, prob_desc from problem_master where prob_id=$id";
		$innovation_result=mysql_query($innovation_query) or die ("Could not execute query ($innovation_query) because ".mysql_error());
		$innovation_row=mysql_fetch_array($innovation_result);
	}
	?>
	<form name="create-theme" enctype="multipart/form-data" method="post" action="challenge_put.php" onsubmit="return checkform(this)">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<table align="center" class="theme-details">
	<tr><th colspan="2" class="theme-details-m">Define Challenge</th></tr>
	<tr><td align="right">Open to CSC User Community Only</td><td>
					<!--<select name="account">
						<option value="0">Public</option>

						<?php
                                                 echo $_SESSION['account'];
							$query="select * from account_master where id=".$_SESSION['account'];
							$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
							while($row=mysql_fetch_array($result))
							{
								?>
								<option value="<?php  echo $row['id']?>"><?php echo $row['name']; ?></option>
								<?php
							}
						?>
						</select>-->
						<input type="radio" name="accessto" value="Yes"> Yes   <input type="radio" name="accessto" value="No"> No 
						</td></tr>
							<tr>
							<td align="right">Challenge Type</td>
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
						</tr>
	<tr><td align="right">Challenge Name</td><td><input type="text" name="name" value="" size="45" ></td></tr>
        <tr><td align="right">Challenge Description</td><td><textarea name="descp" cols="34" rows="4"></textarea></td></tr>
	<tr><td align="right">Theme</td><td>
						<select name="req_theme" onChange="checktype(this.value)">
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
	<tr><td align="right">Start Date</td><td><input readonly class="range-low-today format-y-m-d divider-dash" type="text" name="start_date" size="32"></td></tr>
	<tr><td align="right">End Date</td><td><input readonly class="range-low-today format-y-m-d divider-dash" type="text" name="end_date" size="32"></td></tr>
	
	<tr><td align="right">Attachment (Optional)</td><td><input name="uploadedfile" type="file"></td></tr>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Submit" onclick="this.disabled=true"></td></tr>
	</table>
	</form>

<?php
}
include "footer.php";
?>