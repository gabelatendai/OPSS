<?php
include "header.php";

$conn = mysqli_connect("localhost", "root", "", "opss_db");

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
                  <th>Town</th>
                  <th>Category</th>
                  <th>Closing Date</th>
                  <th>Date Posted</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

<?php
require '../constants/db_config.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM tbl_jobs ORDER BY category");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $course)

    {
        $id=  $course['job_id'];
     ?>

	    <tr>
		    <td><?php echo $course['title'];?></td>
		    <td><?php echo $course['town']; ?></td>
		    <td><?php echo $course['category']; ?></td>
		    <td> <?php echo $course['closing_date']; ?></td>
		    <td> <?php echo $course['date_posted']; ?></td>
		    <td>
			    <a class="pull-right btn btn-danger" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
				    <i class="glyphicon glyphicon-trash"></i></a>
		    </td><!-- delete modal user -->
		    <div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
				    <div class="modal-content">
					    <div class="modal-header">
						    <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Job</h4>
					    </div>
					    <div class="modal-body">
						    <div class="alert alert-danger">
							    Are you sure you want to delete?
						    </div>
						    <div class="modal-footer">
							    <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
							    <a href="deletejobs.php<?php echo '?id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
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