<?php
include "header-main.php";


$account=$_SESSION['account'];
$acc_query="select name from account_master where id =". $account;
	$acc_result=mysql_query($acc_query) or die ("Could not execute query ($acc_query) because ".mysql_error());
$acc_row=mysql_fetch_array($acc_result);
$status=$_REQUEST['status'];
				if($status=="open")
					{
						$query="select a.* from problem_master a,emp_master b  where a.status='open' and b.account=$account and b.short_id = a.submitted_by" ;
					}
				elseif($status=="closed")
					{
						$query="select a.* from problem_master a,emp_master b where status!='open' and b.account=$account and b.short_id = a.submitted_by " ;
					}
				elseif($status=="search")
					    	{
									$short_desc=addslashes($_REQUEST['short_desc']);
									
									$category=$_REQUEST['category'];
								
									$submitted_by=$_REQUEST['submitted_by'];
								
									$sd=$_REQUEST['sd'];
									
				                    $ed=$_REQUEST['ed'];
								if($category==0)
									{
									if($sd!=""&&$ed=="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%'  and submitted_by like '%$submitted_by%' and date >= '$sd'";
												}
									elseif($sd==""&&$ed!="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and  submitted_by like '%$submitted_by%' and date <= '$ed'";
												}
									elseif($sd!=""&&$ed!="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and submitted_by like '%$submitted_by%'and  date between '$sd' and '$ed'";
												}
									else
									    		{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and  submitted_by like '%$submitted_by%'";
												}
									}
							   else
					    	{
									if($sd!=""&&$ed=="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and category like '%$category%' and submitted_by like '%$submitted_by%' and date >= '$sd'";
												}
									elseif($sd==""&&$ed!="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and category like '%$category%' and submitted_by like '%$submitted_by%' and date <= '$ed'";
												}
									elseif($sd!=""&&$ed!="")
												{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and category like '%$category%' and submitted_by like '%$submitted_by%'and  date between '$sd' and '$ed'";
												}
									else
									    		{
													$query="select * from problem_master  where short_desc like '%$short_desc%' and category like '%$category%' and  submitted_by like '%$submitted_by%'";
												}
									}
					     }	    
					else
					{
						echo "Invalid status";
						include "footer.php";
						die;
					}
			           $result=mysql_query($query) or die ("Could not execute query ($query) because ".mysql_error());
				       if(mysql_num_rows($result)==0)
						{
							echo "Sorry no challenge found";
							include "footer.php";
							die;
						}
				
				?>	
				    <form name="generate-report" method="post" action="generate-idea.php">
				    <table cellpadding="0" cellspacing="0" border="0" class="sort rowstyle-alt colstyle-alt no-arrow sortable-onload-0 paginate-30 max-pages-5" align="center" >
				    <tr><th class="theme-details-m" colspan="5"><?php echo $acc_row['name']; ?> Innovations- <?php echo $status; ?></th></tr>
					<tr> <th class="sort sortable-text"><b> Short Description</b></th><th class="sort sortable-text"><b> Category</b> </th><th class="sort sortable-text"><b>Project </b></th><th class="sort sortable-text"><b>Posted-by</b></th><th class="sort sortable-text"><b> Date</b> </th></tr>
				<?php
				while($row=mysql_fetch_array($result))
				{
					$cat_query="select name,id from category_master where id='".$row['category']."'";
					$cat_result=mysql_query($cat_query) or die ("Could not execute query ($cat_query) because ".mysql_error());
					$cat_row=mysql_fetch_array($cat_result);
					
					$proj_query="select name from project_master where project_id=".$row['project'];
					$proj_result=mysql_query($proj_query) or die ("Could not execute query ($proj_query) because ".mysql_error());
					$proj_row=mysql_fetch_array($proj_result);
					
					$sub_query="select name from emp_master where short_id='".$row['submitted_by']."'";
					$sub_result=mysql_query($sub_query)or die ("Could not execute query ($sub_query) because ".mysql_error());
					$sub_row=mysql_fetch_array($sub_result);
					?>
				
					<input type="hidden" name="prob_id[]" value="<?php echo $row['prob_id']; ?>">
					<tr><td> <a href="openidea-details.php?id=<?php echo $row['prob_id']; ?>"><?phpecho $row['short_desc']; ?></a></td><td><?php echo $row['category']; ?></td><td><?php echo $proj_row['name'];?></td><td><?php echo $sub_row['name']; ?></td><td><?php echo $row['date']; ?></tr>
					
				<?php
				}
				?>
				</table>
				<div align="right" style="padding: 8px">
				<input type="hidden" name="account_no" value="<?php echo $account; ?>" >
				<input type="submit" name="submit" value="Generate Report"></div>
				</form>



<?php 


include "footer.php";
?>   
 