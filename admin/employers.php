<?php

include 'header.php';
include '../rb.php';

R::setup('mysql:host=localhost;dbname=opss_db', 'root', '');
?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Registered Companies</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>FullName</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                require '../constants/db_config.php';
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $employee="employer";
                    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role ='$employee'");
                    // $stmt->bindParam(':role', $employee);
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach($result as $course)

                    {
                        ?>

		                <tr>
			                <td><?php echo $course['first_name'].'   ' .$course['last_name'];?></td>
			                <td><?php echo $course['phone']; ?>
			                </td>
			                <td><?php echo $course['email']; ?></td>
			                <td> <?php echo $course['gender']; ?></td>

			                <td>X</td>
		                </tr>
                        <?php
                    }
                    $stmt->execute();

                }catch(PDOException $e)
                {

                }
                ?>
                </tbody>
                <tfoot>
                <tr>
	                <th>FullName</th>
	                <th>Phone Number</th>
	                <th>Email</th>
	                <th>Gender</th>
	                <th>Action</th>
                </tr>
                </tfoot>
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