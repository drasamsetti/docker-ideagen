<?php
include "header-main.php";
$auth=$_SESSION['auth_no'];
error_reporting(0);
if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}
$short_id=$_SESSION['short_id'];
//$short_id="knigam@csc.com";

$account=$_SESSION['account'];

$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","Regional CTO" );
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
        

if(isset($_REQUEST['submit']))
{
	$temp=$_SESSION['temp'];
       
        

        //echo $temp;
 $i=0;
	       while($i<=$temp)
              { //echo $sid;
            $sid=$_REQUEST["sid".$i];
		$ckbchange=$_REQUEST["rd_change".$i];
                //echo $ckbchange;
                $role=$_REQUEST["role".$i];
		$category=$_REQUEST["category".$i];
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

               // }
                $cate=$arr_category[$category];
               $query_em="update emp_master set role='$role_no' , category=$cate where short_id='$sid'";
               //echo $query_em;
               
		      $result11=mysql_query($query_em) or die (" Please Select only one Account Admin for one Account Could not execute query ($query_em) because ".mysql_error()) ;
                       $headers = 'From: Idea Generation Tool <idea@coin.csc.com>'."\r\n".'Reply-To: innovation@csc.com';
	        $subject="Idea Generation Tool: Request for Account Approved";
	        $message="Dear ,\n\nThis is is to notify that an account has been Changed By Account Admin: $short_id for you with the following details:\n\nUser-ID: $sid\nAccount: \nCategory: \n You can start using Idea Generation tool here:\n ($url) \n\nRegards,\nThe Idea Generation Team.";
	        //@mail($sid, $subject, $message, $headers);

			//echo "<div align=\"center\">Thank you. The account has been created  ".".</div>";
			//echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"index.php\"'></input></div>";

		
		
		$i++;
	}

echo "<div align=\"center\">Thank you The account has been Modified ".".</div>";
			echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"index.php\"'></input></div>";

}
else
{   //echo $account;
 //$q_emp_reg= "Select * from emp_master where account=$account AND role IN ( 2, 3, 4, 5, 7, 8, 9, 11 ) ";
 $q_emp_reg= "Select * from role_trans where role_id IN ( 2, 3, 4, 5, 7, 8, 9, 11 ) group by emp_short_id";
  //echo $q_emp_reg;

	
	//$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
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

       <form name="approve_user" enctype="multipart/form-data" method="post" action="manage_user_account_admin.php" onsubmit="return checkform(this)">
		<table align="center" class="theme-details sort">
                    <tr><th colspan="4" class="theme-details-m"></th></tr>
		<tr><th colspan="4" class="theme-details-m">List Of Registered User in Accounts : <?php echo $_SESSION['account_name'];?></th></tr>
		<tr><th class="sort">Full Name</th><th class="sort">Short ID</th><th class="sort">Current Role</th><th class="sort">Category</th></tr>
	<?php
	$i=0;
        
	$result_reg=mysql_query($q_emp_reg);
        while($row_reg=mysql_fetch_array($result_reg))
       {

				$sqlusr="select * from role_trans where emp_short_id='".$row_reg['emp_short_id']."'";
				$user_sel=mysql_query($sqlusr);
				$k=1;
				$userselected;
				while($user_sels = mysql_fetch_array($user_sel))
				{
					$userselected[$k]=$user_sels['role_id'];
					//echo "<br/>Short Id ".$user_sels['emp_short_id']." Role Id ".$userselected[$k];
					$k=$k+1;
				}
				//echo "<br/>K Value ".$k;

   	?>


		<tr <?php  echo " class=\"alt\""; ?>><td><input type="text" name="id<?php echo $i; ?>" value="<?php echo $row_reg['name']; ?>" readonly="readonly"></td>
		<td><input type="text" name="sid<?php echo $i; ?>" value="<?php echo $row_reg['emp_short_id']; ?>" readonly="readonly"></td>
                <td><select multiple name="role<?php echo $i; ?>" onchange="my_fun(<?php echo " 'role".$i+"'"  ?>)">
				<?php
				
				$sql="select * from role_master where id IN ( 2, 3, 4, 5, 7, 8, 9, 11 )";
				$key_role=mysql_query($sql);
				$j=1;
				while($key_roles = mysql_fetch_array($key_role))
								{
									
							?>
									<option value="<?php echo $key_roles['id'];?>" <?php if ($row_reg['role_id']==$key_roles['id']) {?> selected <?php $j=$j+1; }?>><?php echo $key_roles['role_name']; ?></option>
							<?php
									//$j=$j+1;
								}
							?>		
				<!--
                         <?php if($row_reg['role']=='4') { ?>
                        <option class="even"> <?php echo 'User' ; ?></option>
                        <option ><?php echo 'OPS Reviewer'; ?> </option>
                        <option>Challenger</option>
						<option >ATD</option>
								<option >TDC</option>
								<option >BU Sponsor</option>
								<option >IRB</option>
								<option >Regional CTO</option>
                        <?php  } else { if($row_reg['role']=='2') { ?>
                         <option class="even"> <?php echo 'OPS Reviewer' ; ?></option> 
                         <option><?php echo 'User'; ?> </option>
                         <option>Challenger</option>
						 <option >ATD</option>
								<option >TDC</option>
								<option >BU Sponsor</option>
								<option >IRB</option>
								<option >Regional CTO</option>
                         <?php }
                         else { if($row_reg['role']=='3') {
                         ?>
                          <option class="even"> <?php echo 'Challenger' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >ATD</option>
							<option >TDC</option>
							<option >BU Sponsor</option>
							<option >IRB</option>
							<option >Regional CTO</option>
                          <?php
                         }
						 else { if($row_reg['role']=='5') {
                         ?>
                          <option class="even"> <?php echo 'ATD' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >Challenger</option>
							<option >TDC</option>
							<option >BU Sponsor</option>
							<option >IRB</option>
							<option >Regional CTO</option>
                          <?php
                         }
                         else { if($row_reg['role']=='7') {
                         ?>
                          <option class="even"> <?php echo 'TDC' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >Challenger</option>
							<option >ATD</option>
							<option >BU Sponsor</option>
							<option >IRB</option>
							<option >Regional CTO</option>
                          <?php
                         }
						 else { if($row_reg['role']=='8') {
                         ?>
                          <option class="even"> <?php echo 'BU Sponsor' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >Challenger</option>
							<option >ATD</option>
							<option >TDC</option>
							<option >IRB</option>
							<option >Regional CTO</option>
                          <?php
                         }
						 else { if($row_reg['role']=='9') {
                         ?>
                          <option class="even"> <?php echo 'IRB' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >Challenger</option>
							<option >ATD</option>
							<option >TDC</option>
							<option >BU Sponsor</option>
							<option >Regional CTO</option>
                          <?php
                         }
						 else { if($row_reg['role']=='11') {
                         ?>
                          <option class="even"> <?php echo 'Regional CTO' ; ?></option>
                          <option>User</option>
                          <option>OPS Reviewer</option>
						  <option >Challenger</option>
							<option >ATD</option>
							<option >TDC</option>
							<option >BU Sponsor</option>
							<option >IRB</option>
                          <?php
                         }
                         } 
						 }
						 }
						 }
						 }
						 }
						 }
						 ?>

                         
                         <option>Delete</option>-->
						 
						 
                     </select></td>

		<td>
			 <select name="category<?php echo $i; ?>">
                             
			 <?php
                           $cat=$row_reg['category_id'];
                           
                         ?>
                             <option selected="trur" class="even"> <?php echo $arr_category_name[$cat] ?></option>
                             <?php

                         
                         $query2="select * from category_master"; ?>
                        
			   
			  <?php $result2=mysql_query($query2) or die ("Could not execute query ($query) because ".mysql_error());

									while($row2=mysql_fetch_array($result2))
									{
										?>
                             <option><?php echo $row2['name']; ?></option>
										<?php
            }
								?>
								</select>
		
                    <input type="hidden" name="rd_change<?php echo $i; ?>" value="0" >
                </td>
                
		
                
               
	<?php
         
         $_SESSION['temp']=$i;
		$i++;
		//}
	}
	?>
	</tr>

        <tr><td colspan=4 align="center"><input type="submit" name="submit" value="Submit" onclick="return checkCheckBoxes()" ></td></tr>
	</table>
                   
	</form>

	<?php
}
include "footer.php";
?>
	