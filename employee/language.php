<!doctype html>
<html lang="en">
<?php
require '../constants/settings.php';
require 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employee") {
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
						<li><span>Language Proficiency</span></li>
					</ol>
					
				</div>
				
			</div>
		
			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">

                            <?php include_once "sidebar.php";
                            ?>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Language Proficiency</h2>
					
										
									</div>
									
									<div class="resume-list-wrapper">
									<?php require 'constants/check_reply.php'; ?>
									<?php
									require '../constants/db_config.php';
									try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("SELECT * FROM tbl_language WHERE member_no = '$myid' ORDER BY id LIMIT $page1,5");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();

                                    foreach($result as $row)
                                    {
										?>
											<div class="resume-list-item">
										
											<div class="row">
											
												<div class="col-sm-12 col-md-10">
												
													<div class="content">
													
														<a >

															<div class="image">
															<?php 
										                    if ($myavatar == null) {
									                    	print '<center><img src="../images/default.jpg" title="'.$myfname.'" alt="image" width="100" height="100" /></center>';
										                    }else{
										                    echo '<center><img alt="image" title="'.$myfname.'" width="100" height="100" src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										                    }
										                      ?>
															</div>
															
															<h4><?php echo $row['language']; ?></h4>
															
															<div class="row">
																<div class="col-sm-12 col-md-12">
																	<i class="fa fa-user mr-5"></i> Speak - <strong class="mr-10"><?php echo $row['speak']; ?></strong> <i class="fa fa-book mr-5"></i> Read - <strong class="mr-10"><?php echo $row['reading']; ?></strong> <i class="fa fa-pencil mr-5"></i> Write - <strong class="mr-10"><?php echo $row['writing']; ?></strong>
																</div>

															</div>

														</a>
													
													</div>
												
												</div>
												
												<div class="col-sm-12 col-md-2">
													
													<div class="resume-list-btn">
													
														<a data-toggle="modal" href="#edit<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-5 mb-0-sm">Edit</a>
														<a href="app/drop-language.php?id=<?php echo $row['id']; ?>" onclick = "return confirm('Are you sure you want to delete this language ?')" class="btn btn-primary btn-sm btn-inverse">Delete</a>
														
														<div id="edit<?php echo $row['id']; ?>" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				                                        <div class="modal-header">
					                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                                    <h4 class="modal-title text-center">Edit - <?php echo $row['language']; ?></h4>
				                                        </div>
				
				                                        <div class="modal-body">
									                    <form action="app/update-language.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                                    <div class="row gap-20">
						                                <div class="col-sm-12 col-md-12">
				
							                            <div class="form-group"> 
								                        <label>Language</label>
								                        <input class="form-control" value="<?php echo $row['language']; ?>" placeholder="Enter language name" type="text" name="language" required> 
							                            </div>
						
						                                </div>

						
						                                <div class="col-sm-12 col-md-12">
				
							                            <div class="form-group"> 
								                        <label>Speak</label>
								                        <select name="speak" required class="selectpicker show-tick form-control" data-live-search="false">
									                    <option <?php if ($row ['speak'] == "Fair") { print ' selected '; } ?> value="Fair">Fair</option>
									                    <option <?php if ($row ['speak'] == "Good") { print ' selected '; } ?> value="Good">Good</option>
								                    	<option <?php if ($row ['speak'] == "Very Good") { print ' selected '; } ?> value="Very Good">Very Good</option>
									                    </select>
							                            </div>
						
						                               </div>
						
						                                <div class="col-sm-12 col-md-12">
				
							                            <div class="form-group"> 
								                        <label>Read</label>
								                        <select name="read" required class="selectpicker show-tick form-control" data-live-search="false">
									                    <option <?php if ($row ['reading'] == "Fair") { print ' selected '; } ?> value="Fair">Fair</option>
									                    <option <?php if ($row ['reading'] == "Good") { print ' selected '; } ?> value="Good">Good</option>
								                    	<option <?php if ($row ['reading'] == "Very Good") { print ' selected '; } ?> value="Very Good">Very Good</option>
									                    </select>
							                            </div>
						
						                               </div>

						                                <div class="col-sm-12 col-md-12">
				
							                            <div class="form-group"> 
								                        <label>Write</label>
								                        <select name="write" required class="selectpicker show-tick form-control" data-live-search="false">
									                    <option <?php if ($row ['writing'] == "Fair") { print ' selected '; } ?> value="Fair">Fair</option>
									                    <option <?php if ($row ['writing'] == "Good") { print ' selected '; } ?> value="Good">Good</option>
								                    	<option <?php if ($row ['writing'] == "Very Good") { print ' selected '; } ?> value="Very Good">Very Good</option>
									                    </select>
							                            </div>
						
						                               </div>
						
					                                  </div>
				                                      </div>
				                                       <input type="hidden" name="langid" value="<?php echo $row['id']; ?>">
				                                       <div class="modal-footer text-center">
				 	                                   <button type="submit" class="btn btn-primary">Update</button>
					                                   <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				                                        </div>
				                                       </form>
			                                            </div>

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

									<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
									require '../constants/db_config.php';
									try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("SELECT * FROM tbl_language WHERE member_no = '$myid' ORDER BY id");
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
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="language.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav"><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="language.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="language.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>

										
		
										
									</div>
				                    <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                 <h4 class="modal-title text-center">Add languages</h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="app/add-language.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Language</label>
								    <input class="form-control" placeholder="Enter language name" type="text" name="language" required> 
							        </div>
						
						             </div>

						
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Speak</label>
								    <select name="speak" required class="selectpicker show-tick form-control" data-live-search="false">
									<option value="Fair">Fair</option>
									<option value="Good">Good</option>
									<option value="Very Good">Very Good</option>
									</select>
							        </div>
						
						             </div>
						
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Read</label>
								    <select name="read" required class="selectpicker show-tick form-control" data-live-search="false">
									<option value="Fair">Fair</option>
									<option value="Good">Good</option>
									<option value="Very Good">Very Good</option>
									</select>
							        </div>
						
						             </div>

						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Write</label>
								    <select name="write" required class="selectpicker show-tick form-control" data-live-search="false">
									<option value="Fair">Fair</option>
									<option value="Good">Good</option>
									<option value="Very Good">Very Good</option>
									</select>
							        </div>
						
						             </div>
						
					               </div>
				                   </div>
				
				                   <div class="modal-footer text-center">
				 	               <button type="submit" class="btn btn-primary">Submit</button>
					               <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				                   </div>
				                   </form>
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