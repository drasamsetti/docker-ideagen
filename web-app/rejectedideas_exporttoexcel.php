<?php
	error_reporting(0);
	/*
		Place code to connect to your DB here.
	*/
	//include('config.php');	// include your code to connect to DB.
	//include('header.php');
	//include "header-main.php";
	include "check-session.php";
	include "connection.php";
	
	$auth=$_SESSION['auth_no'];
	 
	if($auth==0)
	{
		echo "<h1>you are not authorised </h1>";
		die;
	}
	
	//$filename = "ideagen_ideas_For_IW_Eval"."_".date('Ymd_hi').".xlsx";
	$filename = "ideagen_ideas_For_IW_Eval"."_".date('Ymd_hi').".xls";

	//header('Content-Transfer-Encoding: none');
	header("Content-Type: text/plain");
    header("Content-Type: application/vnd.ms-excel");                 // This should work for IE & Opera
    //header("Content-type: application/x-msexcel");                    // This should work for the rest
	//header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;");   // This is for saving in .xlsx format 
	
	
    //header("Content-Disposition: attachment; filename=\"$filename\""); 
    //header("Content-Type: application/vnd.ms-excel;charset=UTF-16LE");

	//header("Content-Disposition:inline;filename=$filename;");
	header("Content-Disposition:attachment;filename=$filename;");
	
?>
<head>
<style type="text/css">
p, td
{
	font-family:"Calibri";
	font-size:13px;
	vertical-align: middle;
}

th
{
	background-color:#6E6E6E;
	border: 1px solid #6E6E6E;
	color:#FFFFFF;
	font-family:"Calibri";
	font-size:14px;
}

#skillview
{
	border: 2px solid #BDBDBD;
	border-collapse:collapse;
}

#skillview td
{
	background-color:#BDBDBD;
	border: 1px solid #BDBDBD;
	padding:3px 3px 2px 3px;
}

#skillview tr.alt td
{
	background-color:#E6E6E6;
}
</style>
</head>
<?php 

/* Query on the Asset Tag coming from View Asset Page to get the record */

$skillquery="SELECT * FROM csc_lr_experiment_req where experiment_current_snapshot='800' order by request_theme";


$result = mysql_query($skillquery) or die("Could not execute query because: ".mysql_error());
// if(mysql_num_rows($result))
// {
	// echo "records are present!!!";
// }
// else
// {
	// echo "No Record Present !!!";
// }

// $tmpCounter=1;


//while( ($skillrow = mysql_fetch_object($result)) > 0)
//{
?>
<br/><br/>
<table id="skillview">
<tr><th>S.No.</th><th>Request Theme</th><th>Experiment / Project</th><th>Overview</th><th>Experiment Snapshot Status</th></tr>

	<?php
		$rowcnt=1;
		while($row = mysql_fetch_array($result))
		{
			$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' and meta_code = ".$row['request_theme'];
			$request_themes=mysql_query($sql);
			$reqtheme;
			while($request_theme = mysql_fetch_array($request_themes))
			{
				$reqtheme = $request_theme['meta_text'];
			}
			
			//Use Case retrieval part starts here
			/*
			$sqluc="select meta_text from skill_metadata where meta_code=".$row['skill_usecase_id'];
			$ucqry=mysql_query($sqluc);
			$uctext;
			while( $ucrow=mysql_fetch_array($ucqry) )
			{
				$uctext=$ucrow['meta_text'];
			}
			*/
			//Use case retrieval part ends here
			
			// Domain retrieval part starts here
			/*
			$domsql="select skill_id, domain_id from skill_domain_map where skill_id=".$row['id'];
			$domresult=mysql_query($domsql);
			$skilldomain=null;
			while($skill_domsql = mysql_fetch_array($domresult))
			{
				$sql="select meta_text from skill_metadata where meta_name = 'CTO' and meta_type = 'skill_domain' and meta_code=".$skill_domsql['domain_id'];
				$skill_domains=mysql_query($sql);
				while($skill_domain = mysql_fetch_array($skill_domains))
				{
					if ($skilldomain == "")
					{
						$skilldomain = $skill_domain['meta_text'];
					}
					else
					{
						$skilldomain = $skilldomain . "," . $skill_domain['meta_text'];
					}
				}
			}
			*/
			// Domain retrieval part ends here
			
			//Skill Category retrieval starts here
			$sql="select meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
			$experiment_snapshots=mysql_query($sql);
			$expsnapshot;
			while($experiment_snapshot = mysql_fetch_array($experiment_snapshots))
			{
				$expsnapshot = $experiment_snapshot['meta_text'];
			}
			//Skill Category retrieval ends here
			
			//Skill Status retrieval Starts here
			/*$sql="select meta_text from rm_skill_metadata where meta_name = 'CTO' and meta_type = 'skill_status' and meta_code = ".$row['skill_status_id'];
			$skill_platforms=mysql_query($sql);
			$skillplatform;
			while($skill_platform = mysql_fetch_array($skill_platforms))
			{
				$skillplatform = $skill_platform['meta_text'];
			}
			//Skill Status retrieval ends here
			
			/*
			$sql="select meta_text from skill_metadata where meta_name = 'CTO' and meta_type = 'skill_os' and meta_code = ".$row['skill_osid'];
			$skill_oss=mysql_query($sql);
			$skillos;
			while($skill_os = mysql_fetch_array($skill_oss))
			{
				$skillos = $skill_os['meta_text'];
			}
			$sql="select meta_text from skill_metadata where meta_name = 'CTO' and meta_type = 'skill_certificate' and meta_code = ".$row['skill_certification'];
			$skill_certificates=mysql_query($sql);
			$skillcert;
			while($skill_certificate = mysql_fetch_array($skill_certificates))
			{
				$skillcert = $skill_certificate['meta_text'];
			}
			*/
			if ($rowcnt%2 == 1)
			{
	?>
				<tr>
				<td><?php print $rowcnt; ?></td>
				<td><?php print $reqtheme; ?></td>
				<td><?php print $row['expt_shortname']; ?></td>
				<td><?php print $row['overview']; ?></td>
				<td><?php print $expsnapshot; ?></td>
				</tr>
		<?php	
			}		
			else
			{
		?>
				<tr class="alt">
				<td><?php print $rowcnt; ?></td>
				<td><?php print $reqtheme; ?></td>
				<td><?php print $row['expt_shortname']; ?></td>
				<td><?php print $row['overview']; ?></td>
				<td><?php print $expsnapshot; ?></td>
				</tr>		
		<?php
			}
			$rowcnt++;
		}
	?>
</table>
<br/><br/>

<?php
//}

?>
	
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