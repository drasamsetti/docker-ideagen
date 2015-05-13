<?php

	//tmplate code start
	//require_once('config.php'); //this assumes your page is in a sub dir.
	//include('headercss.php');
	
	/*include_once __SITE_PATH . '/lang/lang.php';
	include_once __SITE_PATH . '/app/views/header.php';
	include_once __SITE_PATH . '/config/db_config.php';
	require_once __SITE_PATH . '/libs/Session.php';
*/
	//$MetaID = $_GET['MetaId'];
	
	include "header-main.php";

	$auth=$_SESSION['auth_no'];
	
	$cnt=1;
	
	/*if ($MetaID == 1)
		{
			$meta_type = 'skill_category';
		}
		else if ($MetaID == 2)
		{
			$meta_type = 'skill_kingdom';
		}
		else if ($MetaID == 3)
		{
			$meta_type = 'region';
		}
		else if ($MetaID == 4)
		{
			$meta_type = 'general_knowledge';
		}		
		else if ($MetaID == 5)
		{
			$meta_type = 'interest';
		}
		else if ($MetaID == 6)
		{
			$meta_type = 'experience';
		}	
		*/
		

//$zone=3600*0 //GMT 
//$zone=3600*1 //CET 
//$zone=3600*5 + 60*30 //india 
//$currdate=gmdate("D M Y H:i", strtotime(time()) + $zone); 

//echo "Date Time is :".$currdate;

		$sql="select * from theme_master order by request_theme";
		$skill_metadatas=mysql_query($sql);
		
		
	?>

	<form name="account">
	<br/><br/>
		<table id="skillview" width="100%">
		<tr><th colspan="5" class="theme-details-m">View available Challenges</th></tr>
		<tr align="left"><th>Request Theme</th><th>Challenge Name</th><th>Start Date</th><th>End Date</th><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
			//$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
	
	//echo $sql;
			//$expt_snapshot=mysql_query($sql);
			//while($expt_snapshots = mysql_fetch_array($expt_snapshot))
			//{
			//	$expt_snapshots_name = $expt_snapshots['meta_text'];
					
			if ($cnt%2 == 1)
			{
			?>
				<tr>
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><?php print $row['name']; ?></td>	
					<td><?php print $row['start_date']; ?></td>	
					<td><?php print $row['exp_date']; ?></td>
					<td><?php print $row['status']; ?></td>	
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><?php print $row['name']; ?></td>	
					<td><?php print $row['start_date']; ?></td>	
					<td><?php print $row['exp_date']; ?></td>
					<td><?php print $row['status']; ?></td>	
				</tr>	
			<?php
			}
			//}
			$cnt++;
		}
		}
		
		if ($cnt==1)
		{
			echo "<br/>There are no Challenges available, to display !!! <br/>";
		}
		?>

		</table>
		<!--<div align="right">
		<br/>
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>-->
		<!--<div>
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
	//include('footer.php');

//error handler function
function customError($errno, $errstr)
  {
  echo "<b>Error:</b> [$errno] $errstr";
  }

//set error handler
set_error_handler("customError");
?>
<?php
//}
include "footer.php";
?>