<!doctype html>
<script type="text/javascript">
	function update(str)
	{

		var txt;
		var r = confirm("Are you sure you want to apply this job , you can not UNDO");
		if (r == true) {
			document.getElementById("data").innerHTML = "Please wait...";
			var xmlhttp;

			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("data").innerHTML = xmlhttp.responseText;
				}
			}

			xmlhttp.open("GET","app/apply-job.php?opt="+str, true);
			xmlhttp.send();
		} else {

		}

	}
</script>
<?php
include "header.php";
require 'constants/settings.php'; 
require 'constants/check-login.php';
require 'constants/db_config.php'; 

if (isset($_GET['id'])) {

$jobid = $_GET['id'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid");
	$stmt->bindParam(':jobid', $jobid);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$rec = count($result);
	if ($rec == "0") {
	header("location:./");	
	}else{

    foreach($result as $row)
    {
	$jobtitle = $row['title'];
	//$jobcity = $row['city'];
	$jobtown = $row['town'];
	$jobcategory = $row['category'];
	//$jobtype = $row['type'];
	$experience = $row['experience'];
	$jobdescription = $row['description'];
	$jobrespo = $row['responsibility'];
	$jobreq = $row['requirements'];
	$closingdate = $row['closing_date'];
	$opendate = $row['date_posted'];
	$compid = $row['company'];


	
	}
	}

					  
	}catch(PDOException $e)
    {

    }


}else{
@header("location:./");
}


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid'");
$stmt->execute();
$result = $stmt->fetchAll();


    foreach($result as $row)
    {
    $compname = $row['first_name'];
	$complogo = $row['avatar'];
	$compbout = $row['about'];
	$compnmbr = $row['phone'];
	$compemail = $row['email'];
	$com = $row['member_no'];
	}

					  
	}catch(PDOException $e)
    {

    }
	

//$today_date = strtotime(date('Y/m/d'));
$today_date = strtotime(date('d/m/Y'));
@$last_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y/m/d');
@$post_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'd');
@$post_month = date_format(date_create_from_format('d/m/Y', $closingdate), 'F');
@$post_year = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y');
@$conv_date = strtotime($last_date);

if ($today_date > $conv_date){
$jobexpired = true;
}else{
$jobexpired = false;
}
?>

<div class="header-page-title">
	<div class="container">
		<h1><?php echo "$jobtitle"; ?><small><?php echo "$jobtown"; ?></small></h1>


	</div>
</div>
</header> <!-- end #header -->

<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 page-sidebar">
				<aside>
					<div class="widget sidebar-widget white-container candidates-single-widget">
						<div class="widget-content">
							<div id="jobs-single-page-map" class="white-container"></div>

							<h5 class="bottom-line">Job Details</h5>

							<table>
								<tbody>

								<tr>
									<td>Location</td>
									<td><?php echo "$jobtown"; ?></td>
								</tr>

								<tr>
									<td>Role</td>
									<td><?php echo "$jobtitle"; ?></td>
								</tr>

								<tr>
									<td>Duration</td>
									<td><?php echo "$experience"; ?></td>
								</tr>

								</tbody>
							</table>

							<h5 class="bottom-line">Preffered Candidates</h5>

							<table>
								<tbody>
								<tr>
									<td>Career Level</td>
									<td>National Certificate</td>
								</tr>


								<tr>
									<td>Residence Location</td>
									<td><?php echo "$jobtown"; ?></td>
								</tr>

								<tr>
									<td>Gender</td>
									<td>-</td>
								</tr>

								<tr>
									<td>Nationality</td>
									<td>Zimbabwe</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</aside>
			</div> <!-- end .page-sidebar -->

			<div class="col-sm-8 page-content">
				<div class="clearfix mb30 hidden-xs">
					<a href="job-list.php" class="btn btn-gray pull-left">Back to Jobs</a>
					<div class="pull-right">
						<a href="#" class="btn btn-gray">Previous</a>
						<a href="#" class="btn btn-gray">Next</a>
					</div>
				</div>

				<div class="jobs-item jobs-single-item">
					<div class="thumb">
                        <?php
                        if ($complogo == null) {
                            print '<center>No Company Logo</center>';
                        }else{
                          ?><center><img class="autofit2" alt="image" width="180" height="100" src="employer/<?php echo "$complogo"; ?>"/></center>
                      <?php  }
                        ?></div>
					<div class="clearfix visible-xs"></div>


					<div class="date"><label>Posted On</label><br><?php echo $opendate; ?></div>

                   <div class="date"><label>Deadline</label><br><?php echo "$post_date"; ?> <span><?php echo "$post_month"; ?></span></div>
					<h6 class="title"><a href="#"><?php echo "$jobtitle"; ?></a></h6>
					<span class="meta"><?php echo "$jobtown"; ?></span>

					<ul class="top-btns">
						<li><a href="#" class="btn btn-gray fa fa-star"></a></li>
					</ul><h3>Job Description</h3>

					<p><?php echo nl2br($jobdescription); ?></p>


					<h3>Job Responsibilities</h3>

					<p><?php echo nl2br($jobrespo); ?></p>

					<h3>Requirements:</h3>
					<p><?php echo nl2br($jobreq); ?></p>

					<hr>

					<div class="clearfix">
                        <?php
                        if ($user_online == true) {
                            if ($jobexpired == true) {
                            	?>
	                            <a href="job-list.php" class="btn btn-default pull-left ">This Job Has Expired</a>

	                             <?php
                            }else{
                                if ($myrole == "employee") {
                                	?>

						<a href="app/apply-job.php?opt=<?php echo $jobid; ?>" class="btn btn-default pull-left">Apply for this Job</a>
				<?php }else{
                                    print '<a href="login.php" class="btn btn-default pull-left"><i class="flaticon-line-icon-set-padlock"></i> Login as employee to apply</a>';
                                }
                            }


                        }else{


                        ?>
	                  	<a href="login.php" class="btn btn-default pull-left  " >Login to Apply for this Job</a>
						<?php
						}

						?>

						<ul class="social-icons pull-right">
							<li><span>Share</span></li>
							<li><a href="#" class="btn btn-gray fa fa-facebook"></a></li>
							<li><a href="#" class="btn btn-gray fa fa-twitter"></a></li>
							<li><a href="#" class="btn btn-gray fa fa-google-plus"></a></li>
						</ul>
					</div>
				</div>

				<div class="title-lines">
					<h3 class="mt0">About the Recruiter</h3>
				</div>

				<div class="about-candidate-item">
					<div class="thumb"> <?php
                        if ($complogo == null) {
                            print '<center>No Company Logo</center>';
                        }else{
                        	?>
                            <center><img class="autofit2" alt="image" title="<?php echo "$compname"; ?>" width="180" height="100" src="employer/<?php echo "$complogo"; ?>"/></center>
                      <?php  }
                        ?></div>

					<h6 class="title"><a href="company.php?ref=<?php echo $com; ?>"><?php echo "$compname"; ?></a></h6>
					<span class="meta">

						<?php

                        $new_description=$compbout;
                        if (strlen($new_description) > 20) {

                            // truncate string
                            $stringCut = substr($new_description, 0, 400);
                            $new_description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...  ';
                        }
                        echo $new_description; ?>
						</span>

					<ul class="social-icons clearfix">
						<li><a href="#" class="btn btn-gray fa fa-facebook"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-twitter"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-google-plus"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-dribbble"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-pinterest"></a></li>
						<li><a href="#" class="btn btn-gray fa fa-linkedin"></a></li>
					</ul>

					<ul class="list-unstyled">
						<li><strong>Tel:</strong> <?php echo "$compnmbr"; ?></li>
						<li><strong>Email:</strong> <a href="#"><?php echo "$compemail"; ?></a></li>
					</ul>

					<a href="#" class="btn btn-default">Send Message</a>
				</div>
			</div> <!-- end .page-content -->
		</div>
	</div> <!-- end .container -->
</div> <!-- end #page-content -->

<?php

include "footer.php";
?>