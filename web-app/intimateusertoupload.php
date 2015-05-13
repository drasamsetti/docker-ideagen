<?php
error_reporting(0);
include "header-main.php";

 $auth=$_SESSION['auth_no'];
 
 $req_no = $_GET['req_no'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
	$email = $_SESSION['short_id'];
	$reviewer_type=$_SESSION['role'];
	$comments=mysql_real_escape_string($_POST['cscprcomments']);
	$curr_status = "1";
	
	$sql="update `csc_lr_experiment_req` set `experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;

//echo $sql;

mysql_query($sql);

$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','Idea Winner notified')";

mysql_query($sqlins);

echo "Idea Winner Notified, to upload the relevant IRB templates";

echo "<meta http-equiv='refresh' content='5;url=ideaspendingmyapproval.php'>";
	



?>



<?php
//}
include "footer.php";
?>