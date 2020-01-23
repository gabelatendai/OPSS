<?php

include "header.php";
?>
	<div class="header-banner">
		<div class="flexslider header-slider">
			<ul class="slides">
				<li>
					<img src="careershtml-updated/img/transparent.png" alt="">
					<div data-image="careershtml-updated/img/content/slide-1.png"></div>
				</li>

				<li>
					<img src="careershtml-updated/img/transparent.png" alt="">
					<div data-image="careershtml-updated/img/content/slide-2.png"></div>
				</li>

				<li>
					<img src="careershtml-updated/img/transparent.png" alt="">
					<div data-image="careershtml-updated/img/content/slide-3.png"></div>
				</li>
			</ul>
		</div>
	</div>
<h4 class="text-center">Find a Job </h4>
	<div class="header-search-bar">
	<div class="container">
		<form action="job-list.php" method="GET" autocomplete="off">

			<div class="form-holder">
				<div class="row gap-0">

					<div class="col-xss-6 col-xs-6 col-sm-6">
						<select class="form-control" name="category" required/>
						<option value="">-Select category-</option>
                        <?php
                        require 'constants/db_config.php';
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                            $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY category");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
                                ?>

								<option style="color:black" value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                                <?php
                            }
                            $stmt->execute();

                        }catch(PDOException $e)
                        {

                        }

                        ?>

						</select>
					</div>

					<div class="col-xss-6 col-xs-6 col-sm-6">
						<select class="form-control"  name="town" required/>
						<option value="">-Select City-</option>
                        <?php
                        require 'constants/db_config.php';
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                            $stmt = $conn->prepare("SELECT * FROM tbl_town ORDER BY town_name");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
                                ?>

								<option style="color:black" value="<?php echo $row['town_name']; ?>"><?php echo $row['town_name']; ?></option>
                                <?php
                            }
                            $stmt->execute();

                        }catch(PDOException $e)
                        {

                        }

                        ?>

						</select>
					</div>

					<div class="hsb-submit">
						<input type="submit" class="btn btn-default btn-block text-center" value="Search">
					</div>
				</div>

			</div>
		</form>
	</div>
	</div> <!-- end .header-search-bar -->

	<div class="header-banner">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="header-banner-box register">
						<div class="counter-container">
							<ul class="counter clearfix">
								<li class="zero">0</li>
								<li>3</li>
								<li>5</li>
								<li>1</li>
								<li>0</li>
								<li>9</li>
							</ul>

							<div><span>Jobs</span></div>
						</div>

						<a href="#" class="btn btn-default">Register Now</a>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="header-banner-box post-job">
						<img src="images/verified.png" alt="">

						<a href="#" class="btn btn-red">Post a Job</a>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end .header-banner -->
	</header> <!-- end #header -->
	<div id="page-content">
		<div class="container">
			<div class="row">


				<div class="col-sm-8 page-content">
					<div class="title-lines">
						<h3>Ojet Placement System</h3>
					</div>
					<div class="latest-jobs-section white-container">
						<p>Provides easy access to Internship and Applicants
							True to that saying, a Group Policy covers a large number of people at the same time thereby providing funeral
							benefits to many people at
							affordable premium rates.
						</p>
						<p>Groups include employees of companies, burial
							societies and other similar organizations and associations. Some corporate organizations contribute to this as an additional
							benefit for their employees.</p>
					</div> <!-- end .latest-jobs-section -->
					<div class="title-lines">
						<h3>Latest Jobs</h3>
					</div>
					<div class="latest-jobs-section white-container">
						<div class="flexslider clearfix">
							<ul class="slides">
                                <?php
                                require 'constants/db_config.php';
                                try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("SELECT * FROM tbl_jobs ORDER BY enc_id DESC LIMIT 8");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();


                                    foreach($result as $row) {
                                        //$jobcity = $row['city'];
                                        $jobtown = $row['town'];
                                        $type = $row['description'];
                                        $title = $row['title'];
                                        $closingdate = $row['closing_date'];
                                        $company_id = $row['company'];
                                        $post_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'd');
                                        $post_month = date_format(date_create_from_format('d/m/Y', $closingdate), 'F');
                                        $post_year = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y');

                                        $stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$company_id' and role = 'employer'");
                                        $stmtb->execute();
                                        $resultb = $stmtb->fetchAll();
                                        foreach($resultb as $rowb) {
                                            $complogo = $rowb['avatar'];
                                            $thecompname = $rowb['first_name'];

                                        }
                                        ?>
										<li>
											<div class="image">
												<a href="explore-job.php?jobid=<?php echo $row['job_id']; ?>" class="btn btn-default fa fa-search"></a>
												<a href="#" class="btn btn-default fa fa-link"></a>
											</div>

											<div class="content">
												<h6><?php echo "$title  ".'  at  '. "$thecompname"; ?></h6>
												<span class="location">Sydney, Australia</span>
												<p><?php
                                                    $new_description=$type;
                                                    if (strlen($new_description) > 20) {

                                                        // truncate string
                                                        $stringCut = substr($new_description, 0, 40);
                                                        $new_description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...  ';
                                                        echo "$new_description ";
                                                    }
                                                    ?>
													<a href="explore-job.php?jobid=<?php echo $row['job_id']; ?>" class="read-more">Read More</a></p>
											</div>
										</li>
                                        <?php

                                    }
                                }catch(PDOException $e)
                                {

                                }
                                ?>

							</ul>
						</div>
					</div> <!-- end .latest-jobs-section -->

					<div class="title-lines">
						<h3>Registered Companies</h3>
					</div>
					<div class="pt-0 pb-50 col-sm-8" >

						<div class="container">


							<div class="row top-company-wrapper with-bg">


                                <?php
                                require 'constants/db_config.php';
                                try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employer' ORDER BY rand() LIMIT 8");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();

                                    foreach($result as $row) {
                                        $complogo = $row['avatar'];
                                        ?>
										<div class="col-xss-12 col-xs-6 col-sm-4 col-md-3">

											<div class="top-company">
												<div class="image">
                                                    <?php
                                                    if ($complogo == null) {
                                                        print '<center><img class="autofit2" alt="image"  src="images/blank.png"/></center>';
                                                    }else{
                                                        ?>
	                                                    <center><img class="autofit2" alt="image"  src="<?php echo $complogo ?>"/></center>
                                                   <?php
                                                    }
                                                    ?>
												</div>
												<h6><?php echo $row['first_name'];?></h6>
												<a target="" href="company.php?ref=<?php echo $row['member_no']; ?>">View Company</a>
											</div>

										</div>
                                        <?php

                                        {

                                        }

                                    }}catch(PDOException $e)
                                {

                                }

                                ?>




							</div>

						</div>

					</div>
					 <!-- end .our-partners-section -->
					<!-- end .pricing-tables -->
				</div> <!-- end .page-content -->

				<div class="col-sm-4 page-sidebar">
					<aside>
						<div class="widget sidebar-widget white-container social-widget">
							<h5 class="widget-title">Share Us</h5>

							<div class="widget-content">
								<div class="row row-p5">
									<div class="col-xs-6 col-md-3 share-box facebook">
										<div class="count">86</div>
										<a href="#">Facebook</a>
									</div>

									<div class="col-xs-6 col-md-3 share-box twitter">
										<div class="count">2.2k</div>
										<a href="#">Twitter</a>
									</div>

									<div class="col-xs-6 col-md-3 share-box google">
										<div class="count">324</div>
										<a href="#">Google +</a>
									</div>

									<div class="col-xs-6 col-md-3 share-box linkedin">
										<div class="count">1.5k</div>
										<a href="#">LinkedIn</a>
									</div>
								</div>
							</div>
						</div>

					</aside>
				</div> <!-- end .page-sidebar -->
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->

<?php

include "footer.php";
?>