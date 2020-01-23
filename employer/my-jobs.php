<!doctype html>
<html lang="en">
<?php
require '../constants/settings.php';
require 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");
}
}else{
header("location:../");
}

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*5)-5;
}
}else{
$page1 = 0;
$page = 1;
}
?>
<?php
include "header.php";
?>
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Home</a></li>
						<li><span>My Jobs</span></li>
					</ol>
					
				</div>
				
			</div>

			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">

                            <?php include 'sidebar.php';?>
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Posted Jobs</h2>
										
									</div>
									<?php require 'constants/check_reply.php'; ?>
										<div class="job-item-grid-wrapper">
										

					
										<div class="GridLex-gap-30">
										
											<div class="GridLex-grid-noGutter-equalHeight">
									<?php
										require '../constants/db_config.php';
										try {
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$myid' ORDER BY enc_id DESC LIMIT $page1,5");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
   
                                        foreach($result as $row)
                                        {
										   $jobcity = $row['city'];
										   $jobtown = $row['town'];
										//   $type = $row['type'];
										   $title = $row['title'];
										   $deadline = $row['closing_date'];
                                            $posted = $row['date_posted'];

										   
										   ?>
										   										  <div class="GridLex-col-4_sm-6_xs-6_xss-12">
												
											<div class="job-item-grid">
													

														
											<a target="" href="../explore-job.php?id=<?php echo $row['job_id']; ?>">
														
											<div class="image">
															
											<div class="vertical-middle">
																
											<?php 
										    if ($logo == null) {
										     print '<center>Company Logo Here</center>';
										    }else{
										    ?>
										    <center><img alt="image" title="<?php echo "$compname"; ?>" width="180" height="100" src="<?php echo "$logo"; ?>"/></center>
										  <?php   }
										     ?>
																
											</div>
																
											</div>
														
											<div class="content">
											<h4 class="heading"><?php echo "$title"; ?></h4>
											<p class="location"><i class="fa fa-map-marker text-primary"></i> <strong class="text-primary"><?php echo "$jobtown" ?></strong> - <?php echo "$jobcity" ?></p>
											<p class="date text-muted font12 font-italic">Date Posted - <?php echo "$posted"; ?></p>
											<p class="date text-muted font12 font-italic">Deadline - <?php echo "$deadline"; ?></p>
											</div>
															
											</a>
														
											<div class="content-bottom">
											<div class="sub-category">
											<a  href="view-applicants.php?jobid=<?php echo $row['job_id']; ?>">Applicants</a>
											<a href="edit-job.php?jobid=<?php echo $row['job_id']; ?>">Edit Job</a>
											<a onclick = "return confirm('Are you sure you want to delete this job ?')" href="app/drop-job.php?id=<?php echo $row['job_id']; ?>">Delete Job</a>
											</div>
											</div>
														
											</div>
													
												</div>
												
												<?php
		
 
	                                    }

					  
	                                    }catch(PDOException $e)
                                        {
                         
                                        }
                                             ?>
											</div>
											
										</div>
										
									</div>
									
								<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../constants/db_config.php';
								try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$myid' ORDER BY enc_id");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
   
                                foreach($result as $row)
                                {
		                        $total_records++;
 
	                            }

					  
	                            }catch(PDOException $e)
                                {
           
                                }
										
								$records = $total_records/5;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="my-jobs.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" <?php if ($b == $page ) { print 'class="active"'; } ?> ><a href="my-jobs.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="my-jobs.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>
									
								</div>

							</div>
							
						</div>

					</div>

				</div>
			
			</div>

<?php
include "footer.php";
?>