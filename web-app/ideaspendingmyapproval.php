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
	
	$cnt=1;
	$cnt1=1;
	
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
		
		//echo "Role ".$_SESSION['role']."<br/>";	
	?>

	<form name="account">
	<?php
	if (($_SESSION['role']=='2') && ($val==''))
	{
		
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ideas pending Confirmation</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		//if (($row['experiment_current_snapshot']=='0') || ($row['experiment_current_snapshot']=='171'))
		if ($row['experiment_current_snapshot']=='0')
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
					<td><?php if ($expt_snapshots_name=='Submitted for IRB Review') {?><a href="ideaunderreviews.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php } else { ?><a href="viewanideatoreturn.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php }?></td>	
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
					<td><?php if ($expt_snapshots_name=='Submitted for IRB Review') {?><a href="ideaunderreviews.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php } else { ?><a href="viewanideatoreturn.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php }?></td>	
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
		?>

		</table>
		<!--<div align="right">
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>
		<div>-->
		<?php
		//chk = md5(201f00b5ca5d65a1c118e5e32431514c);
		//echo "Value is ".chk;
	}
	elseif (($_SESSION['role']=='2') && ($val<>''))
	{
		
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ongoing Ideas pending for Confirmation</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		if ($row['experiment_current_snapshot']=='51') 
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
		?>

		</table>
		<!--<div align="right">
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>
		<div>-->
		<?php
		//chk = md5(201f00b5ca5d65a1c118e5e32431514c);
		//echo "Value is ".chk;
	}
	elseif ($_SESSION['role']=='3')
	{
	//echo "Role ".$_SESSION['role']."<br/>";	
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ideas pending My Approval</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		echo "Status ".$row['experiment_current_snapshot']."<br/>";
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		if (($row['experiment_current_snapshot']>='200') && ($row['experiment_current_snapshot']<'300'))
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
		?>

		</table>
		<!--<div align="right">
		<input type="button" name="export_report" value="Export to Spreadsheet">
		</div>
		<div>-->
		<?php
		//chk = md5(201f00b5ca5d65a1c118e5e32431514c);
		//echo "Value is ".chk;
	}
	elseif (($_SESSION['role']=='5') && ($val=="plan"))
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">
		Ideas Ready for ATD - For POC Plan
		</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		if (($row['experiment_current_snapshot']>='300') && ($row['experiment_current_snapshot']<'400'))
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
	elseif (($_SESSION['role']=='5') && ($val=="dev"))
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">
		Ideas Ready for ATD - For POC Development
		</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		if (($row['experiment_current_snapshot']>='300') && ($row['experiment_current_snapshot']<'400'))
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
	elseif ($_SESSION['role']>='11')
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ideas for my review</th></tr>
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
	elseif ($_SESSION['role']=='8')
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="4" class="theme-details-l">Ideas Ready for BU</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th></tr>
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		while($reqt_theme = mysql_fetch_array($req_theme))
		{
		if (($row['experiment_current_snapshot']>='600') && ($row['experiment_current_snapshot']<'700'))
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanideatoapprove.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
	else
	{
		echo "No experiment pending your approval, at this point of time";
	}
	if ($cnt==1)
		{
			echo "<br/>There are no Ideas, to display at this point of time <br/>";
		}
	
	?>
		<!--</div>
		<table width = "100%" cellpadding = "2" cellspacing = "0" style = "font-size:0.9em">
		</table>
	<p align="center"><input type="button" name="btnClose" id="btdClose" Value="Close" onclick="javascript:window.close()"></p>-->
	</table>
	
	</form>
	
	<br/><br/>
	<?php	
	//include('footer.php');

/*error handler function
function customError($errno, $errstr)
  {
  echo "<b>Error:</b> [$errno] $errstr";
  }

//set error handler
set_error_handler("customError");
*/
?>
<br/><br/><br/><br/>
<?php
//}
include "footer.php";
?>