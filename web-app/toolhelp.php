<?php
error_reporting(0);

include "header-main.php";

$auth=$_SESSION['auth_no'];
 $email=$_SESSION['short_id']; 
 
 if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}
 
 ?>
 <div width="600px">
 <table width="100%">
 <tr><td width="90%">
 <?php
 include "IdeaGenV3.1-UserManual_v1.0.htm";
 ?>
 </td></tr>
 </table>
 </div>
 <br/>
 <?php
include "footer.php";
?>