<?php
error_reporting(0);
include "connection.php";

$shortid=$_GET['user'];

//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","Regional CTO" );
$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO","Ingenuity Worx");

$sqlqry="select * from role_trans where emp_short_id='$shortid'";
$roletrans=mysql_query($sqlqry);

$sqlmast="select * from role_master where id IN ( 2, 3, 4, 5, 7, 8, 9, 11 )";
$rolemaster=mysql_query($sqlmast);

echo '<select name="role" id="role" value="0"> <option>Select Role</option>';

/*while($roletranss=mysql_fetch_array($roletrans)) 
{


}*/
//while($rolemasters=mysql_fetch_array($rolemaster)) 
while($roletranss=mysql_fetch_array($roletrans)) 
{
	$tmproleid=$roletranss['role_id'];
	//if ($rolemasters['id']==$roletranss['role_id'])
	//{
		echo '<option value='.$tmproleid.'>'.$emp_role[$tmproleid].'</option>';
	//}
}


echo "</select>";
?>