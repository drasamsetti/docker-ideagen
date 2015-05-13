<?php
error_reporting(0);
include "header-main.php";
$auth=$_SESSION['auth_no'];

$user_short_id = $_GET['user'];


if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}
$short_id=$_SESSION['short_id'];
//$short_id="knigam@csc.com";

$account=$_SESSION['account'];

//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","Regional CTO" );
//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO");
//echo $account;
$query="select a.* from emp_master a, role_master b where a.role=b.id and (b.role_name='ATD' or b.role_name='admin') and a.short_id='$short_id'";
$result=mysql_query($query) or die("Could not execute query: ".mysql_error());
$row_rolename=mysql_fetch_array($result);
$temp=$row_rolename['role'];



if(mysql_num_rows($result)==0)
{
	echo "<h3>You are not authorized to view this page !!!<br> Please Enter Correct User Name and Password</h3>";
	include "footer.php";
	die;
}

$q_cat="Select * from category_master";
$result_cat=mysql_query($q_cat);
$total_cat=0;

while($row_cat=  mysql_fetch_array($result_cat))
{
    $arr_category_name[$row_cat['id']]=$row_cat['name'];
    $arr_category[$row_cat['name']]=$row_cat['id'];
    $total_cat=$total_cat+1;
}

//$arr_category=array("Design"=>1,"Testing"=>2,"Development"=>3,"Technology"=>4,"Others"=>6,"Quality"=>12,"ECM"=>13);
//$arr_category_name=array(1=>"Design",2=>"Testing",3=>"Development",4=>"Technology",6=>"Others",12=>"Quality",13=>"ECM");

$sqlqry="SELECT distinct(emp_short_id), name, category_id from role_trans where emp_short_id='$user_short_id'";
$useraccess=mysql_query($sqlqry);
//echo "SQL Query : ".$sqlqry;

if(isset($_REQUEST['submit']))
{
	//$temp=$_SESSION['temp'];
       
        

        //echo $temp;
 //$i=0;
	      // while($i<=$temp)
              //{ //echo $sid;
            $empname=$_REQUEST["empname"];
		$empshortid=$_REQUEST["empshortid"];
                //echo $ckbchange;
				$currrole=$_REQUEST["empcurrrole"];
                //$role=$_REQUEST["roleid"];
				$role = implode(',', $_POST['roleid']);
				$emproleid=$_REQUEST["emproleid"];
		$empcategory=$_REQUEST["empcategory"];
		$empcateid=$_REQUEST["empcateid"];
		
		$sinrole = explode(',',$emproleid);
		//echo "<br/>Curr Roles : ".$emproleid;
		$count=count($_POST['roleid']);
		$currcnt=count($sinrole);
		
		//echo "<br/>Current role count ".$currcnt;
		
		for($n=0;$n<$currcnt;$n++)
		{
			$sqldel="delete from role_trans where emp_short_id='$empshortid' and role_id='$sinrole[$n]'";
			mysql_query($sqldel);
			//echo "<br/> Delete Qry : ".$sqldel;
		}
		
		for($i=0;$i<$count;$i++)
		{
			$temprole=$_POST['roleid'][$i];
			$sqlins="insert into role_trans (emp_short_id,name,category_id,role_id) values ('$empshortid','$empname','$empcateid','$temprole')";
			mysql_query($sqlins);
			//echo "<br/> Insert Qry : ".$sqlins;
			//echo "<br/>Role is : ".$temprole;
			//echo "<br/>Current Role : ".$sinrole[$i];
			
		}
		
		//echo "<br/>Selected Count : ".$count;
		
		//echo "<br/>Values got are - Emp Name : ".$empname."<br/>Emp Short ID : ".$empshortid."<br/>Emp Category : ".$empcategory."<br/>Curr Role : ".$currrole."<br/>Updated Role : ".$role;
		/*
                if($role=="User")
                { $role_no=4;

                }
                elseif($role=="OPS Reviewer")
                {  
                  // {
                    $role_no=2;
                }
                elseif($role=="Challenger")
                {
					$role_no=3;
                }
				elseif($role=="ATD")
                {
					$role_no=5;
                }
				elseif($role=="BU Sponsor")
                {
					$role_no=8;
                }
				elseif($role=="TDC")
                {
					$role_no=7;
                }
				elseif($role=="IRB")
                {
					$role_no=9;
                }
				elseif($role=="Regional CTO")
                {
					$role_no=11;
                }
				else
                {
					$role_no=6;
                }
*/
               // }
                //$cate=$arr_category[$category];
               //$query_em="update emp_master set role='$currrole' , category='$empcategory' where short_id='$empshortid'";
               //$query_em="insert into role_trans (emp_short_id,name,category_id,role_id) values ('$empshortid','$empname','$empcateid','$role')";
			  // echo "<br/>SQL Query : ".$query_em;
               
		      //$result11=mysql_query($query_em) or die (" Please Select only one Account Admin for one Account Could not execute query ($query_em) because ".mysql_error()) ;
                       $headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: innovation@csc.com';
	        $subject="Idea Generation Tool: Request for Account Approved";
	        $message="Dear ,\n\nThis is is to notify that an account has been Changed By Account Admin: $short_id for you with the following details:\n\nUser-ID: $sid\nAccount: \nCategory: \n You can start using Idea Generation tool here:\n ($url) \n\nRegards,\nThe Idea Generation Team.";
	        //@mail($sid, $subject, $message, $headers);

			//echo "<div align=\"center\">Thank you. The account has been created  ".".</div>";
			//echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"index.php\"'></input></div>";

		
		//$i++;
	//}

echo "<div align=\"center\">Thank you The Role has been Modified ".".</div>";
			echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"view_manage_users.php\"'></input></div>";

}
		
else
{   //echo $account;
 //$q_emp_reg= "Select * from emp_master where account=$account AND role IN ( 2, 3, 4, 5, 7, 8, 9, 11 ) ";
// $q_emp_reg= "Select * from role_trans where role_id IN ( 2, 3, 4, 5, 7, 8, 9, 11 ) group by emp_short_id";
  //echo $q_emp_reg;
//echo "<br/> In else loop";
	
	//$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
	?>
		<script type="text/javascript">
		function checkform(form)
		{
		    if(document.approve_user.roleid.selectedIndex=="-1")
			{
			  	alert("Please Choose atleast one role and update");
			  	document.approve_user.roleid.focus();
			  	return false;
			}

		}


		</script>
<style type="text/css">

option.even {
  color: blue;
  background-color: greenyellow;
}
option.odd {
  color: red;
  background-color:greenyellow ;
}
</style>
<script>

function my_fun(name)
{  
   approve_user.elements[name].value="1";


}
</script>

    <form name="approve_user" enctype="multipart/form-data" method="post" action="manage_user_access_admin.php" onsubmit="return checkform(this)">
	<table align="center" class="theme-details sort">
	<tr><th colspan="2" class="theme-details-m">User Access Change</th></tr>
	<?php
	$sql="select * from role_master where id IN ( 2, 3, 4, 5, 7, 8, 9)";
		$key_role=mysql_query($sql);
		$j=1;
	$rolesql="select * from role_trans where emp_short_id='$user_short_id'";
			$my_role=mysql_query($rolesql);
			//echo "<br/>Role SQL ".$rolesql;
			$k=1;
			$comma=',';
			$existingroles;
			$tmproleid;
	while($my_roles = mysql_fetch_array($my_role))
	{
		$tmprole = $my_roles['role_id'];
		//while($key_roles = mysql_fetch_array($key_role))
		//{
		
		if ($k==1)
		{
			$existingroles = $_SESSION['emp_role'][$tmprole];
			$tmproleid = $my_roles['role_id'];
		}
		else
		{
			$existingroles = $existingroles.$comma.$_SESSION['emp_role'][$tmprole];
			$tmproleid = $tmproleid.$comma.$my_roles['role_id'];
		}
		$k=$k+1;
		//}
	}
	$chkrole = explode(',',$tmproleid);
	$chkcnt=count($chkrole);
	while($useraccesschg = mysql_fetch_array($useraccess))
	{
		//echo "<br/>In While loop";
		$catsql="select * from category_master where id=".$useraccesschg['category_id'];
		$category=mysql_query($catsql);
		$cat_name;
		
		while($catdetails = mysql_fetch_array($category))
		{
			$cat_name = $catdetails['name'];
			
			//echo "<br/>In While inner loop";
			
		}
	?>
        
		<tr><td>Full Name </td><td><input type="text" name="empname" class="controltext" value="<?php echo $useraccesschg['name']; ?>" readonly></td></tr>
		<tr><td>Short ID </td><td><input type="text" name="empshortid" class="controltext" value="<?php echo $useraccesschg['emp_short_id']; ?>" readonly></td></tr>
		<tr><td>Category </td><td><input type="text" name="empcategory" class="controltext" value="<?php echo $cat_name; ?>" readonly><input type="hidden" name="empcateid" value="<?php echo $useraccesschg['category_id'];?>"><input type="hidden" name="emproleid" value="<?php echo $tmproleid;?>"></td></tr>
		<!--<tr><td>Existing Role/s </td><td><input type="text" name="empcurrrole" class="controltext" value="<?php echo $existingroles; ?>" readonly><input type="hidden" name="emproleid" value="<?php echo $tmproleid;?>"></td></tr>-->
		<tr><td>Update Role/s</td><td><select multiple name="roleid[]" class="controltext">
		<?php 
		
		//while($my_roles = mysql_fetch_array($my_role))
			//{
			while($key_roles = mysql_fetch_array($key_role))
				{
			
			//while($my_roles = mysql_fetch_array($my_role))
				//{
				//echo "My Role :".$my_roles['role_id'];
		?>
		<option value="<?php echo $key_roles['id'];?>" <?php for($s=0;$s<$chkcnt;$s++) { if ($key_roles['id']==$chkrole[$s]) {?> selected <?php }} ?> ><?php echo $key_roles['role_name']; ?></option>
		<?php
				
				}
			//}
		?>
		</select></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" name="submit" class="controltext" value="Update Role" onclick="return checkCheckBoxes()" >&nbsp;&nbsp;<input type="button" name="cancel" Value="Cancel" class="controltext" onclick="history.back();"></td></tr>
	</table>
                   
	</form>

	<?php
		//echo "<br/> J Value is ".$j;
		//}
	}
}
include "footer.php";
?>
	