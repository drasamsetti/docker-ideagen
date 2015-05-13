<?php
error_reporting(0);
include "header-main.php";

 $auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
	$owneremail = $_SESSION['short_id'];
	//$sql = "SELECT * FROM  `csc_lr_experiment_req` where `experiment_current_snapshot`='241'";
	$sql="SELECT distinct(emp_short_id), name, category_id FROM `role_trans` where role_id IN ( 2, 3, 4, 5, 7, 8, 9) order by emp_short_id";
	$manageuser = mysql_query($sql);

?>

<form name="account">
	<br/><br/>
		<table id="skillview" width="100%">
		<tr><th colspan="4" class="theme-details-l">Manage User Access</th></tr>
		<tr align="left"><th>Full Name</th><th>ShortID</th><th>Category</th><!--<th>Owner</th>--><th>Role/s</th></tr>
		<?php
		while($row = mysql_fetch_array($manageuser))
		{
		$catsql="select * from category_master where id=".$row['category_id'];
		$category=mysql_query($catsql);
		
		while($catdetails = mysql_fetch_array($category))
		{
			//$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
	
	//echo $sql;
			//$expt_snapshot=mysql_query($sql);
			//while($expt_snapshots = mysql_fetch_array($expt_snapshot))
			//{
				$cat_name = $catdetails['name'];
					
			if ($cnt%2 == 1)
			{
			?>
				<tr>
					<td><?php print $row['name']; ?></td>
					<td><?php print $row['emp_short_id']; ?></td>	
					<td><?php print $cat_name; ?></td>	
					<!--<td><?php print $row['owner_short_id']; ?></td>	-->
					<td><a href="manage_user_access_admin.php?user=<?php echo $row['emp_short_id']?>" ><?php print "View Roles"; ?></a></td>	
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $row['name']; ?></td>
					<td><?php print $row['emp_short_id']; ?></td>	
					<td><?php print $cat_name; ?></td>	
					<!--<td><?php print $row['owner_short_id']; ?></td>	-->
					<td><a href="manage_user_access_admin.php?user=<?php echo $row['emp_short_id']?>" ><?php print "View Roles"; ?></a></td>	
				</tr>	
			<?php
			}
			//}
			$cnt++;
		}
		}
		
		?>

		</table>
		<!--<div align="right">
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>
		<div>
		<?php
		//chk = md5(201f00b5ca5d65a1c118e5e32431514c);
		//echo "Value is ".chk;
		
		?>
		</div>-->
		<!--<table width = "100%" cellpadding = "2" cellspacing = "0" style = "font-size:0.9em">
		</table>
	<p align="center"><input type="button" name="btnClose" id="btdClose" Value="Close" onclick="javascript:window.close()"></p>-->
	</form>
	
	<br/><br/>

<?php
//}
include "footer.php";
?>