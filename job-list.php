<!doctype html>

<?php
include "header.php";

require 'constants/settings.php';
require 'constants/check-login.php';
$fromsearch = false;

if (isset($_GET['search']) && $_GET['search'] == "✓") {

}else{

}

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

if (isset($_GET['town']) && ($_GET['category']) ){
$cate = $_GET['category'];
$town = $_GET['town'];	
$query1 = "SELECT * FROM tbl_jobs WHERE category = :cate AND town = :town ORDER BY date_posted DESC LIMIT $page1,12";
$query2 = "SELECT * FROM tbl_jobs WHERE category = :cate AND town = :town ORDER BY date_posted DESC";
$fromsearch = true;

$slc_town = "$town";
$slc_category = "$cate";
$title = "$slc_category jobs in $slc_town";
}else{
$query1 = "SELECT * FROM tbl_jobs ORDER BY date_posted DESC LIMIT $page1,12";
$query2 = "SELECT * FROM tbl_jobs ORDER BY date_posted DESC";
$slc_town = "NULL";
$slc_category = "NULL";	
$title = "Job List";
}
R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB
$course=R::count('tbl_jobs');

?>
<div class="header-page-title">
	<div class="container">
		<h1>Available Jobs <small><?php echo $course; ?></small></h1>

		<ul class="breadcrumbs">
			<li><a href="#">Home</a></li>
			<li><a href="#">Jobs</a></li>
		</ul>
	</div>
</div>
</header>
<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 page-sidebar">
				<aside>
					<div class="white-container mb0">
						<div class="widget sidebar-widget jobs-search-widget">
							<h5 class="widget-title">Search</h5>

							<div class="widget-content">

								<form action="job-list.php" method="GET" autocomplete="off">

									<div class="second-search-result-inner">
										<span class="labeling">Search a job</span>
										<div class="row">

											<div class="col-md-12">
												<div class="form-group form-lg">
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
                                                            $cat = $row['category'];
                                                            ?>
															<option  <?php if ($slc_category == "$cat") { print ' selected '; } ?> value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                                                            <?php
                                                        }
                                                        $stmt->execute();

                                                    }catch(PDOException $e)
                                                    {

                                                    }

                                                    ?>

													</select>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group form-lg">
													<select class="form-control" name="town" required/>
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
                                                            $cnt = $row['town_name'];
                                                            ?>

															<option <?php if ($slc_town == "$cnt") { print ' selected '; } ?> value="<?php echo $row['town_name']; ?>"><?php echo $row['town_name']; ?></option>
                                                            <?php
                                                        }
                                                        $stmt->execute();

                                                    }catch(PDOException $e)
                                                    {

                                                    }

                                                    ?>
													</select>
												</div>
											</div>

											<div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
												<button name="search" value="✓" type="submit" class="btn btn-default">Search</button>
											</div>

										</div>
									</div>

								</form>
							</div>
						</div>

						<div class="widget sidebar-widget jobs-filter-widget">
							<h5 class="widget-title">Filter Results</h5>

							<div class="widget-content">
								<h6>By Town</h6>

								<div>
									<ul class="filter-list">
										<?php
										 $courses = R::findAll('tbl_town','LIMIT 10');


                                                            foreach ($courses as $course) {
										?>
										<li><a href="#"><?php echo $course->town_name ?> <span>(5678)</span></a></li>
										<?php } ?>
									</ul>

									<a href="#" class="toggle"></a>
								</div>

								<h6>By Industry</h6>

								<div>
									<ul class="filter-list"><?php
										 $courses = R::findAll('tbl_categories');


                                                            foreach ($courses as $course) {
										?>
										<li><a href="#"> <?php echo $course->category ?><span></span></a></li>
										<?php } ?>
									</ul>

									<a href="#" class="toggle"></a>
								</div>
								<h6>Date Posted</h6>

								<div class="range-slider clearfix">
									<div class="slider" data-min="1" data-max="60"></div>
									<div class="first-value"><span>1</span> days</div>
									<div class="last-value"><span>60</span> days</div>
								</div>

								<h6>Salary Range</h6>

								<div class="range-slider clearfix">
									<div class="slider" data-min="1" data-max="100000"></div>
									<div class="first-value">$ <span>1</span></div>
									<div class="last-value">$ <span>100000</span></div>
								</div>

								<input type="submit" class="btn btn-default mt30" value="Filter">
							</div>
						</div>
					</div>
				</aside>
			</div> <!-- end .page-sidebar -->

			<div class="col-sm-8 page-content">
				<!--<div id="jobs-page-map" class="white-container"></div>
-->
				<div class="title-lines">
					<h3 class="mt0">Available Jobs</h3>
				</div>
				<div class="clearfix mb30">
					<ul class="pagination pull-right">
                        <?php
                        $total_records = 0;
                        require 'constants/db_config.php';

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare($query2);
                            if ($fromsearch == true) {
                                $stmt->bindParam(':cate', $slc_category);
                                $stmt->bindParam(':town', $slc_town);
                            }
                            $stmt->execute();
                            $result = $stmt->fetchAll();
if($result) {
    foreach ($result as $row) {
        $total_records++;
    }
}else{
	echo '<h3 align="left" class="text-center">No Jobs Found</h3>';
}

                        }catch(PDOException $e)
                        {

                        }

                        $records = $total_records/12;
                        $records = ceil($records);
                        if ($records > 1 ) {
                            $prevpage = $page - 1;
                            $nextpage = $page + 1;

                            print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="job-list.php?page='.$prevpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }'';} print '"><i class="fa fa-chevron-left"></i></a></li>';
                            for ($b=1;$b<=$records;$b++)
                            {

                                ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="job-list.php?page=<?php echo "$b"; ?><?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }?>"><?php echo $b." "; ?></a></li><?php
                            }
                            print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="job-list.php?page='.$nextpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }'';} print '"><i class="fa fa-chevron-right"></i></a></li>';
                        }
                        ?>

					</ul>

				</div>

                <?php
                require 'constants/db_config.php';

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare($query1);
                    if ($fromsearch == true) {
                        $stmt->bindParam(':cate', $slc_category);
                        $stmt->bindParam(':town', $slc_town);
                    }
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $row)
                    {
                        $post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                        $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                        $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');

                        $compid = $row['company'];
                        $jobid = $row['job_id'];

                        $stmtb = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid' and role = 'employer'");
                        $stmtb->execute();
                        $resultb = $stmtb->fetchAll();
                        foreach($resultb as $rowb) {
                            $complogo = $rowb['avatar'];
                            $thecompname = $rowb['first_name'];

                        }

                        ?>
				<div class="jobs-item with-thumb">

					<div class="thumb">
<?php
										if ($complogo == null) {
										print '<center><img src="images/blank.png" alt=""></center>';
										}else{
											?>
                                            <center><img class="autofit2" alt="image"  src="employer/<?php echo $complogo ?>"/></center>
                                            	<?php
										}
										 ?>

					</div>
					<div class="clearfix visible-xs"></div>
					<div class="date"><?php echo "$post_date"; ?> <span><?php echo "$post_month"; ?></span></div>
					<h6 class="title"><a href="#"><?php echo $row['title']; ?></a></h6>
					<span class="meta"><?php   echo $thecompname = $rowb['town'].' |  '. $rowb['first_name']; ?></span>

					<ul class="top-btns">
						<li><a href="#" class="btn btn-gray fa fa-plus toggle"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-star"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-link"></a></li>
					</ul>

					<p class="description"><?php
                        $new_description=$row['description'];
                        if (strlen($new_description) > 20) {

                            // truncate string
                            $stringCut = substr($new_description, 0, 200);
                            $new_description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...  ';
                        }
                        echo $new_description; ?>





						</p>
					<a  href="explore-job.php?id=<?php echo $jobid;?>">View This Vacant</a>
				</div>
                <?php

                }


                }catch(PDOException $e)
                {

                } ?>
					<div class="clearfix">
					<ul class="pagination pull-right">
                        <?php
                        $total_records = 0;
                        require 'constants/db_config.php';

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare($query2);
                            if ($fromsearch == true) {
                                $stmt->bindParam(':cate', $slc_category);
                                $stmt->bindParam(':town', $slc_town);
                            }
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
                                $total_records++;
                            }


                        }catch(PDOException $e)
                        {

                        }

                        $records = $total_records/12;
                        $records = ceil($records);
                        if ($records > 1 ) {
                            $prevpage = $page - 1;
                            $nextpage = $page + 1;

                            print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="job-list.php?page='.$prevpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }'';} print '"><i class="fa fa-chevron-left"></i></a></li>';
                            for ($b=1;$b<=$records;$b++)
                            {

                                ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="job-list.php?page=<?php echo "$b"; ?><?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }?>"><?php echo $b." "; ?></a></li><?php
                            }
                            print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="job-list.php?page='.$nextpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&town='.$town.'&search=✓'; }'';} print '"><i class="fa fa-chevron-right"></i></a></li>';
                        }


                        ?>

					</ul>

				</div>
			</div> <!-- end .page-content -->
		</div>
	</div> <!-- end .container -->
</div>
 <?php
include "footer.php";