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
	$sql = "SELECT * FROM  `csc_lr_experiment_req` where `owner_email_id`='$owneremail' and (`experiment_current_snapshot`='1' or `experiment_current_snapshot`='511' or `experiment_current_snapshot`>'100' and `experiment_current_snapshot`<'171' or `experiment_current_snapshot`='211')";
	$winningidea = mysql_query($sql);

	
	
?>

<form name="account">
	<br/><br/>
		<table id="skillview" width="100%">
		<tr><th colspan="5" class="theme-details-l">View Winning Ideas</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th>--><th>Status</th><th>Link To IRB Template Update</th></tr>
		<?php
		while($row = mysql_fetch_array($winningidea))
		{
		$themesql="select * from csc_lr_metadata where meta_type='request_theme' and meta_code=".$row['request_theme'];
		$req_theme=mysql_query($themesql);
		
		$sqlirbqry = "select count(*) as cnt from `trans_master` where `req_no`='".$row['request_num']."' and `action_taken`='Completed Lean Template Details'";
		$irbqry=mysql_query($sqlirbqry);
		
		$irbflag;
		while($irbtempl = mysql_fetch_array($irbqry))
		{
			$irbflag=$irbtempl['cnt'];
		}
		
		//echo 'IRB Flag'.$irbflag;
		
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
					<td><?php if ($expt_snapshots_name<>'Submitted for IRB Review') { ?><a href="completeideatomovefwd.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php } else { print $row['expt_shortname']; }?></td>	
					<td><?php print $row['overview']; ?></td>	
					<!--<td><?php print $row['owner_short_id']; ?></td>	-->
					<td><?php print $expt_snapshots_name; ?></td>	
					<td><?php if (($irbflag > 0) && ($expt_snapshots_name<>'Submitted for IRB Review')) { ?><a href="updateanduploadIRBTemplate.php?req_no=<?php echo $row['request_num']?>" >Update IRB Template</a><?php } ?></td>	
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $reqt_theme['meta_text']; ?></td>
					<td><?php if ($expt_snapshots_name<>'Submitted for IRB Review') { ?><a href="completeideatomovefwd.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a><?php } else { print $row['expt_shortname']; }?></td>	
					<td><?php print $row['overview']; ?></td>
					<!--<td><?php print $row['owner_short_id']; ?></td>					-->
					<td><?php print $expt_snapshots_name; ?></td>
					<td><?php if (($irbflag > 0) && ($expt_snapshots_name<>'Submitted for IRB Review')) { ?><a href="updateanduploadIRBTemplate.php?req_no=<?php echo $row['request_num']?>" >Update IRB Template</a><?php } ?></td>	
				</tr>	
			<?php
			}
			}
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