<?php
error_reporting(0);
include "header-main.php";

$auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}

$short_id=$_SESSION['short_id'];
$account=$_SESSION['account'];

//echo $account;
//echo $_SESSION['account_name'];
$query="select a.* from emp_master a, role_master b where a.role=b.id and (b.role_name='ATD' or b.role_name='admin') and a.short_id='$short_id'";
$result=mysql_query($query) or die("Could not execute query: ".mysql_error());

if(mysql_num_rows($result)==0)
{
	echo "You are not authorized to view this page";
	include "footer.php";
	die;
}
$arr_role=Array("User"=>4,"OPS Reviewer"=>2,"Challenger"=>3,"ATD"=>5,"TDC"=>7,"BU Sponsor"=>8,"IRB"=>9,"AMEA Regional CTO"=>11,"Australia Regional CTO"=>12,"Brazil Regional CTO"=>13,"Central & Eastern Europe Regional CTO"=>14,"South & West Europe Regional CTO"=>15,"India Regional CTO"=>16,"Nordics Regional CTO"=>17,"North American Public Sector Regional CTO"=>18,"Ingenuity Worx"=>19);
//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO");
if(isset($_REQUEST['submit']))
{
	$i=0;
      
        $temp=$_SESSION['temp'];
        //echo $temp;

	while($i<=$temp)
	{       //$id=$_REQUEST["id".$i];
            $id=$_REQUEST["id".$i];
		$comments=$_REQUEST["comments".$i];
		$decision=$_REQUEST["decision".$i];
		$category=$_REQUEST["category".$i];
                $role_no=$_REQUEST["role".$i];
               // echo "<h2>$role_no</h2>";
                $role_decision=$arr_role[$role_no];
//echo "<h2>$role_decision</h2>";
		$q=mysql_query("select a.name, b.name from account_master a, category_master b where a.id=$account and b.id=$category");
		$r=mysql_fetch_row($q);
		
		if($decision=='approve')
		{
			$query="select * from temp_user where short_id='$id'";
			$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
			$row=mysql_fetch_array($result);
			
			$name=$row['name'];
			$password=$row['password'];
			$mgr_name=$row['mgr_name'];
			$mgr_sid=$row['mgr_sid'];
			$qid=$row['QID'];
			$secans=$row['secans'];
			
			$query2="insert into emp_master (short_id, name, password, account, category, role, mgr_name, mgr_sid, QID, secanswer) values('$id','$name','$password','$account','$category', '$role_decision', '$mgr_name', '$mgr_sid', '$qid', '$secans')";
			$result2=mysql_query($query2) or die ("Could not execute query ($query2) because ".mysql_error());
			
			$query4="insert into role_trans (emp_short_id,name,category_id,role_id) values ('$id','$name','$category','$role_decision')";
			$result4=mysql_query($query4) or die ("Could not execute query ($query4) because ".mysql_error());
			
			$admin=$_SESSION['short_id'];
			$query3="update temp_user set status='approved', approving_admin='$admin', comments='$comments' where short_id='$id'";
			$result3=mysql_query($query3) or die ("Could not execute query ($query3) because ".mysql_error());
			
			$headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: innovation@csc.com';
	        $subject="Idea Generation Tool: Request for Account Approved";
	        $message="Dear $name,\n\nThis is is to notify that an account has been created for you with the following details:\n\nUser-ID: $id\nAccount: $r[0]\nCategory: $r[1]\n You can start using Idea Generation tool here:\n ($url) \n\nRegards,\nThe Idea Generation Team.";
	        @mail($id, $subject, $message, $headers);
	        
			echo "<div align=\"center\">Thank you. The account has been created and details mailed to ".$name.".</div>";
			echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"index.php\"'></input></div>";
		}
		elseif($decision=='reject')
		{
			$admin=$_SESSION['short_id'];
			$query3="update temp_user set status='rejected', approving_admin='$admin', comments='$comments' where short_id='$id'";
			$result3=mysql_query($query3) or die ("Could not execute query ($query3) because ".mysql_error());
			
			$headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: innovation@csc.com';
	        $subject="Idea Generation Tool: Request for Account Rejected";
	        $message="Dear $name,\n\nThis is is to notify that your request for an account has been rejected by $admin. \n\nRegards,\nThe Idea Generation Team.";
	        @mail($id, $subject, $message, $headers);
		}
		$i++;
	}
}
else
{  //$q_zz="select name from account_master where id='$account'";
//$result_zz=
        
	$query="select * from temp_user where account='$account' and status='pending'";
	$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
	?>
		<script type="text/javascript">
		function checkform(form)
		{   
		    if(form.decision.value=="0")
			{
			  	alert("Please perform an action");
			  	form.decision.focus();
			  	return false;
			}
		}
		</script>
		<form name="approve-user" enctype="multipart/form-data" method="post" action="new-user.php" onsubmit="return checkform(this)">
		<table align="left" class="theme-details sort">
		<tr><th colspan="6" class="theme-details-m">New User Requests for Account :<?php echo $_SESSION['account_name']; ?></th></tr>
		<tr><th class="sort">UserID</th><th class="sort">Full Name</th><th class="sort">Category</th><th class="sort">Role</th><th class="sort">Decision</th><th class="sort">Comments</th></tr>
	<?php
	$i=0;
	while($row=mysql_fetch_array($result))
	{
	?>
		
		
		<tr <?php if(($i%2)!=0) echo " class=\"alt\""; ?>><td><input type="text" name="id<?php echo $i; ?>" value="<?php echo $row['short_id']; ?>" readonly="readonly"></td>
		<td><input type="text" name="name<?php echo $i; ?>" value="<?php echo $row['name']; ?>" readonly="readonly"></td>
		<!-- <td>
								<select name="account<?php echo $i; ?>" style="width: 218px">
								<?php
									/*
									$query1="select * from account_master";
									$result1=mysql_query($query1) or die ("Could not execute query ($query) because ".mysql_error());
									while($row1=mysql_fetch_array($result1))
									{
										?>
										<option value="<?php echo $row1['id']; ?>" <?php if($row1['id']==$row['account']) echo " selected=\"selected\""; ?>><?php echo $row1['name']; ?></option>
										<?php
									}
									*/
								?>
								</select>
		</td> -->
		<td>
								<select name="category<?php echo $i; ?>">
								<?php
									$query2="select * from category_master";
									$result2=mysql_query($query2) or die ("Could not execute query ($query) because ".mysql_error());
									while($row2=mysql_fetch_array($result2))
									{
										?>
										<option value="<?php echo $row2['id']; ?>" <?php if($row2['id']==$row['category']) echo " selected=\"selected\""; ?>><?php echo $row2['name']; ?></option>
										<?php
									}
								?>
								</select>
		</td>
		<td>                                            <select name="role<?php echo $i; ?>">
								<option >User</option>
								<option >OPS Reviewer</option>
                                <option >Challenger</option>
								<option >ATD</option>
								<option >TDC</option>
								<option >BU Sponsor</option>
								<option >IRB</option>
								<option >AMEA Regional CTO</option>
								<option >Australia Regional CTO</option>
								<option >Brazil Regional CTO</option>
								<option >Central & Eastern Europe Regional CTO</option>
								<option >South & West Europe Regional CTO</option>
								<option >India Regional CTO</option>
								<option >Nordics Regional CTO</option>
								<option >North American Public Sector Regional CTO</option>
								<option >Ingenuity Worx</option>
								</select>
                </td>
                <td>
								<select name="decision<?php echo $i; ?>">
                                                                <option value="select">Select</option>
								<option value="approve">Approve</option>
								<option value="reject">Reject</option>
								</select>
		</td>
		<td><input type="text" name="comments<?php echo $i; ?>"></input></td>
	<?php
        $_SESSION['temp']=$i;
		$i++; 
	}
	?>
	</tr>
	<tr><td colspan=6 align="center"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
	</form>
	<?php
}
include "footer.php";
?>
	