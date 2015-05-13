<?php
error_reporting(0);
//////////////////////////////////////////////////////////////////////////////////////////
//                                                                       	   			//
// NOTICE OF COPYRIGHT                                                   	   			//
//                                                                       	   			//
//                                                                       	   			//
//Copyright (C) 2010 onwards  Computer Sciences Corporation  http://www.csc.com    		//
//                                                                       	   			//
// This program is free software: you can redistribute it and/or modify  	   			//
// it under the terms of the GNU General Public License as published by  	   			//
// the Free Software Foundation, either version 3 of the License, or     	   			//
// (at your option) any later version.                                   	   			//
//                                                                                 		//
// This program is distributed in the hope that it will be useful,                 		//
// but WITHOUT ANY WARRANTY; without even the implied warranty of                  		//
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                   		//
// GNU General Public License for more details.                                    		//
//                                                                                 		//
//  You should have received a copy of the GNU General Public License              		//
//  along with this program.If not, see <http://www.gnu.org/licenses/>.            		//
//							                           									//
// @Created by Biswakalyana Mohanty                                                      //
// @date 2013-10-21                                                      	   			//
// @version 1.0								       										//
// @description:                             	    //
//                                                                              		//
//////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];
 $reviewer_type=$_SESSION['role'];
 $prev_status=mysql_real_escape_string($_POST['cscprcurrstatus']);
 $techreq=mysql_real_escape_string($_POST['cscprtechreq']);
 $busifund=mysql_real_escape_string($_POST['cscprfundhid']);
 
if ($reviewer_type=='2')
	{
		if (isset($_REQUEST['prapproved']))
			$curr_status='200'; //Transient Status is 121
		elseif(isset($_REQUEST['prrejected']))
			$curr_status='111';
		else
			$curr_status='131';	
	}
elseif ($reviewer_type=='3') 
	{
		if (isset($_REQUEST['prapproved']))
			$curr_status='300'; //Transient Status is 221
		elseif(isset($_REQUEST['prrejected']))
			$curr_status='211';
		else
			$curr_status='231';	
	}
elseif ($reviewer_type=='5') 
	{
		if ($prev_status=="300")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='311';
			/*elseif(isset($_REQUEST['prrejected']))
				$curr_status='401';
			else
				$curr_status='431';*/
		}
		elseif ($prev_status=="311")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='400'; //Transient Status is 321
			/*elseif(isset($_REQUEST['prrejected']))
				$curr_status='401';
			else
				$curr_status='431';	*/	
		}
		elseif ($prev_status=="700")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='711'; 
		}
		elseif ($prev_status=="711")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='731'; //Transient Status is 721
		}
	}
elseif ($reviewer_type=='7') 
	{
		if (($prev_status=="400") && ($busifund=="Yes"))
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='700'; //As Business Funding is Yes
			elseif(isset($_REQUEST['prrejected']))
				$curr_status='411';
			else
				$curr_status='471';		
		}
		elseif (($prev_status=="400") && ($busifund=="No"))
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='441'; //Transient Status is 421, 431
			elseif(isset($_REQUEST['prrejected']))
				$curr_status='411';
			else
				$curr_status='471';		
		}	
		elseif ($prev_status=="441")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='600'; //Transient Status is 461
			elseif(isset($_REQUEST['prrejected']))
				$curr_status='451';
			else
				$curr_status='471';		
		}	
		/*elseif ($prev_status=="471")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='600'; //Transient Status is 481
			elseif(isset($_REQUEST['prrejected']))
				$curr_status='600';
			else
				$curr_status='600';		
		}		*/
	}
	elseif ($reviewer_type=='8') 
	{
		if ($prev_status=="600")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='611'; 
		}
		elseif ($prev_status=="611")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='621'; 
		}
		elseif ($prev_status=="621")
		{
			if (isset($_REQUEST['prapproved']))
				$curr_status='700'; 
		}
	}
	
//if($auth==0)
//{
 //   echo "<h1>you are not authorised </h1>";
 //   die;
//}

/****Fetch the value from previous page and assign it into variable ***/

	$comments=mysql_real_escape_string($_POST['cscprcomments']);
	$req_no=mysql_real_escape_string($_POST['cscprreqno']);
	$email=$_SESSION['short_id']; //$_SESSION['login'];

if(isset($_REQUEST['prapproved']))
{
			
//$sql = "INSERT INTO `csc_lr_experiment_req`(`request_theme`, `expt_shortname`, `overview`, `problem_statement`, `customer_segment`, `unique_value_proposition`, `solution_brief`, `solution_features`, `key_metric_1`, `key_metric_1_measure`, `key_metric_2`, `key_metric_2_measure`, `key_metric_3`, `key_metric_3_measure`, `primary_metrics_matters`, `channels`, `cost_structure`, `revenue_stream`, `revenue_stream_assumptions`, `unfair_advantage`, `funding_by_business`, `bu_sponsor`, `key_characteristics`, `owner_email_id`, `experiment_current_snapshot`) VALUES ('$req_theme','$expt_name','$overview','$prob_stat','$cust_seg','$uvp','$soln_desc','$soln_features','$metric1','$metric1_measure','$metric2','$metric2_measure','$metric3','$metric3_measure','$key_metric','$channel','$cost_struct','$rev_stream','$rev_stream_assess','$unfair_adv','$business_funded','$bu_sponsor','$key_characteristics','$email','101')";

$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;

//echo $sql;

mysql_query($sql);

if ($_SESSION['role']=='5')
{
	if ($prev_status=="300")
	{
		$action_taken="Idea Picked for POC Plan";
	}
	elseif ($prev_status=="311")
	{
		$action_taken="POC Plan Complete";
	}
	else
	{
		$action_taken="Status Update";
	}
}
else
{
	$action_taken="Approved";
}

$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','$action_taken')";

mysql_query($sqlins);

if (($_SESSION['role']=='5') && ($prev_status=="300"))
{
$sql="update `csc_lr_experiment_req` set `mentor_email_id`='$email' where `request_num`=".$req_no;

mysql_query($sql);
}

if (($_SESSION['role']=='5') || ($_SESSION['role']=='8'))
{
print "<br/><br/>Idea Status updated Successfully ";
print "<br/><br/>Notification will be sent (Work in Progress) ";
}
else
{
print "<br/><br/>Idea Approved Successfully ";
print "<br/><br/>Notification will be sent (Work in Progress) ";
}

echo "<meta http-equiv='refresh' content='5;url=ideaspendingmyapproval.php'>";

}
else if(isset($_REQUEST['prrejected']))
{
$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;

//echo $sql;

mysql_query($sql);

$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','Rejected')";

mysql_query($sqlins);

print "<br/><br/>Idea Rejected ";
print "<br/><br/>Notification will be sent to concerned resources (Work in Progress) ";

echo "<meta http-equiv='refresh' content='5;url=ideaspendingmyapproval.php'>";

}
else
{
$sql="update `csc_lr_experiment_req` set `Comments`='$comments',`experiment_current_snapshot`='$curr_status' where `request_num`=".$req_no;

//echo $sql;

mysql_query($sql);

$sqlins="INSERT INTO `trans_master`(`req_no`, `reviewer_type`, `email_id`, `comments`, `action_taken`) VALUES ('$req_no','$reviewer_type','$email','$comments','On Hold')";

mysql_query($sqlins);

print "<br/><br/>Idea put on Hold ";
print "<br/><br/>Notification will be sent (Work in Progress) ";


echo "<meta http-equiv='refresh' content='5;url=ideaspendingmyapproval.php'>";
}

include "footer.php";