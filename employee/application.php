<!doctype html>
<html lang="en">
<?php 
require '../constants/settings.php'; 
require 'constants/check-login.php';
include "../rb.php";
R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB

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
						<li><span> Application Letter</span></li>
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
									
										<h2>Application Letter</h2>
					
										
									</div>
									
									<div class="resume-list-wrapper">
									<?php require 'constants/check_reply.php'; ?>
									<?php
									require '../constants/db_config.php';
									try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("SELECT * FROM tbl_applications WHERE member_no = '$myid' ORDER BY id LIMIT $page1,5");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row)
                                    {

									 $att_id = $row['id'];
									 ?>
									 									<div class="resume-list-item">
										
											<div class="row">
											
												<div class="col-sm-12 col-md-10">
												
													<div class="content">
													
														<a  target="_blank" href="view-application.php?id=<?php echo $row['id']; ?>" >

															<div class="image">
															<?php 
										                    if ($myavatar == null) {
									                    	print '<center><img src="../images/default.jpg" title="'.$myfname.'" alt="image" width="100" height="100" /></center>';
										                    }else{
										                    echo '<center><img alt="image" title="'.$myfname.'" width="100" height="100" src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										                    }
										                      ?>
															</div>

															

														</a>
													
													</div>
												
												</div>
												
												<div class="col-sm-12 col-md-2">
													
													<div class="resume-list-btn">
													
									<a data-toggle="modal" href="#edit<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-5 mb-0-sm">Edit</a>
									<a href="app/drop-attachment.php?id=<?php echo $row['id']; ?>" onclick = "return confirm('Are you sure you want to delete this attachment ?')" class="btn btn-primary btn-sm btn-inverse">Delete</a>
									<div id="edit<?php echo $row['id']; ?>" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				                    <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                 <h4 class="modal-title text-center"><?php echo "$att_title"; ?></h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="app/update-attachment.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">

						
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Attachment Type</label>
								    <input class="form-control" value="<?php echo "$att_title"; ?>" placeholder="Eg: birth certificate, driving licence" type="text" name="title" required> 
							        </div>
						
						             </div>
						
						             <div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Issuer</label>
								    <input class="form-control" value="<?php echo "$att_issuer"; ?>" placeholder="Enter issuer" type="text" name="issuer" required> 
							        </div>
						
						           </div>
								  

								   	<div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Select Attachment <i>(Leave blank if you dont want to update)</i></label>
								    <input class="form-control" accept="application/pdf" type="file" name="certificate"> 
							        </div>
						
						           </div>
						
	
						           </div>
				                   </div>
				                   <input type="hidden" name="attid" value="<?php echo "$att_id"; ?>">
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
                                    $stmt = $conn->prepare("SELECT * FROM tbl_other_attachments WHERE member_no = '$myid' ORDER BY id");
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
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="attachments.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?> href="attachments.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="attachments.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>

										
		
										
									</div>


				                    <div class="panel-heading">
					                 <h4 class="modal-title text-center">Add Application Letter</h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">

								   	<div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Select Application Letter</label>
								    <input class="form-control" accept="application/pdf" type="file" name="attachment" required>
							        </div>
						
						           </div>
						
	
						           </div>
								   
					               </div>
				         
				
				                   <div class="modal-footer text-center">
				 	               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
if(isset($_POST['submit'])){


    $uploaddir = 'uploads/';
    $stamp = time();
    $uploadfile = $uploaddir.$stamp.basename($_FILES['attachment']['name']);
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile)) {
        $attachment = $uploadfile;
    } else {
        $error = TRUE;
        var_dump($uploadfile);
        echo "Possible file upload attack!\n";
    }

    $assignments = R::dispense('letters');

   // $assignments->level = $level;
    $assignments->member_no= $myid;
    $assignments->attachment=$attachment;
//$assignments
    R::store($assignments);
    $msg=' Application Letter uploaded successfully';
    // print ("<script>window.location.assign('add_assignment.php')</script>");
}
?>
<?php
include "footer.php";
?>