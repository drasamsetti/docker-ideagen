<?php
error_reporting(0);
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
	
	if($auth==0)
	{
		echo "<h1>you are not authorised </h1>";
		die;
	}
	
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
		$sql="select * from csc_lr_experiment_req order by request_theme";
		$skill_metadatas=mysql_query($sql);
	?>

	<form name="account" id="account">
	<br/><br/>
		<table id="skillview" >
		<tr><th colspan="5" class="theme-details-l">Status of Idea Submitted</th></tr>
		<tr><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><th>Category</th><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
			$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
	
	//echo $sql;
			$expt_snapshot=mysql_query($sql);
			while($expt_snapshots = mysql_fetch_array($expt_snapshot))
			{
				$expt_snapshots_name = $expt_snapshots['meta_text'];
					
			if ($cnt%2 == 1)
			{
			?>
				<tr>
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><?php print $row['expt_shortname']; ?></td>	
					<td><?php print $row['overview']; ?></td>	
					<td><?php print $row['idea_category']; ?></td>
					<td><?php print $expt_snapshots_name; ?></td>	
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><?php print $row['expt_shortname']; ?></td>	
					<td><?php print $row['overview']; ?></td>
					<td><?php print $row['idea_category']; ?></td>
					<td><?php print $expt_snapshots_name; ?></td>
				</tr>	
			<?php
			}
			}
			$cnt++;
		}
		}
		?>

		</table>
		<div align="right">
		<br/>
		<input type="button" name="export_report" id="export_report" class="controltext" value="Export to Spreadsheet" onclick="javascript:window.open('ideas_exporttoexcel.php');" >
		</div>
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