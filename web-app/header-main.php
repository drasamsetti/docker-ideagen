<?php
	include "check-session.php";
	include "connection.php";
        $zz="";
     
	if(isset($_REQUEST['rolesubmit']))
	{
		$_SESSION['role']=$_REQUEST["login_role"];
	}	 
	
	
?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">-->
<!DOCTYPE html>
<html style="height: 99%"><head>
<meta charset="UTF-8">
	
		<!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">-->
		<title>Idea Generation</title>
		<script type="text/javascript" src="./date/js/datepicker.js"></script>
              <link href="./date/css/demo.css"       rel="stylesheet" type="text/css" />
              <link href="./date/css/datepicker.css" rel="stylesheet" type="text/css" />
              <link href="table/table.css" rel="stylesheet" type="text/css" />
			  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
			<link rel="icon" type="image/png" href="img/CSC_Icon.png" />
		<style type="text/css">
			/* Demo style */
			p
			        {
			        width:800px;
			        margin:0 auto 1.6em auto;
			        }
			        
			/* Pagination list styles */
			ul.fdtablePaginater
			        {
			        display:table;
			        list-style:none;
			        padding:0;
			        margin:0 auto;
			        text-align:center;
			        height:2em;
			        width:auto;
			        margin-bottom:2em;
			        }
			ul.fdtablePaginater li
			        {
			        display:table-cell;
			        padding-right:4px;
			        color:#666;
			        list-style:none;
			        
			        -moz-user-select:none;
			        -khtml-user-select:none;
			        }
			ul.fdtablePaginater li a.currentPage
			        {
			        border-color:#a84444 !important;
			        color:#000;
			        }
			ul.fdtablePaginater li a:active
			        {
			        border-color:#222 !important;
			        color:#222;
			        }
			ul.fdtablePaginater li a,
			ul.fdtablePaginater li div
			        {
			        display:block;
			        width:2em;
			        font-size:1em;
			        color:#666;
			        padding:0;
			        margin:0;
			        text-decoration:none;
			        outline:none;
			        border:1px solid #ccc;
			        font-family:georgia, serif;
			        }
			ul.fdtablePaginater li div
			        {
			        cursor:normal;
			        opacity:.5;
			        filter:alpha(opacity=50);
			        }
			ul.fdtablePaginater li a span,
			ul.fdtablePaginater li div span
			        {
			        display:block;
			        line-height:2em;
			        border:1px solid #fff;
			        background:#fff url(table/gradient.gif) repeat-x 0 -20px;
			        }
			ul.fdtablePaginater li a
			        {
			        cursor:pointer;
			        }
			ul.fdtablePaginater li a:focus
			        {
			        color:#333;
			        text-decoration:none;
			        border-color:#aaa;
			        }
			.fdtablePaginaterWrap
			        {
			        text-align:center;
			        clear:both;
			        text-decoration:none;
			        }
			ul.fdtablePaginater li .next-page span,
			ul.fdtablePaginater li .previous-page span,
			ul.fdtablePaginater li .first-page span,
			ul.fdtablePaginater li .last-page span
			        {
			        font-weight:bold !important;
			        }
			/* Keep the table columns an equal size during pagination */
			td.sized1
			        {
			        width:16em;
			        text-align:left;
			        }
			td.sized2
			        {
			        width:10em;
			        text-align:left;
			        }
			td.sized3
			        {
			        width:7em;
			        text-align:left;
			        }
			tfoot td
			        {
			        text-align:right;
			        font-weight:bold;
			        text-transform:uppercase;
			        letter-spacing:1px;
			        }
			#visibleTotal
			        {
			        text-align:center;
			        letter-spacing:auto;
			        }
			* html ul.fdtablePaginater li div span,
			* html ul.fdtablePaginater li div span
			        {
			        background:#eee;
			        }
			tr.invisibleRow
			        {
			        display:none;
			        }
		</style>
		
		
		
		<style type="text/css">
			body {
				font-family: verdana;
				background-color: #fff;
			}
			.FixedWidth {position:relative;width:100%;}
			.Rec {
				position: static;
				border: 1px solid #C1DAD7;
				background-color: #fff;
				color: #4f6b72;
				width: 95%;
				height: 100%;
				margin: 0px 5px 10px 5px;
				/*margin-bottom: 20px;*/
				text-align: center;
				font-size: 100%;
			}
			#Column1, #Column2, #Column3 {
				position: relative;
				float: left;
				width: 33%;
				height: 100%;
			}
			.Handle {
				width: auto;
				height: 18px;
				background-image: url(./table/bg_dashboard_rep.jpg);	
				background-repeat: repeat-x;
				border-bottom: 0;
				text-align: left;
				color: #4f6b72;
				letter-spacing: 1px;
				font-size: 100%;
				font-weight: bold;
				padding: 5px 4px;
				cursor: move;
			}	
			.Rec h1 {
				color: #ebebeb;
			}
			.Info {
				font-family: verdana;
				padding: 5px;
				text-align: left;
				font-size: 100%;
			}
		</style>
		
		<script type="text/javascript" src="table/tablesort.js"></script>
		<script type="text/javascript" src="table/paginate.js"></script>
		<link href="table/table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="yui/yahoo-dom-event/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="yui/dragdrop/dragdrop.js"></script>
		<script type="text/javascript" src="yui/dom/dom.js"></script>
		
		
		<style>
			A.menulink {
			display: block;
			text-align: left;
			text-decoration: none;
			font-family:arial;
			font-size:12px;
			color: #4f6b72;
			BORDER: none;
			border: solid 1px #FFFFFF;
			}
			
			A.menulink:hover {
			border: solid 1px #fff;
			background-color:#CAE8EA;
			}
			
		</style>
		
		
		<script type="text/javascript">
			function init() {
				var zIndex = 0;

				// BEGIN :: Non-draggable targets
				var col1Target = new YAHOO.util.DDTarget("Column1", "Group1");
				var col2Target = new YAHOO.util.DDTarget("Column2", "Group1");
				var col3Target = new YAHOO.util.DDTarget("Column3", "Group1");
				// END :: Non-draggable targets

				// BEGIN :: Objects to drag
				var rec1 = document.getElementById("Rec1");
				var rec2 = document.getElementById("Rec2");
				var rec3 = document.getElementById("Rec3");
				var rec4 = document.getElementById("Rec4");
				var rec5 = document.getElementById("Rec5");
				var rec6 = document.getElementById("Rec6");

				var rec1Drag = new YAHOO.util.DDProxy(rec1, "Group1");
				rec1Drag.setHandleElId("Rec1Handle");
				var rec2Drag = new YAHOO.util.DDProxy(rec2, "Group1");
				rec2Drag.setHandleElId("Rec2Handle");
				var rec3Drag = new YAHOO.util.DDProxy(rec3, "Group1");
				rec3Drag.setHandleElId("Rec3Handle");
				var rec4Drag = new YAHOO.util.DDProxy(rec4, "Group1");
				rec4Drag.setHandleElId("Rec4Handle");
				var rec5Drag = new YAHOO.util.DDProxy(rec5, "Group1");
				rec5Drag.setHandleElId("Rec5Handle");
				var rec6Drag = new YAHOO.util.DDProxy(rec6, "Group1");
				rec6Drag.setHandleElId("Rec6Handle");
				// END :: Objects to drag
				
				// BEGIN :: Event handlers
				var marker, container;
				var lastRectNode = [];
				marker = document.createElement("div");	

				rec1Drag.startDrag = rec2Drag.startDrag = rec3Drag.startDrag = rec4Drag.startDrag = rec5Drag.startDrag = rec6Drag.startDrag = function(x, y) {
					var dragEl = this.getDragEl(); 
					var el = this.getEl();
					container = el.parentNode;

					el.style.display = "none";
					dragEl.style.zIndex = ++zIndex;
					dragEl.innerHTML = el.innerHTML;
					dragEl.style.color = "#ebebeb";
					dragEl.style.backgroundColor = "#fff";
					dragEl.style.textAlign = "center";
					marker.style.display = "none";
					marker.style.height = YAHOO.util.Dom.getStyle(dragEl, "height");	
					marker.style.width = YAHOO.util.Dom.getStyle(dragEl, "width");
					marker.style.margin = "5px"; 
					marker.style.marginBottom = "20px"; 
					marker.style.border = "2px dashed #7e7e7e";
					marker.style.display= "block";
					container.insertBefore(marker, el);
				}
				col1Target.onDragEnter = col2Target.onDragEnter = col3Target.onDragEnter =  rec1Drag.onDragEnter = rec2Drag.onDragEnter = rec3Drag.onDragEnter = rec4Drag.onDragEnter = rec5Drag.onDragEnter = rec6Drag.onDragEnter = function(e, id) {
					var el = document.getElementById(id);
					if (id.substr(0, 6)	=== "Column") {
						el.appendChild(marker);
					} else {
						container = el.parentNode;
						container.insertBefore(marker, el);
					}
				}
				rec1Drag.onDragOut = rec2Drag.onDragOut = rec3Drag.onDragOut = rec4Drag.onDragOut = rec5Drag.onDragOut = rec6Drag.onDragOut = function(e, id) {
					var el = document.getElementById(id);
					lastRectNode[container.id] = getLastNode(container.lastChild);

					if (el.id === lastRectNode[container.id].id) {
						container.appendChild(marker);
					}	
				}
				rec1Drag.endDrag = rec2Drag.endDrag = rec3Drag.endDrag = rec4Drag.endDrag = rec5Drag.endDrag = rec6Drag.endDrag = function(e, id) {
					var el = this.getEl(); 
					try {
						marker = container.replaceChild(el, marker);
					} catch(err) {
						marker = marker.parentNode.replaceChild(el, marker);
					}	
					el.style.display = "block";
				}
				// END :: Event handlers
				
				// BEGIN :: Helper methods
				var getLastNode = function(lastChild) {
						var id = lastChild.id;
						if (id && id.substring(0, 3) === "Rec") {
							return lastChild;
						} 
						return getLastNode(lastChild.previousSibling);
				}
				var isEmpty = function(el) {
						var test = function(el) { 
							return ((el && el.id) ? el.id.substr(0, 3) == "Rec" : false);
						} 
						var kids = YAHOO.util.Dom.getChildrenBy(el, test);
						return (kids.length == 0 ? true : false);
				}
				// END :: Helper methods
			}
			
		function getXMLHTTP() 
		{ //fuction to return the xml http object
			var xmlhttp=false;	
			try
			{
				xmlhttp=new XMLHttpRequest();
			}
			catch(e)	
			{		
				try
				{			
					xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e)
				{
					try
					{
						xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch(e1)
					{
						xmlhttp=false;
					}
				}
			}
			return xmlhttp;
		}
		
		function populateroledd() 
		{		
			var shortId = document.getElementById('short_id').value;
			
			//alert ('Short id '+shortId);
			//var dptype = <?php echo $dptype; ?>;
			//var eventtype = 'l4';
			//var viewtype = '<?php echo $viewtype; ?>';

			var strURL="populate_role.php?user="+shortId;
			//alert ('URL '+strURL);
			var req = getXMLHTTP();

			if (req) 
			{
				req.onreadystatechange = function() 
				{
					if (req.readyState == 4) 
					{
						// only if "OK"
						if (req.status == 200) 
						{
							document.getElementById('rolediv').innerHTML=req.responseText;
							//document.getElementById('l4mgrdiv').innerHTML="<select><option value='0'>Select L4 Name</option></select>";
							//alert ('Value of Role Div '+document.getElementById('rolediv').innerHTML);
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}
				req.open("GET", strURL, true);
				req.send(null);
			}		
		}
		
		</script>
		
	</head>
	<body onload="init();" style="height: 99%">
	<table width="100%" class="main">
	<tr><td colspan="2" height="10%">
	<table cellspacing = "0" cellpadding = "0" border = "0" width="100%" class="main" style = "border:0px solid black">
	<tr>
		<td width = "205"><a href = "index.php"><img src = "images/logo.png" border = "0" ></a></td>
		<td valign = "bottom" align = "right">

			<?php
				if(!$logged)
				{
					?>
					<form name="login_form" method="POST" action="login.php">
					<input type="hidden" name="pre_referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
					<table>
						<tr><td>Email</td><td><input type="text" name="short_id" id="short_id" onchange="populateroledd()"></td></tr>
						<tr><td valign="top">Password</td><td><input type="password" name="password"></td></tr>
						<tr><td valign="top">Login as </td><td><div id="rolediv"><select id="role" name="role" ><option value="0">Select Role</option></select></div></td></tr>
						<tr><td align="left" colspan='2'><a href="register.php">Register</a>&nbsp;&nbsp; <!--| <a href='csc_lr_forgetpw.php'>Forgot Password</a>--> <input type="submit" name="submit" value="Login"></td></tr>
					</table>
					</form>

					<?php
				}
				else
				{
				
				//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","Regional CTO");
				//$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO");
				
				$rolesql="select * from role_trans where emp_short_id='".$_SESSION['short_id']."'";
				$my_role=mysql_query($rolesql);
				//echo "<br/>Role SQL ".$rolesql;
				$k=1;
				$comma=',';
				$existingroles;
				$tmproleid;
				while($my_roles = mysql_fetch_array($my_role))
					{
						$tmprole = $my_roles['role_id'];
						//while($key_roles = mysql_fetch_array($key_role))
						//{
		
						if ($k==1)
						{
							$existingroles = $_SESSION['emp_role'][$tmprole];
							$tmproleid = $my_roles['role_id'];
						}
						else
						{
							$existingroles = $existingroles.$comma.$_SESSION['emp_role'][$tmprole];
							$tmproleid = $tmproleid.$comma.$my_roles['role_id'];
						}
						$k=$k+1;
						//}
					}
					$chkrole = explode(',',$tmproleid);
					$chkcnt=count($chkrole);
                                    
                                    
                                   // echo $_SESSION['account'];
                                        $account=$_SESSION['account'];

                              $q_acc_name="Select name from account_master  where id=$account";
                             $result=  mysql_query($q_acc_name);
                               $row_acc_name=  mysql_fetch_array($result);
$zz="You Logged In Account : ".$row_acc_name['name'];
$_SESSION['account_name']=$row_acc_name['name'];

					echo "Welcome ".$_SESSION['name'];
                                        
                                        $temp=$_SESSION['role'];
										//echo "<br>logged in as ".$_SESSION['role'];
                                        echo "<br>Logged in as ".$_SESSION['emp_role'][$temp];
                                        //echo "<br>Last Role ".$_SESSION['lastrole'];
										//echo "<br>Short ID ".$_SESSION['short_id'];
										if ($chkcnt>1)
										{
											echo "<br><a href=\"roleselect.php?user=".$_SESSION['short_id']."\">Change Role</a> | <a href=\"logout.php\">Logout</a>"; //<a href='change-password.php'>Change Password</a> |
										}
										else
										{
											echo "<br> <a href=\"logout.php\">Logout</a>"; //<a href='change-password.php'>Change Password</a> |
										}
				}
			?>
			<table style="margin-top:10px;padding:0px;border:0px solid" cellpadding="0" cellspacing="0" width="100%" >
				<tbody>
					<tr height = "33">
                                                <td style = "background:#ccc;" align = 'left'><b> <?php //echo $zz; ?></b></td>
						<!--<td style = "background:#ccc;" align = 'right'><b><a href="http://innovation.in.csc.com">Office of Innovation</a> | <a href="http://www.csc.com">Global Site</a> | <a href="help/index.php?page=<?php echo $_SERVER['SCRIPT_NAME']; ?>" target="_blank">Help</a></b></td>-->
						<td style = "background:url('images/footer-csc.gif') center right no-repeat;width:120px;"></td>
					</tr>
				</tbody>
			</table>
			<div style = "height:5px;"></div>
		</td>
		<td align="right">
			
			
		</td>
	</tr>
	</table></td></tr>
	
	<tr>
		<?php 
		if(isset($_SESSION['short_id']))
		{
                    
                    // add  By R on 06-07
                // echo "<h1>welcome </h1>".$_SESSION['auth_no'];
                    $auth_no=$_SESSION['auth_no'];
                    if($auth_no==0)
                    {
                        die;
                    }


			if($_COOKIE['login'] == $_SESSION['login'])
		  	 {
				$logged = true;
			
		       }
			  else
			  {
				$logged = false;
                        $_SESSION['auth_no']="0";

                        
                        session_destroy();

		?>


		<script>
            alert("!!! Sorry, Your Session has been Expired Please Login again");
            window.location="index.php";
        	</script>
            <?php
                        die;
		 }
		?>
	
		<td valign="top" width="15%" style="padding: 0px;">
		<table cellpadding = "3" cellspacing = "1" style = "border: 1px solid #C1DAD7;margin-top:1px;" width="185px">
		  <tr>
		    <th class="theme-details-m"><b>Main Menu</b></th>
		  </tr>
			<?php
			if(isset($_SESSION['role']))
			{
				if ($_SESSION['role']=='4')
				{
				?>
				<tr>
					<td><a href="create-openidea.php" class="menulink" class=&{ns4class};>Submit Idea</a></td>
				</tr>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="viewupdateuploadIRBTemplate.php" class="menulink" class=&{ns4class};>Complete IRB Template</a></td> 
				</tr>				
				<?php
				}
				if ($_SESSION['role']=='2')
				{
				?>
				<tr>
				    <td><a href="capture-winningidea.php" class="menulink" class=&{ns4class};>Capture Winning Idea</a></td>
				</tr>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="ideaspendingmyapproval.php" class="menulink" class=&{ns4class};>Ideas pending Confirmation</a></td>
				</tr>				
				<tr>
					<td><a href="viewtiedideas.php" class="menulink" class=&{ns4class};>View Tied Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="viewrejectedideas.php" class="menulink" class=&{ns4class};>View Rejected Ideas</a></td>
				</tr>
				<tr>
					<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td> 
				</tr>
				<?php
				}
				if ($_SESSION['role']=='5')
				{
				?>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><!--<a href="ideaspendingmyapproval.php?val=plan" class="menulink" class=&{ns4class};>Ideas Ready for ATD - POC Plan</a>
					<br/>--><a href="ideaspendingmyapproval.php?val=dev" class="menulink" class=&{ns4class};>Ideas Ready for ATD - POC Development</a>
					</td>
				</tr>
				<?php
				}
				if ($_SESSION['role']=='7')
				{
				?>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="ideaspendingmyapproval.php" class="menulink" class=&{ns4class};>Ideas for my review</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td> 
				</tr>
				<?php
				}
				if ($_SESSION['role']=='9')
				{
				?>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="viewirbreviewideasvoting.php" class="menulink" class=&{ns4class};>Ideas for my review</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td> 
				</tr>
				<?php
				}
				if (($_SESSION['role']>='11') && ($_SESSION['role']<'19'))
				{
				?>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="ideaspendingmyapproval.php" class="menulink" class=&{ns4class};>Ideas for my review</a></td>
				</tr>
				<!--<tr>
					<td><a href="viewredirectideas.php" class="menulink" class=&{ns4class};>Redirect Ideas</a></td>
				</tr>-->
				<tr><td><hr></td></tr>
				<tr>
					<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td> 
				</tr>
				<?php
				}
				if ($_SESSION['role']=='19')
				{
				?>
				<tr>
					<td><a href="ideasforingenuityworxstream.php" class="menulink" class=&{ns4class};>Ideas for Ingenuity Worx Evaluation</a></td>
				</tr>
				<?php
				}
				if ($_SESSION['role']=='1')
				{
				?>
				<tr>
					<td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				<tr><td><hr></td></tr>
                <tr>
					<td><a href="new-user.php" class="menulink" class=&{ns4class};>New User's Request</a></td>
				</tr>
                <tr>
					<td><a href="view_manage_users.php" class="menulink" class=&{ns4class};>Manage Registered Users</a></td>
				</tr>
				<?php
				}
				?>
				<tr><td><hr></td></tr>
                <tr>
					<td><a href="toolhelp.php" class="menulink" class=&{ns4class};>Help</a></td>
				</tr>
				<?php
			}
			
			
			/*			
			
			if ($_SESSION['role']!='4')
			{
				//if ($_SESSION['role']!='5')
				//{
			?>
			<!--<tr>
			    <td><a href="dashboard.php" class="menulink" class=&{ns4class};>Operations Dashboard</a></td>
			</tr>
			<tr>
			    <!--<td><a href="dash.php" class="menulink" class=&{ns4class};>Generate Report</a></td>
				<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td>
			</tr>
			<tr><td><hr></td></tr>-->
		  	<?php
				//}
			}
                        //R
                        
		  	$query1="select id from role_master where role_name='admin'";
		  	$query2="select id from role_master where role_name='Challenger'";
		  	$query3="select id from role_master where role_name='ATD'";
		  	$result1=mysql_query($query1) or die ("Could not execute query ($query1) because ".mysql_error());
		  	$result2=mysql_query($query2) or die ("Could not execute query ($query2) because ".mysql_error());
		  	$result3=mysql_query($query3) or die ("Could not execute query ($query3) because ".mysql_error());
		  	$row1=mysql_fetch_array($result1);
		  	$row2=mysql_fetch_array($result2);
		  	$row3=mysql_fetch_array($result3);
                     
                        //Kalpik :if($_SESSION['role']==$row2['id']||$_SESSION['role']==$row1['id'])
                          // RAj:
		  	//if($_SESSION['role']==$row2['id'])
			if($_SESSION['role']==$row1['id'])
		  	{  
                           
                           ?>
		  			<!--<tr>
					    <td><a href="create-theme.php" class="menulink" class=&{ns4class};>Create a Theme</a></td>
					</tr>-->
				<?php
                            
		  	}
		  	if(isset($_SESSION['role']))
		  	{
		  		?>
				<!--
			  	<tr>
				    <td><a href="view-themes.php?status=open" class="menulink" class=&{ns4class};>View Open Themes</a></td>
				</tr>
				<tr>
				    <td><a href="view-themes.php?status=closed" class="menulink" class=&{ns4class};>View Closed Themes</a></td>
				</tr>
				<tr>
				    <td><a href="search-themes.php" class="menulink" class=&{ns4class};>Search for themes</a></td>
				</tr>
                                <tr>
				    <td><a href="challenge_view.php" class="menulink" class=&{ns4class};>View Challenges</a></td>
				</tr>
				<tr><td><hr></hr></td></tr>
				-->
				<?php
					if ($_SESSION['role']!='4')
					{
						if ($_SESSION['role']=='7')
						{
				?>
                               <!--   <tr>
				    <td><a href="challenge_put.php" class="menulink" class=&{ns4class};>Define Challenge</a></td>
					</tr>-->
					<?php
						}
					}
					
					?>
					<!--<tr>
				    <td><a href="view-challenges.php" class="menulink" class=&{ns4class};>View Challenges</a></td>					
				</tr>
				<tr><td><hr></td></tr>-->
                                <?php
                                if($_SESSION['role']=='1') //|| $_SESSION['role']=='5' )
                                {
                                ?>
				

                                   <?php }
                                   else {
                                   ?>
                                <tr>
				    <td><a href="create-openidea.php" class="menulink" class=&{ns4class};>Capture Winning Idea</a></td>
				</tr>
                                  

                                 <?php
                                   }
                                 ?>

				<tr>
				    <td><a href="viewsubmittedideas.php" class="menulink" class=&{ns4class};>View Ideas</a></td>
				</tr>
				
				
				<!--<tr>
				    <td><a href="view-openidea.php?status=closed" class="menulink" class=&{ns4class};>View Challenges</a></td>
				</tr>-->
				<?php
					if ($_SESSION['role']!='4')
					{
				?>
				<tr><td><hr></td></tr>
				<?php
					if ($_SESSION['role']=='5')
					{
					?>
				<tr>
					
					<td><!--<a href="ideaspendingmyapproval.php?val=plan" class="menulink" class=&{ns4class};>Ideas Ready for ATD - POC Plan</a>
					<br/>--><a href="ideaspendingmyapproval.php?val=dev" class="menulink" class=&{ns4class};>Ideas Ready for ATD - POC Development</a>
					</td>
					<?php 
					}
					elseif ($_SESSION['role']<>'1')
					{
					?>
					<td><a href="ideaspendingmyapproval.php" class="menulink" class=&{ns4class};>
					<?php
					if ($_SESSION['role']=='8')
					{
					?>
					Ideas Ready for BU
					<?php
					}
					elseif ($_SESSION['role']=='2')
					{
					?>
					Ideas Pending for Confirmation
					<?php
					}
					?>
					</a></td>
					</tr>
					
					<?php
					}
					if ($_SESSION['role']=='9')
					{
					?>
						<!--<tr><td><hr></td></tr>-->
						<tr>
							<td><a href="viewirbreviewideas.php" class="menulink" class=&{ns4class};>Ideas Under IRB Review</a></td> 
						</tr>
					<?php
					}					
					?>
				<tr><td><hr></td></tr>
				<!--<tr>
					<td><a href="labexptideas.php" class="menulink" class=&{ns4class};>Lab Experiment Ideas</a></td> 
				</tr>-->
				<tr>
					<td><a href="exptviewdetails.php" class="menulink" class=&{ns4class};>Generate Report</a></td> 
				</tr>
				 <!--<tr>   
					<td><a href="search-idea.php" class="menulink" class=&{ns4class};>Search Idea</a></td>
				</tr>-->
				<?
					}
					else
					{
						?>
						<tr><td><hr></td></tr>
						<tr>
							<td><a href="viewupdateuploadIRBTemplate.php" class="menulink" class=&{ns4class};>Update & Upload IRB Template</a></td> 
						</tr>
						<?php
					}
					
			}
		  	if($_SESSION['role']==$row1['id'])
		  	{
		  		?>
		  			<tr>
		  				<td><hr></td>
		  			</tr>
					<tr>
						<td><a href="edit-category.php" class="menulink" class=&{ns4class};>Manage Categories</a></td>
					</tr>
				
		  			
		  			<tr>
					    <td><a href="manage-projects.php" class="menulink" class=&{ns4class};>Manage Projects</a></td>
					</tr>
					
					
		  			<tr>
					    <td><a href="manage-accounts.php" class="menulink" class=&{ns4class};>Manage Accounts</a></td>
					</tr>
				
		  			
                                        <tr>
					    <td><a href="change-account-admin.php" class="menulink" class=&{ns4class};>Change Account Admin</a></td>
				</tr>
				<?php
		  	}
		  	//if($_SESSION['role']==$row3['id'])
			if($_SESSION['role']==$row1['id'])
		  	{
		  		?>

                                <tr>
		  				<td><hr></td>
		  			</tr>
                                <tr>
					    <td><a href="new-user.php" class="menulink" class=&{ns4class};>New User's Request</a></td></tr>
                                            <tr><td><a href="manage_user_account_admin.php" class="menulink" class=&{ns4class};>Manage Registered Users</a></td>

                                            
				</tr>

				<?php
		  	}
		  	?>
			*/
			?>
		</table>
		</td>
	<?php 
		}
	?>
	<td valign="top">