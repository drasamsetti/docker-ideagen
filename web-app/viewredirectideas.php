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
	
	if ($_GET['val']<>"")
	{
		$val=$_GET['val'];
	}
	//echo "Value of val :".$val."<br/>";
	$auth=$_SESSION['auth_no'];
	
	if($auth==0)
	{
		echo "<h1>you are not authorised </h1>";
		die;
	}

	$sql="select * from csc_lr_experiment_req order by request_theme";
	$skill_metadatas=mysql_query($sql);
	
	
?>
<form name="redirectideas">
<?php
if ($_SESSION['role']>='11')
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ideas to Redirect</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		
		$regionchk;
		$regionsql="select * from role_master where id='".$_SESSION['role']."'";
		$regionqry=mysql_query($regionsql);
		while($regionqrys = mysql_fetch_array($regionqry))
		{
			$regionchk=$regionqrys['region_id'];
		}
		
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		//if (($row['experiment_current_snapshot']>='400') && ($row['experiment_current_snapshot']<'600'))
		if (($row['experiment_current_snapshot']=='61') && ($row['region_id']==$regionchk))
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
					<td><a href="redirectideas.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
					<td><?php print $row['overview']; ?></td>	
					<!--<td><?php print $row['owner_short_id']; ?></td>	-->
					<td><?php print $expt_snapshots_name; ?></td>	
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><a href="redirectideas.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
					<td><?php print $row['overview']; ?></td>
					<!--<td><?php print $row['owner_short_id']; ?></td>					-->
					<td><?php print $expt_snapshots_name; ?></td>
				</tr>	
			<?php
			}
			}
			$cnt++;
		}
		}
		}
	}
?>
</form>
<br/><br/><br/><br/>
<?php
//}
include "footer.php";
?>