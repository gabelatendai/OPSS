<?php
include "header.php";

$db = mysqli_connect("localhost", "root", "", "opss_db");

?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Posted Jobs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Job Title</th>
                  <th>Name Of Applicant</th>
                  <th>Date Applied</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

<?php
require '../constants/db_config.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM tbl_job_applications ");
    $stmt->execute();
    $result = $stmt->fetchAll();



    foreach($result as $course)

    {
    	$user_id=$course['member_no'];
    	$id=$course['id'];
    	$jobid=$course['job_id'];
    	$status=$course['status'];


        $st =mysqli_query($db,"SELECT * FROM tbl_jobs WHERE job_id ='$jobid'");
        // $stm->execute();
        $resul = mysqli_fetch_array($st);
        $stm =mysqli_query($db,"SELECT * FROM tbl_users WHERE member_no ='$user_id'");
       // $stm->execute();
        $result = mysqli_fetch_array($stm);
        ?>

	    <tr>
		    <td><?php echo $resul['title'];?></td>
		    <td><?php echo $result['first_name']. ' '. $result['last_name']; ?></td>
		    <td><?php echo $course['application_date']; ?></td>
		    <td> <?php if($status==1){
		    	echo 'invited for interview';
			    }else{
		    	echo 'pending Invitation';
			    } ?></td>
		    <td>
			    <a class="pull-right btn btn-danger" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
				    <i class="glyphicon glyphicon-trash"></i></a>
		    </td><!-- delete modal user -->
		    <div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
				    <div class="modal-content">
					    <div class="modal-header">
						    <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Applicants</h4>
					    </div>
					    <div class="modal-body">
						    <div class="alert alert-danger">
							    Are you sure you want to delete?
						    </div>
						    <div class="modal-footer">
							    <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
							    <a href="deleteapplecant.php<?php echo '?id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
						    </div>
					    </div>
				    </div>
			    </div>
		    </div>

	    </tr>
	    <?php
    }
    $stmt->execute();

}catch(PDOException $e)
{

}
    ?>


                </tbody>
                <!--<tfoot>
                <tr>
	                <th>Job Title</th>
	                <th>Town</th>
	                <th>Category</th>
	                <th>Closing Date</th>
	                <th>Date Posted</th>
	                <th>Action</th>
                </tr>
                </tfoot>-->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
 <?php

include 'footer.php';
?>