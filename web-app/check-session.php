<?php
	session_start();
	
	if(isset($_COOKIE['login']) && isset($_SESSION['login']))
	{
		if($_COOKIE['login'] == $_SESSION['login'])
		{
			$logged = true;
			setcookie("login",$_COOKIE['login'],time()+6000, "/");
		}
		else 
		{
			$logged = false;
		}
	}
	else 
	{
		$logged = false;
	}
?>
