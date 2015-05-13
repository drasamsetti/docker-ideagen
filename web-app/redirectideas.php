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
	//$auth=$_SESSION['auth_no'];
	
	
	
	$req_no;
	if ($_GET['req_no']<>"")
	{
		$req_no = $_GET['req_no'];
	}
	
	if ($_GET['val']<>"")
	{
		$val=$_GET['val'];
	}
	//echo "Value of val :".$val."<br/>";
	$auth=$_SESSION['auth_no'];
	$reviewer_type=$_SESSION['role'];
	$email=$_SESSION['short_id']; 
	
	if($auth==0)
	{
		echo "<h1>you are not authorised </h1>";
		die;
	}

	$sql="select * from csc_lr_experiment_req where request_num='$req_no'";
	$skill_metadatas=mysql_query($sql);
	
	if (isset($_REQUEST['btnsubmit']))
	{
		$req_no = $_POST['req_no'];
		$regionid = $_POST['region'];
	
		$updqry="update csc_lr_experiment_req set region_id='$regionid' where request_num='$req_no'";
		
		//echo "<br/>Update : ".$updqry;
		mysql_query($updqry);
		
		$comments="Changed the region to appropriate idea origin";
		$action_taken="Idea Redirected";
		
		$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";

		mysql_query($sqlins);
		
		echo "<div align=\"center\">The Region has been changed as appropriate for the selected idea ".".</div>";
			echo "<br /><br /><div align='center'><input type='button' name='ok' value='Ok' onclick='window.location=\"viewredirectideas.php\"'></input></div>";

		
		//echo "The Region has been changed as appropriate for the selected idea ";
	}
	else
	{
	
?>
<script  type="text/javascript">
function check()
{
	//alert ('Selected Value '+document.redirectideastoregionalcto.region.value);
}

</script>
<form name="redirectideastoregionalcto" action="redirectideas.php" method="POST">
<?php
if ($_SESSION['role']>='11' && $_SESSION['role']<'19')
	{
	?>
	<br/><br/>
		<table id="skillview" width="100%" >
		<tr><th colspan="2" class="theme-details-l">Select Appropriate Regional CTO to redirect the Idea</th></tr>
		<!--<tr align="left"><th>Idea Theme</th><th>Experiment / Project</th><th>Overview</th><!--<th>Owner</th><th>Status</th></tr>-->
		<?php
		while($row = mysql_fetch_array($skill_metadatas))
		{
			$regionsql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'region'";
			$regqry=mysql_query($regionsql);
			
			
		?>
		<tr class="alt"><td>Select Appropriate Region for this Idea : </td><td><select name="region" class="controltext" onchange="check()">
<?php		
			while($regchk = mysql_fetch_array($regqry))
			{
				if ($row['region_id']<>$regchk['meta_code'])
				{
			?>
			<option value="<?php echo $regchk['meta_code'];?>"><?php echo $regchk['meta_text']; ?></option>
			<?php
				}
			}
		
		}
	}
?></select>
<input type="hidden" name="req_no" value="<?php echo $req_no; ?>"></td></tr>
<tr><td colspan="2" align="right"><input type="submit" name="btnsubmit" class="controltext" value="Change Region for the selected Idea" /></td></tr>
</table>
</form>

<?php
	}
?>

<br/><br/><br/><br/>
<?php

include "footer.php";
?>