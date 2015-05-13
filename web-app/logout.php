<?php
	session_start();
	include "connection.php";
	
	setcookie("login", "", time()-3600);
	//session_register("login");
	session_destroy();
?>
<script language="Javascript">
<!--
	window.location="index.php";
//-->
</script>
