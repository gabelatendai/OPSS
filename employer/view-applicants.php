<!doctype html>
<html lang="en">
<?php 
require '../constants/settings.php'; 
require 'constants/check-login.php';
include "../rb.php";
$db = mysqli_connect("localhost", "root", "", "opss_db");
$db2= R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*16)-16;
}					
}else{
$page1 = 0;
$page = 1;	
}

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}

if (isset($_GET['jobid'])) {
require'../constants/db_config.php';
$job_id = $_GET['jobid'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid AND company = '$myid'");
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();
$result = $stmt->fetchAll();
$rec = count($result);

if ($rec == "0") {
header("location:../");		
}else{

foreach($result as $row)
{
		
$job_title = $row['title'];
}
	
}
					  
}catch(PDOException $e)
{

}
	
}
?>
<?php
include "header.php";
?>
		<div class="main-wrapper">

			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Home</a></li>
						<li><span>Applicants for the job <?php echo "$job_title"; ?></</span></li>
					</ol>
					
				</div>
				
			</div>
			
			<div class="section sm">
			
				<div class="container">
				
					<div class="sorting-wrappper">
			
						<div class="sorting-header">
							<h3 class="sorting-title">Applicants for the job <?php echo "$job_title"; ?></</h3>
						</div>
						
		
					</div>
					
					<div class="employee-grid-wrapper">
					
						<div class="GridLex-gap-15-wrappper">
						
							<div class="GridLex-grid-noGutter-equalHeight">
							<?php
							include '../constants/db_config.php';
							$stmt = $conn->prepare("SELECT * FROM tbl_job_applications WHERE job_id = :jobid ORDER BY id LIMIT $page1,16");
							$stmt->bindParam(':jobid', $job_id);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
							 foreach($result as $row)
                            {
							$post_date = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'd');
                            $post_month = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'F');
                            $post_year = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'Y');
                            $emp_id = $row['member_no'];
                            $typ = $row['status'];
                            $jobidy = $row['job_id'];

							$stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employee' AND member_no = '$emp_id'");
                            $stmtb->execute();
                            $resultb = $stmtb->fetchAll();
							
							foreach ($resultb as $rowb)
							
							{
								$empavatar = $rowb['avatar'];
								$id = $rowb['member_no'];

								
								?>
									<div class="GridLex-col-3_sm-4_xs-6_xss-12">
								
									<div class="employee-grid-item">
									
										<div class="action">
												
											<div class="row gap-10">
											
												<div class="col-xs-6 col-sm-6">
													<div class="text-left">
														<button class="btn"><i class="icon-heart"></i></button> 
													</div>
												</div>
												
												<div class="col-xs-6 col-sm-6">
													<div class="text-right">
														<a class="btn text-right" href="employee-detail.html"><i class="icon-action-redo"></i></a> 
													</div>
												</div>
												
											</div>
											
										</div>
										

											<div class="image clearfix">
										    <?php 
										    if ($empavatar == null) {
									        print '<center><img class="img-circle autofit2" src="../images/default.jpg" alt="image"  /></center>';
										    }else{
										    	?><center><img class="img-circle autofit2" alt="image" src="../employee/<?php echo $empavatar; ?>"/></center>
										 <?php   }
										    ?>
											
							

											</div>
											
											<div class="content">
											
												<h4><?php echo $rowb['first_name'] ?> <?php echo $rowb['last_name'] ?></h4>
												<p class="location"><i class="fa fa-map-marker"></i> <?php echo $rowb['town'] ?></p>
												
												<h6 class="text-primary">Education : <?php echo $rowb['education'] ?></h6>
												
                                                <h6 class="text-primary"><?php echo $rowb['title'] ?></h6>
												Applied On: <?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
												<div class="content-bottom">
													<div class="sub-category">
														<a  href="../employee-detail.php?empid=<?php echo $rowb['member_no']; ?>">View Applicant Profile</a>

														<?php

                                                        $init = R::findOne('tbl_job_applications', 'member_no = ? AND job_id = ? AND status = ?', [$id, $jobidy, $typ]);
 if ($init==null) {
                                                        ?>
														<div class="pd-y-30 tx-center bg-dark">
															<a href="" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#modaldemo6">Invite For Interview</a>
														</div><!-- pd-y-30 -->

														<div id="modaldemo6" class="modal fade">
															<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
																<div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
																	<div class="modal-body pd-0">
																		<div class="row no-gutters">
																			<div class="col-lg-6 bg-white">
																				<div class="pd-30">
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																					<div class="pd-x-30 pd-y-10">
																						<h3 class="tx-inverse  mg-b-5">Invite For Interview</h3>
																						<p>Sign in to your account to continue</p>
																						<br><form action="../message/invite.php" method="post">


																							<input type="hidden" value="<?php echo $row['job_id']; ?>" name="jobId">
																							<input type="hidden" value="<?php echo $row['member_no']; ?>" name="member_no">

																							<div class="form-group">
																							<input type="date" name="date" class="form-control pd-y-12">
																						</div><!-- form-group -->
																						<div class="form-group mg-b-20">
																							<textarea type="text" name="sms" class="form-control pd-y-12" placeholder="Enter Message"></textarea>
																							<a href="" class="tx-12 d-block mg-t-10">Forgot password?</a>
																						</div><!-- form-group -->
																							<input class="btn btn-primary pd-y-12 btn-block" name="invite" type="submit"
																							       style="background-color: green" value="Invite For Intervifew "/>
																						</form>
																					</div>
																				</div><!-- pd-20 -->
																			</div><!-- col-6 -->
																		</div><!-- row -->
																	</div><!-- modal-body -->
																</div><!-- modal-content -->
															</div><!-- modal-dialog -->
														</div><!-- modal -->
<?php
}else{
?>
<h4>Invited </h4>
<?php } ?>
													</div>
												</div>
											</div>

									</div>
								
								</div>
								
								
								<?php
								
								
							}
		

	                        }
	

							?>
							

								

								
							</div>
						
						</div>

					</div>
					
									<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								$stmt = $conn->prepare("SELECT * FROM tbl_job_applications WHERE job_id = :jobid ORDER BY id");
								$stmt->bindParam(':jobid', $job_id);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
								    foreach($result as $row)
                                {
									$total_records++;
		
	                            }

								$records = $total_records/16;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="view-applicants.php?jobid='.$job_id.'&page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="view-applicants.php?jobid=<?php echo "$job_id"; ?>&page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="view-applicants.php?jobid='.$job_id.'&page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>

				</div>
			
			</div>

<?php
include "footer.php";
?>