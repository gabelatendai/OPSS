<?php
include "header.php";
$db = mysqli_connect("localhost", "root", "", "opss_db");
$user= mysqli_query($db,"select * FROM  tbl_users where member_no ='$myid'");
$us= mysqli_fetch_array($user);

$avatar= $us['avatar'];
?>
<br><br>
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Home</a></li>
						<li><span>Profile</span></li>
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
									
										<h2>Profile</h2>
										<p>Your last loged-in: <span class="text-primary"><?php echo "$mylogin"; ?></span></p>
										
									</div>
									
									<form class="post-form-wrapper" action="app/update-profile.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php require 'constants/check_reply.php'; ?>

												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>First Name</label>
														<input name="fname" required type="text" class="form-control" value="<?php echo "$myfname"; ?>" placeholder="Enter your first name">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Last Name</label>
														<input name="lname" required type="text" class="form-control" value="<?php echo "$mylname"; ?>" placeholder="Enter your last name">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Date Of Birth</label>
														<div class="row gap-5">
															<div class="col-xs-3 col-sm-3">
																<select name="date" required class="selectpicker form-control" data-live-search="false">
																	<option disabled value="">day</option>
                                                                     <?php 
                                                                      $x = 1; 

                                                                      while($x <= 31) {
                                         
												                      if ($x < 10) {
														              $x = "0$x";
													                  print '<option '; if ($mydate == $x ) { print ' selected '; } print ' value="'.$x.'">'.$x.'</option>';
													                  }else{
													                  print '<option '; if ($mydate == $x ) { print ' selected '; } print ' value="'.$x.'">'.$x.'</option>';
													                  }
                                                                      $x++;
                                                                       } 
                                                                     ?>
																</select>
															</div>
															<div class="col-xs-5 col-sm-5">
																<select name="month" required class="selectpicker form-control" data-live-search="false">
                                                                     <?php 
                                                                      $x = 1; 

                                                                      while($x <= 12) {
                                         
												                      if ($x < 10) {
														              $x = "0$x";
													                  print '<option '; if ($mymonth == $x ) { print ' selected '; } print ' value="'.$x.'">'.$x.'</option>';
													                  }else{
													                  print '<option '; if ($mymonth == $x ) { print ' selected '; } print ' value="'.$x.'">'.$x.'</option>';
													                  }
                                                                      $x++;
                                                                       } 
                                                                     ?>
																</select>
															</div>
															<div class="col-xs-4 col-sm-4">
																<select name="year" class="selectpicker form-control" data-live-search="false">
													            <?php 
                                                                 $x = date('Y'); 
                                                                 $yr = 60;
													             $y2 =  $yr - $x;
                                                                 while($x > $y2) {
                                         
													             print '<option '; if ($myyear == $x ) { print ' selected '; } print ' value="'.$x.'">'.$x.'</option>';
                                                                 $x = $x - 1;
                                                                  } 
                                                                  ?>
																</select>
															</div>
														</div>
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Email</label>
														<input type="email" name="email" required class="form-control" value="<?php echo "$myemail"; ?>" placeholder="Enter your email address">
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="form-group">
													
													<div class="col-sm-6 col-md-4">
														<label>Education Level</label>
														<div class="form-group">
															<select name="education" required class="selectpicker show-tick form-control" data-live-search="false">
																<option disabled value="">Select</option>
																<option <?php if ($myedu == "-") { print ' selected '; } ?> value="">-</option>
																<option <?php if ($myedu == "Secondary") { print ' selected '; } ?> value="Secondary">Secondary</option>
																<option <?php if ($myedu == "A Level") { print ' selected '; } ?>value="A Level">A Level</option>
																<option <?php if ($myedu == "National Certificate") { print ' selected '; } ?>value="National Certificate">National Certificate</option>
																<option <?php if ($myedu == "Diploma") { print ' selected '; } ?>value="Diploma">National Diploma</option>
																<option <?php if ($myedu == "HND") { print ' selected '; } ?>value="HND">HND</option>
																<option <?php if ($myedu == "Degree") { print ' selected '; } ?>value="Degree">Degree</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6 col-md-4">
														<div class="form-group">
															<label>Course</label>
															<select name="title" required class="selectpicker show-tick form-control" data-live-search="false">
																<option disabled value="">Select</option>
																<option <?php if ($mytitle == "") { print ' selected '; } ?> value="">-</option>
																<option <?php if ($mytitle == "Information Technology") { print ' selected '; } ?> value="Information Technology">Information Technology</option>
																<option <?php if ($mytitle == "Human Resources") { print ' selected '; } ?>value="Human Resources">Human Resources</option>
																<option <?php if ($mytitle == "Banking And Finance") { print ' selected '; } ?>value="Banking And Finance">Banking And Finance</option>
																<option <?php if ($mytitle == "Accountants") { print ' selected '; } ?>value="Accountants">Accountants</option>
																<option <?php if ($mytitle == "Purchasing And Supply") { print ' selected '; } ?>value="Purchasing And Supply">Purchasing And Supply</option>
																<option <?php if ($mytitle == "Marketing") { print ' selected '; } ?>value="Marketing">Marketing</option>
															</select>
														</div>
													</div>
														
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">

													<div class="form-group">
														<label>ID Number</label>
														<input name="zip" required type="text" class="form-control" value="<?php echo "$myzip"; ?>">
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label>Gender</label>
														<select name="gender" required class="selectpicker show-tick form-control" data-live-search="false">
															<option disabled value="">Select</option>
															<option <?php if ($mygender == "Male") { print ' selected '; } ?> value="Male">Male</option>
															<option <?php if ($mygender == "Female") { print ' selected '; } ?>value="Female">Female</option>
														</select>
													</div>



												</div>
												
												
												
												<div class="clear"></div>
												
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Address</label>
														<input name="street" required type="text" class="form-control" value="<?php echo "$mystreet"; ?>">
													</div>
													
												</div>

												<div class="clear"></div>
												

												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>town</label>
														<select name="town" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Select</option>
						                                   <?php
														   require '../constants/db_config.php';
														   try {
                                                           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                                           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_town ORDER BY town_name");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($mytown == $row['town_name']) { print ' selected '; } ?> value="<?php echo $row['town_name']; ?>"><?php echo $row['town_name']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" name="phone" required class="form-control" value="<?php echo "$myphone"; ?>">
													</div>
													
												</div>

												


												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Competence Skills</label>
														<textarea name="about" class="bootstrap3-wysihtml5 form-control" placeholder="Enter your short description ..." style="height: 200px;"><?php echo "$mydesc"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<button type="submit" class="btn btn-primary">Update</button>
													<button type="reset" class="btn btn-primary btn-inverse">Cancel</button>
												</div>

											</div>
											
										</form><br>
										
										<form action="" method="POST" enctype="multipart/form-data">
										<div class="row gap-20">
										<div class="col-sm-12 col-md-12">
												
										<div class="form-group bootstrap3-wysihtml5-wrapper">
										<label>Display Image</label>
										<input accept="image/*" type="file" name="image"  required >
										</div>
													
										</div>
												
										<div class="clear"></div>

										<div class="col-sm-12 mt-10">
										<button type="submit" name="send" class="btn btn-primary">Update</button>
										<?php 
										if ($myavatar == null) {

										}else{
										?><a onclick = "return confirm('Are you sure you want to delete your avatar ?')" class="btn btn-primary btn-inverse" href="app/drop-dp.php">Delete</a> <?php
										}
										?>
										</div>
										</div>
										</form>
									
								</div>

							</div>
							
						</div>

					</div>

				</div>
			
			</div>
<?php

$db = mysqli_connect("localhost", "root", "", "opss_db");

if (isset($_POST['send'])) {


    $filetmp= $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    $filetype = $_FILES['image']['tmp_name'];
    $filepath= "uploads/".$filename;

    move_uploaded_file( $filetmp,$filepath);


    mysqli_query ($db,"UPDATE `tbl_users` SET `avatar`='$filepath' WHERE `member_no`='$myid'");

    ?>
	<script>
		alert('Profile Successfully Updated');
		window.location = "index.php";
	</script>
    <?php

}

?>
<?php

include "footer.php";
?>