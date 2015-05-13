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
		//$sql="select * from csc_lr_experiment_req order by request_theme";
		//$skill_metadatas=mysql_query($sql);
		
		/* Code for pagination starts here  */
		
		$tbl_name="csc_lr_experiment_req";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "viewsubmittedideas.php"; 	//your file name  (the name of this file)
	$limit = 20; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	/*if (($skill_usecase == "") || ($skill_usecase == 0))
	{
		$sql = "SELECT * FROM $tbl_name where skill_usecase_id=".$skill_usecase." LIMIT $start, $limit";
		$result = mysql_query($sql);
	}
	else
	{
	*/
		$sql = "SELECT * FROM $tbl_name order by request_theme LIMIT $start, $limit";
		$skill_metadatas = mysql_query($sql);
	//}
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"><img src='img/prev.gif' border='0' /> previous </a>";
		else
			$pagination.= "<span class=\"disabled\"><img src='img/prev.gif' border='0' /> previous </span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\" style=\"color:red;\">$counter </span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter </a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\" style=\"color:red;\">$counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2 </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\" style=\"color:red;\">$counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\" style=\"color:red;\">$counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter </a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\"> next  <img src='img/next.gif' border='0' /></a>";
		else
			$pagination.= "<span class=\"disabled\"> next  <img src='img/next.gif' border='0' /></span>";
		$pagination.= "</div>\n";		
	}

		$i=1;
		
		/* Code for pagination ends here */
	?>
<br/><br/>	
<?php echo $pagination; ?>

	<form name="account">
	<div align="right"><a href="viewmysubmittedideas.php">Show My Ideas</a></div>
	<br/><br/>
		<table id="skillview" width="100%">
		<tr><th colspan="5" class="theme-details-l">View All Ideas</th></tr>
		<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><th>Category</th><th>Status</th></tr>
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
					<td><a href="viewanidea.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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
					<td><a href="viewanidea.php?req_no=<?php echo $row['request_num']?>" ><?php print $row['expt_shortname']; ?></a></td>	
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