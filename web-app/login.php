<?php
	session_start();
	
	error_reporting(0);
	include "connection.php";
	
	$emp_role=array("","Admin","OPS Reviewer","Challenger","User","ATD","","TDC","BU Sponsor","IRB","","AMEA Regional CTO","Australia Regional CTO","Brazil Regional CTO","Central & Eastern Europe Regional CTO","South & West Europe Regional CTO","India Regional CTO","Nordics Regional CTO","North American Public Sector Regional CTO","Ingenuity Worx");
	$short_id=$_POST['short_id'];
	$password=md5($_POST['password']);
	if (isset($_POST['role']))
	{
	$roleid=$_POST['role'];
	}
	/*$password=base64_encode($_POST['password']);
	$url=$webhost."/auth/login.php?short_id=$short_id&password=$password";
	$xml= file_get_contents($url, False);
	if(!$xml)
	{
		echo "Cannot connect to Authentication Service";
		include("footer.php");
		die;
	}
	$simple_xml=simplexml_load_string($xml);
	if($simple_xml->Auth->Error)
	{
		echo $simple_xml->Auth->Error;
		include("footer.php");
		die;
	}
	if($simple_xml->Auth->Login=="false")
	{
		?>
		<script language="Javascript">
		<!--
		alert ("Sorry, Incorrect Login!");
		window.location="index.php";
		//-->
		</script>
		<?php
		include "footer.php";
		die;
	}*/
	/*$dom = domxml_open_mem($xml, DOMXML_LOAD_PARSING, $errors);
	$root = $dom->document_element();
	$auth = $root->first_child();
	$login = $auth->first_child();
	if($login->node_name()=="Error")
	{
		echo $login->get_content();
		include("footer.php");
		die;
	}
	$login_result=$login->get_content();
	if($login_result=="false")
	{
		?>
		<script language="Javascript">
		<!--
		alert ("Sorry, Incorrect Login!");
		window.location="index.php";
		//-->
		</script>
		<?php
		include "footer.php";
		die;
	}*/
	//$password=md5($password);
	$dquery="select id from role_master where role_name='deleted'";
	$dresult=mysql_query($dquery);
	$drow=mysql_fetch_array($dresult);
	$did=$drow['id'];
	$query = sprintf("SELECT * FROM emp_master WHERE short_id='%s' and password='%s' and role!='$did'", mysql_real_escape_string($short_id), mysql_real_escape_string($password));
	//echo $query;
	$result=mysql_query($query) or die("Could not execute query");
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)>0)
	{
		$cookieValue = mt_rand() ."_$short_id";
		setcookie("login",$cookieValue,time()+300);
		//session_register("login");
                $min=100; $max=999999;
                $auth_rand=rand ( $min , $max );
                $auth_no=$auth_rand."".$row['short_id'];
                $_SESSION['auth_no']=$auth_no;

				//Code to implement multiple role for an user starts here - MRU
				/*$sqlqry="select * from role_trans where emp_short_id='".$row['short_id']."'";
				$sqlrole=mysql_query($sqlqry);
				$_SESSION['lastrole'];
				$cnt=0;
				while($rolechk=mysql_fetch_array($sqlrole))
				{
				
					//echo "Role : ".$rolechk['role_id']."<br/>";
					$_SESSION['lastrole']=$rolechk['role_id'];
					//$_SESSION['role']=$rolechk['role_id'];
					$cnt=$cnt+1;
					
				}
				
				
				*/
				//MRU ends here
				
                $_SESSION['password']=$row['password'];
		$_SESSION['short_id']=$row['short_id'];
		if ($_POST['role']==0)
		{
		$_SESSION['role']=$row['role'];
		}
		else
		{
		$_SESSION['role']=$roleid;
		}
		$_SESSION['name']=$row['name'];
		$_SESSION['grade']=$row['grade'];
		$_SESSION['account']=$row['account'];
		$_SESSION['category']=$row['category'];
		$_SESSION['login']=$cookieValue;
		$_SESSION['emp_role']=$emp_role;
		$referer=$_SERVER['HTTP_REFERER'];
               
			//Code to implement multiple role for an user starts here - MRU
             /*
			 if ($cnt>1)
				{
				?>
			<script language="Javascript">
			
				window.location="roleselect.php?user=<?php echo $_SESSION['short_id'];?>";
			
			</script>
			<?php
				}
				else
				{
					//$_SESSION['role']=$row['role'];
					$_SESSION['role']=$_SESSION['lastrole'];
				}

				*/
				//MRU ends here
				
		if($referer==""||strpos($referer,"login")||strpos($referer,"logout"))
		{
			?>
			<script language="Javascript">
			
				window.location="index.php";
			
			</script>
			<?php
		}
		else
		{
                     //echo "<h1>".$referer."</h1>" ;
                     $temp11=$_SERVER["PHP_SELF"];
                    // echo "<h1>".$temp11."</h1>" ;
                     $x=strpos($referer,"register");
                    // echo "<h1>welcome </h1>".$x ;

                    if($x!="")
                    {
                    ?>
                        <script>

                        window.location="index.php";
                        </script>
                     <?php
die;

                     }
                    else
                    {

			?>
			<script language="Javascript">
			
				window.location="<?php echo $referer; ?>";
			
			</script>
			<?php

                        }

                    }
	    }
	else
	{
		?>
		<script language="Javascript">
		
		alert ("Sorry, Incorrect Login!");
		window.location="index.php";
		
		</script>
		<?php
		die;
		$cookieValue = mt_rand() ."_$short_id";
		setcookie("login",$cookieValue,time()+300);
		session_register("login");
		$_SESSION['short_id']=$short_id;
		$_SESSION['role']="-1";
		$_SESSION['name']=$short_id;
                $_SESSION['auth_no']="0";
		$_SESSION['grade']="0";
		$_SESSION['account']="0";
		$_SESSION['category']="0";
		$_SESSION['login']=$cookieValue;
		$referer=$_POST['pre_referer'];
              echo "<h1>$referer</h1>";
		if($referer==""||strpos($referer,"login")||strpos($referer,"logout")||strpos($referer,"register"))
		{
			?>
			<script language="Javascript">
			
				alert ('Choosing the role to login');
			
			</script>
			<?php
		}
		else
		{
			?>
			<script language="Javascript">
			
				window.location="<?php echo $referer; ?>";
			
			</script>
			<?php
		}
	}
?>
