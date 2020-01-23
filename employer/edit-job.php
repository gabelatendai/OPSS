<!doctype html>
<html lang="en">

<?php 
require '../constants/settings.php'; 
require 'constants/check-login.php';
include '../rb.php';
$db = mysqli_connect("localhost", "root", "", "opss_db");
R::setup('mysql:host=localhost;dbname=opss_db', 'root', '');

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}
$jobid = $_GET['jobid'];
if(isset($_POST['update'])) {


    $title = $_POST['title'];
//$city  = ucwords($_POST['city']);
    $town = $_POST['town'];
    $category = $_POST['category'];
//$type = $_POST['jobtype'];
    $exp = $_POST['experience'];
    $desc = $_POST['description'];
    $rec = $_POST['req'];
    $res = $_POST['res'];
    $deadline = $_POST['deadline'];


    mysqli_query ($db,"UPDATE `tbl_jobs` SET `title`='$title',`town`='$town',`category`='$category',`experience`='$exp',`closing_date`='$deadline',`requirements`='$rec' WHERE `job_id`='$jobid'");

   // mysqli_query ($db,"UPDATE `tbl_jobs` SET `title`='$title',`town`='$town',`category`='$category',`experience`='$experience',`description`='$desc,`requirements`='$rec',`responsibility`='$res,`closing_date`='$deadline' WHERE `job_id`='$jobid'");

    echo "<script>alert('Successfully Updated!'); window.location='my-jobs.php'</script>";
    //$stmt = $conn->prepare("UPDATE tbl_jobs SET title = :title, town = :town, category = :category, description = :description, responsibility = :responsibility, requirements = :requirements WHERE job_id = :jobid AND company = '$myid'");
}
if (isset($_GET['jobid'])) {
//require '../constants/db_config.php';
$jobid = $_GET['jobid'];



   // $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid AND company = '$myid'");
    $row = R::findOne('tbl_jobs','job_id=? AND company=?',[$jobid,$myid]);

    $jobtitle = $row['title'];
	$jobcity = $row['city'];
	$jobtown = $row['town'];
	$jobcategory = $row['category'];
	//$jobtype = $row['type'];
	$experience = $row['experience'];
	$jobdescription = $row['description'];
	$jobrespo = $row['responsibility'];
	$jobreq = $row['requirements'];
	$closingdate = $row['closing_date'];		



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
						<li><a ><?php echo "$compname"; ?></a></li>
						<li><span><?php echo "$jobtitle"; ?></span></li>
					</ol>
					
				</div>
				
			</div>

			
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-sm-5 col-md-4">
							
								<div class="company-detail-sidebar">
									
									<div class="image">
										<?php 
										if ($logo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										}
										?>
									</div>
									
									<h2 class="heading mb-15"><h4><?php echo "$compname"; ?></h4>
								
									<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$zip"; ?> <?php echo "$city"; ?>. <?php echo "$street"; ?>, <?php echo "$town"; ?> <span class="block"> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?></span></p>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Established In:</h4>
											<?php echo "$esta"; ?>
										</li>
										<li>
											<h4 class="heading">Type:</h4>
											<?php echo "$mytitle"; ?>
										</li>
										<li>
											<h4 class="heading">People:</h4>
											<?php echo "$mypeople"; ?>
										</li>
										<li>
											<h4 class="heading">Website: </h4>
											<a target="_blank" href="https://<?php echo "$myweb"; ?>"><?php echo "$myweb"; ?></a>
										</li>
										<li>
											<h4 class="heading">Email: </h4>
											<?php echo "$mymail"; ?>
										</li>

									</ul>
									
									
									<a href="./" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>
									
								</div>
					
					
							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="company-detail-wrapper">

									<div class="company-detail-company-overview  mt-0 clearfix">
										
										<div class="section-title-02">
											<h3 class="text-left"><?php echo "$jobtitle"; ?></h3>
										</div>

										<form class="post-form-wrapper" action="" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php include 'constants/check_reply.php'; ?>
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>Job Title</label>
														<input name="title" value="<?php echo "$jobtitle"; ?>" required type="text" class="form-control" placeholder="Enter job title">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
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
		                                                    ?>
	                                                           <option <?php if ($jobtown == $row['town_name']) { print ' selected '; } ?> value="<?php echo $row['town_name']; ?>"><?php echo $row['town_name']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
													</div>
													
												</div>
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Job Category</label>
															<select name="category" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Select</option>
						                                   <?php
														   require '../constants/db_config.php';
														   try {
                                                           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                                           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                                                           $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($jobcategory == $row['category']) { print ' selected '; } ?> value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
											
														
													</div>
													
												</div>
												<div class="clear"></div>
											    <div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Closing Date</label>
														<input name="deadline" required type="text" class="form-control" value="<?php echo "$closingdate"; ?>" placeholder="Eg: 30/12/2019">
													</div>
													
												</div>
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group mb-20">
														<label>Duration:</label>
														<select name="experience" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected >Select</option>
															<option <?php if ($experience == "6 months") { print ' selected '; } ?> value="6 Months">6 Months</option>
															<option <?php if ($experience == "1 Year") { print ' selected '; } ?> value="1 Year">1 Year</option>
														</select>
													</div>
													
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Description</label>
														<textarea class="form-control bootstrap3-wysihtml5" name="description" required placeholder="Enter description ..." style="height: 200px;"><?php echo "$jobdescription"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Responsibilies</label>
														<textarea name="res" required class="form-control bootstrap3-wysihtml5" placeholder="Enter responsiblities..." style="height: 200px;"><?php echo "$jobrespo"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Requirements</label>
														<textarea name="req" required class="form-control bootstrap3-wysihtml5" placeholder="Enter requirements..." style="height: 200px;"><?php echo "$jobreq"; ?></textarea>
													</div>
													<input type="hidden" name="jobid" value="<?php echo "$jobid"; ?>">
												</div>
												
												<div class="clear"></div>
												

												
												<div class="clear"></div>
												

												
												<div class="clear mb-10"></div>

												
												<div class="clear mb-15"></div>

												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<button type="submit"  name="update" class="btn btn-primary btn-lg">Save Changes</button>
												</div>

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
<script type="text/javascript" src="../js/fileinput.min.js"></script>
<script type="text/javascript" src="../js/customs-fileinput.js"></script>

<script type="text/javascript" src="../js/jquery.sheepItPlugin.js"></script>
<script type="text/javascript" src="../js/customs-sheepItPlugin.js"></script>
