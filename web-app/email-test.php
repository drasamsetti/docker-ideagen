<?php
	$headers = 'From: Idea Generation Tool <idea@ig.csc.com>'."\r\n".'Reply-To: kboovaragan@csc.com';
        $subject="Idea Generation Tool: Captured Winning Ideas Successful";
        $to="knigam@csc.com, kboovaragan@csc.com";
        $message="Test";
        @mail($to, $subject, $message, $headers);
?>