<?php

	//tmplate code start
	//require_once('config.php'); //this assumes your page is in a sub dir.
	//include('headercss.php');
	include "check-session.php";
	include "connection.php";
	
	$auth=$_SESSION['auth_no'];
	 
	if($auth==0)
	{
		echo "<h1>you are not authorised </h1>";
		die;
	}

	$RequestNo = $_GET['req_no'];
	
	$cnt=1;
	

		$sql="select * from trans_master where req_no='$RequestNo'";
		$skill_metadatas=mysql_query($sql);
		
		$sqlqry="select * from csc_lr_experiment_req where request_num='$RequestNo'";
		$votingresult=mysql_query($sqlqry);
		$curr_status;
		while($votingchk = mysql_fetch_array($votingresult))
		{
			$curr_status=$votingchk['experiment_current_snapshot'];
		}
		
		//echo "Trans SQL ".$sql;
		$currtime=time();
		$gmdate=gmdate("Y-m-d h:i:s",time());
		//echo "Current Time : ".$currtime;
		//echo "<br/>Date is : ".$gmdate;
	?>
<head>
	<link href="table/table.css" rel="stylesheet" type="text/css" />
</head>
	<form name="account">
	
		<table id="skillview" >
		<tr><th>Login User</th><th>Email ID</th><th>Comments</th><th>Action Taken</th><th>Reviewed on Date</th></tr>
		<?php
		$flag=1;
		while($row = mysql_fetch_array($skill_metadatas))
		{
			$revsql="select * from role_master where id=".$row['reviewer_type'];
			$revdets=mysql_query($revsql);
			//echo "<br/>Role sql ".$revsql;
			
			while($revtype = mysql_fetch_array($revdets))
			{
				$revname = $revtype['role_name'];
			if (($curr_status=='241') && ($row['action_taken']=='Submitted Voting'))
			{
				if ($flag=='1')
				{
				?>
				<tr>
					<td><?php print $revname; ?></td>
					<td><?php print 'Voting in Progress'; ?></td>	
					<td><?php print 'Voting in Progress'; ?></td>	
					<td><?php print 'Voting in Progress'; ?></td>	
					<!--<td><?php print gmdate("Y-m-d H:i:s T",time($row['trans_timestamp'])); ?></td>	-->
					<td><?php print $row['trans_timestamp']; ?></td>
				</tr>	
				<?php
				$flag=$flag+1;
				}
			}
			else
			{
			if ($cnt%2 == 1)
			{
				//date_default_timezone_set($str_user_timezone);				
				//$str_date=$row['trans_timestamp']->format('Y-m-d H:i:s');
				//$str_utc_time=gmdate("Y-m-d H:i:s T",strtotime($str_date));
			?>
				<tr>
					<td><?php print $revname; ?></td>
					<td><?php print $row['email_id']; ?></td>	
					<td><?php print $row['comments']; ?></td>	
					<td><?php print $row['action_taken']; ?></td>	
					<!--<td><?php print gmdate("Y-m-d H:i:s T",time($row['trans_timestamp'])); ?></td>	-->
					<td><?php print $row['trans_timestamp']; ?></td>
				</tr>	
			<?php
			}
			else
			{
			?>
				<tr class="alt">
					<td><?php print $revname; ?></td>
					<td><?php print $row['email_id']; ?></td>	
					<td><?php print $row['comments']; ?></td>	
					<td><?php print $row['action_taken']; ?></td>	
					<td><?php print $row['trans_timestamp']; ?></td>	
				</tr>	
			<?php
			}
			}
			$cnt++;
			
			}
		}
		if ($cnt==1)
		{
			echo "<br/>There are no Review Comments available for this idea, to display !!! <br/>";
		}
		?>
			
		</table>
		<!--<table width = "100%" cellpadding = "2" cellspacing = "0" style = "font-size:0.9em">
		</table>-->
	<p align="center"><input type="button" name="btnClose" id="btdClose" Value="Close" onclick="javascript:window.close()"></p>
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