<?php
include "header.php";
?>
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Home</a></li>
						<li><a ><?php echo "$compname"; ?></a></li>
						<li><span>Post a Job</span></li>
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
											?>
										<center><img alt="image" title="<?php echo "$compname"; ?>" width="180" height="100" src="<?php echo "$logo"; ?>"/></center>
										<?php
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
											<h3 class="text-left">Post a Job</h3>
										</div>

										<form class="post-form-wrapper" action="app/post-job.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php require 'constants/check_reply.php'; ?>
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>Job Title</label>
														<input name="title" required type="text" class="form-control" placeholder="Enter job title">
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
		                                                    ?> <option <?php if ($town == $row['town_name']) { print ' selected '; } ?> value="<?php echo $row['town_name']; ?>"><?php echo $row['town_name']; ?></option> <?php
	 
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
                                                                    ?> <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option> <?php

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
														<input name="deadline" required type="text" class="form-control" placeholder="Eg: 30/12/2019">
													</div>
													
												</div>
												<div class="col-sm-4 col-md-4">

													<div class="form-group mb-20">
														<label>Duration:</label>
														<select name="experience" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected >Select</option>
															<option value="6  months">6 Months</option>
															<option value="1 year">1 year</option>\
														</select>
													</div>


												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Description</label>
														<textarea class="form-control bootstrap3-wysihtml5" name="description" required placeholder="Enter description ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Responsibilies</label>
														<textarea name="responsiblities" required class="form-control bootstrap3-wysihtml5" placeholder="Enter responsiblities..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Requirements</label>
														<textarea name="requirements" required class="form-control bootstrap3-wysihtml5" placeholder="Enter requirements..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												

												
												<div class="clear"></div>
												

												
												<div class="clear mb-10"></div>

												
												<div class="clear mb-15"></div>

												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<button type="submit"  onclick = "validate(this)" class="btn btn-primary btn-lg">Post Your Job</button>
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