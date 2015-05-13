<?php
	include "header-main.php";
        $auth=$_SESSION['auth_no'];
        if($auth==0)
{
    echo "<h1>you are not authorised ";
    die;
}

	?>
		<script language="Javascript">
			function confirm_delete(id,name)
			{
				if(confirm ("Are you sure you want to close "+name+"?"))
				{
					window.location="close-theme.php?id="+id;
				}
			}
			function confirm_idea_delete(id)
			{
				if(confirm ("Are you sure you want to delete this idea?"))
				{
					window.location="delete-idea.php?id="+id;
				}
			}
		</script>
	<?php
	$id=$_REQUEST['id'];
	$user_account=$_SESSION['account'];
	$query="select * from theme_master where id=$id and (account=0 or account=$user_account)";
	$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
	//redirect if invalid ID or unauthorised access
	if(mysql_num_rows($result)==0)
	{
		?>
		<script language="Javascript">
			window.location="view-themes.php?status=open";
		</script>
		<?php
	}
	$row=mysql_fetch_array($result);
	$status=$row['status'];
	if((strtotime($row['exp_date'])<(time()-86400))&&($status!="expired"))
	{
		$query="update theme_master set status='expired' where id=$id";
		$result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
		?>
		<script language="Javascript">
			window.location="theme-details.php?id=<?php echo $id; ?>";
		</script>
		<?php
	}
	$cat_query="select name from category_master where id=".$row['account'];
	$cat_result=mysql_query($cat_query) or die ("Could not execute query ($cat_query) because ".mysql_error());
	$cat_row=mysql_fetch_array($cat_result);
	function stars($id,$num,$pos,$theme)
	{
		$stars_query="select rating from rating_master where idea_id=$id and rater='".$_SESSION['short_id']."'";
		$stars_result=mysql_query($stars_query) or die ("Could not execute query ($stars_query) because ".mysql_error());
		$check_rev_query="select a.reviewer from reviewer_theme a, idea_master b where b.idea_id=$id and b.theme_id=a.theme_id and a.reviewer='".$_SESSION['short_id']."'";
		$check_rev_result=mysql_query($check_rev_query) or die ("Could not execute query ($check_rev_query) because ".mysql_error());
		if((mysql_num_rows($check_rev_result)!=0)&&(mysql_num_rows($stars_result)==0)&&($theme['status']=="open"))
		{
			echo "New Idea. Click stars to rate";
		}
		elseif(mysql_num_rows($check_rev_result)!=0)
		{
			echo "You have already rated this Idea";
		}
		$i=1;
		while($i<=5)
		{
			//if the current user is a reviewer and he has not rated the idea previously and the theme is open
			if((mysql_num_rows($check_rev_result)!=0)&&(mysql_num_rows($stars_result)==0)&&($theme['status']=="open"))
			{
				?>
				<a href="save-rating.php?idea_id=<?php echo $id; ?>&rating=<?php echo $i; ?>&pos=<?php echo $pos; ?>&theme_id=<?php echo $theme['id']; ?>" title="Rate <?php echo $i; ?>"><img src="images/star_off.gif" border="0" /></a>
				<?php
			}
			//if the current user is not a reviewer or he has previously rated the idea or the theme is closed
			else
			{
				if($i<=$num)
				{
					?>
					<img src="images/star_on.gif" />
					<?php
				}
				else
				{
					?>
					<img src="images/star_off.gif" />
					<?php
				}
			}
			$i++;
		}
	}
?>
	<table align="center" width="90%" class="theme-details">
	<tr><th class="theme-details-l" align="left"><b><?php echo stripslashes($row['name']);
        // Raj:
        $_SESSION["temp_theme_name"]=$row['name'];
        ?></b> (<?php echo $cat_row['name']; ?>)</th><th class="theme-details-r" align="right">Posted by <?php echo $row['creator']; ?> on <?php echo $row['date']; ?> | Expiring on <?php echo $row['exp_date']; ?></th></tr>
	<!-- <tr><td colspan="2"><hr></td></tr> -->
	<?php
	$imple_query="select * from implement_master where theme_id=".$id;
	$imple_result=mysql_query($imple_query);	
	$imple_num=mysql_num_rows($imple_result);
	?>
	<tr><td colspan="2"><?php echo stripslashes($row['descp']); ?><?php if($imple_num!=0) { $imple_row=mysql_fetch_array($imple_result); ?><a href="#followup-<?php echo $imple_row['followup_id']; ?>"><br><br>Theme Implemented</a><?php } ?></td></tr>
	<?php
	if($row['attachment']!="N/A")
	{
		?>
		<tr><td align="left"><a href="<?php echo $row['attachment']; ?>">Download Attachment</a></td><td align="right"><?php if($row['status']=="open") {?><a href="#post-idea">Post Idea</a><?php if($row['creator']==$_SESSION['short_id']) { echo " | <a href='edit-theme.php?id=$id'>Edit Theme</a>"; echo " | <a href=\"javascript:confirm_delete('".$row['id']."','".$row['name']."');\">Close Theme</a> |"; echo " <a href=\"manage-reviewers.php?id=".$row['id']."\">Manage Reviewers</a>"; } ?><?php } elseif($row['creator']==$_SESSION['short_id']){ ?><a href="#post-followup">Post Updates</a><?php } ?></td></tr>
		<?php
	}
	else
	{
		?>
		<tr><td colspan="2" align="right"><?php if($row['status']=="open") {?><a href="#post-idea">Post Idea</a><?php if($row['creator']==$_SESSION['short_id']) { echo " | <a href='edit-theme.php?id=$id'>Edit Theme</a>"; echo " | <a href=\"javascript:confirm_delete('".$row['id']."','".$row['name']."');\">Close Theme</a> |"; echo " <a href=\"manage-reviewers.php?id=".$row['id']."\">Manage Reviewers</a>"; } ?><?php } elseif($row['creator']==$_SESSION['short_id']){ ?><a href="#post-followup">Post Updates</a><?php } ?></td></tr>
		<?php
	}
	?>
	</table>
	
	<?php
	//if current user is the theme creator or the theme is open, show ideas
	if($status=="open"||$row['creator']==$_SESSION['short_id'])
	{
		?>
		<!-- Ideas Start Here -->
		<br />
		<table align="center" width="90%" class="theme-details" border=0>
		<tr><th class="theme-details-m" colspan="3" align="center"><b>Ideas</b></th></tr>
		<?php
		$idea_query="select * from idea_master where theme_id=$id";
		$idea_result=mysql_query($idea_query) or die ("Could not execute query ($idea_query) because ".mysql_error());
		if(mysql_num_rows($idea_result)==0)
		{
			?>
			<tr><td colspan="3" align="center"><b>No Ideas posted yet</b></td></tr>
			<?php
		}
		$count=1;
		while($idea_row=mysql_fetch_array($idea_result))
		{
			$rat_query="select avg(rating) from rating_master where idea_id=".$idea_row['idea_id'];
			$rat_result=mysql_query($rat_query) or die ("Could not execute query ($rat_query) because ".mysql_error());
			$rat_row=mysql_fetch_array($rat_result);
			$comm_query="select * from rating_master where idea_id=".$idea_row['idea_id'];
			$comm_result=mysql_query($comm_query) or die ("Could not execute query ($comm_query) because ".mysql_error());
			$rating_check="select * from rating_master where idea_id=".$idea_row['idea_id'];
			$rating_result=mysql_query($rating_check) or die ("Could not execute query ($rating_check) because ".mysql_error());
			$ratings=mysql_num_rows($rating_result);
			?>
			<tr><td align="left"><a name="idea-<?php echo $count; ?>"></a>Comment by <b><?php echo $idea_row['poster']; ?></b></td><td align="center"><?php stars($idea_row['idea_id'],$rat_row[0],$count,$row); ?></td><td align="right">Posted on <?php echo $idea_row['date']; ?> <?php echo date("h:i A", $idea_row['timestamp']); ?></td></tr>
			<tr><td colspan="4"><?php echo stripslashes($idea_row['idea']); ?></td></tr>
			<?php
			if($idea_row['attachment']!="N/A")
			{
				?>
				<tr <?php if(mysql_num_rows($comm_result)==0 || $idea_row['poster']!=$_SESSION['short_id']) echo "class=\"bottom\""; ?>><td colspan="2" align="left"><a href="<?php echo $idea_row['attachment']; ?>">Download Attachment</a></td><td align="right"><?php if($ratings==0 && $idea_row['poster']==$_SESSION['short_id']) {?><a href="edit-idea.php?id=<?php echo $idea_row['idea_id']; ?>">Edit Idea</a><?php echo " | <a href=\"javascript:confirm_idea_delete('".$idea_row['idea_id']."');\">Delete Idea</a>";} ?></td></tr>
				<?php
			}
			else
			{
				?>
				<tr <?php if(mysql_num_rows($comm_result)==0 || $idea_row['poster']!=$_SESSION['short_id']) echo "class=\"bottom\""; ?>><td colspan="3" align="right"><?php if($ratings==0 && $idea_row['poster']==$_SESSION['short_id']) {?><a href="edit-idea.php?id=<?php echo $idea_row['idea_id']; ?>">Edit Idea</a><?php echo " | <a href=\"javascript:confirm_idea_delete('".$idea_row['idea_id']."');\">Delete Idea</a>";} ?></td></tr>
				<?php				
			}
			//if current user is the theme creator, show him individual ratings and comments of reviewers
			if($row['creator']==$_SESSION['short_id'])
			{
				$i=1;
				while($comm_row=mysql_fetch_array($comm_result))
				{
					?>
					<tr class="alt-l"><td><img src="images/comment.png"><b> Reviewed by <?php echo $comm_row['rater']; ?></b></td><td class="center"><?php stars($idea_row['idea_id'],$comm_row['rating'],$count,$row); ?></td><td style="text-align: right;">Innovative? <?php echo $comm_row['innovative'] ?>.</td></tr>
					<tr class="alt-l <?php if($i==mysql_num_rows($comm_result)) echo " bottom"; ?>"><td colspan="3"><?php echo stripslashes($comm_row['comments']); ?></td></tr>
					<?php
					$i++;
				}
			}
			?>
			<?php
			$count++;
		}
		?>
		</table>
	<?php
	}
	
	
	
	
	//if theme is closed, show followup
	if($status!="open")
	{
		?>
		
		<!-- Comments Section -->
		<br/>
		<a name="view-comments"></a>
		<table class="theme-details" align="center" width="90%">
		<tr><th class="theme-details-m" colspan="4" align="center"><b> Conclusion</b></th></tr>
		<tr><td><?phpecho $row['comment']; ?></td></tr>
		</table>
		
		<!-- Followup Starts Here -->
		<br />
		<table class="theme-details" align="center" width="90%">
		<tr><th class="theme-details-m" colspan="4" align="center"><b>Updates</b></th></tr>
		<?php
		$followup_query="select * from followup_master where theme_id=$id";
		$followup_result=mysql_query($followup_query) or die ("Could not execute query ($followup_query) because ".mysql_error());
		if(mysql_num_rows($followup_result)==0)
		{
			?>
			<tr><td colspan="3" align="center"><b>No Updates posted yet</b></td></tr>
			<?php
		}
		$count=1;
		while($followup_row=mysql_fetch_array($followup_result))
		{
			?>
			<tr><td align="left" colspan="2"><a name="followup-<?php echo $followup_row['followup_id']; ?>"></a><b><?php echo $row['creator']; ?></b> says</td><td align="center"></td><td align="right">Posted on <?php echo $followup_row['date']; ?> <?php echo date("h:i A", $followup_row['timestamp']); ?></td></tr>
			<tr <?php if($followup_row['attachment']=="N/A" && $followup_row['link']=="") echo "class=\"bottom\""; ?>><td colspan="4"><?php echo stripslashes($followup_row['followup']); ?></td></tr>
			<?php
			if($followup_row['attachment']!="N/A")
			{
				?>
				<tr <?php if($followup_row['link']=="") echo "class=\"bottom\""; ?>><td colspan="4" align="left"><a href="<?php echo $followup_row['attachment']; ?>">Download Attachment</a></td></tr>
				<?php
			}
			if($followup_row['link']!="")
			{
				?>
				<tr class="bottom"><td colspan="4" align="left"><a href="<?php echo $followup_row['link']; ?>"><?php echo $followup_row['link']; ?></a></td></tr>
				<?php
			}
			$count++;
		}
		?>
		</table>
		<?php
	}
	
	//if theme is open, allow users to post ideas
	if($status=="open")
	{	
		?>
		<!-- Post Idea Starts Here -->
		<br /><br />
		<a name="post-idea"></a>
		<form enctype="multipart/form-data" name="idea_form" method="POST" action="post-idea.php">
		<input type="hidden" name="theme_id" value="<?php echo $id; ?>">
		<table align="center" width="90%">
		<tr><td align="center"><b>Post an Idea</b></td></tr>
		<tr><td><textarea name="idea" style="width:100%" rows="6"></textarea></td></tr>
		<tr><td align="center">Attachment (Optional): <input name="uploadedfile" disabled type="file"></td></tr>
		<tr><td align="center"><input type="submit" name="submit" disabled value="Submit Idea"></td></tr>
		</table>
		</form>
		<?php
	}
	
	
	//if theme is closed and the current user is the theme creator, allow him to post follow up
	if($status!="open"&&$row['creator']==$_SESSION['short_id'])
	{
		?>
		<!-- Post Followup Starts Here -->
		<br /><br />
		<a name="post-followup"></a>
		<form enctype="multipart/form-data" name="followup_form" method="POST" action="post-followup.php">
		<input type="hidden" name="theme_id" value="<?php echo $id; ?>">
		<table align="center" width="90%">
		<tr><td align="center" colspan="2"><b>Post Updates</b></td></tr>
		<tr><td colspan="2"><textarea name="followup" style="width:100%" rows="6"></textarea></td></tr>
		<?php
		$imp_query="select * from implement_master where theme_id=".$row['id'];
		$imp_result=mysql_query($imp_query);
		$imp_rows=mysql_num_rows($imp_result);
		if($imp_rows==0)
		{
		?>
		<tr><td align="center">Implemented?</td><td><input type="radio" name="implement" value="yes">Yes<input type="radio" name="implement" value="no">No</td></tr>
		<?php
		}
		?>
		<tr><td align="center">Attachment (Optional)</td><td><input name="uploadedfile" disabled type="file"></td></tr>
		<tr><td align="center">Web Link (Optional)</td><td><input name="link" type="text"></td></tr>
		<tr><td align="center" colspan="2"><input type="submit" name="submit" disabled value="Post Update"></td></tr>
		</table>
		</form>
		<?php
	}
	include "footer.php";
?>