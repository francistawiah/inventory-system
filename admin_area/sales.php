<?php 
  
   $active = 'Sales';
   include("includes/header.php"); 

  ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Sales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3>Sales Per Branch</h3>
              </div>
              <div class="card-body">
                <div class="row">
                <?php

                    $select_branch = "SELECT * FROM branch";
                    $run_branch = mysqli_query($con, $select_branch);

                    while($row_branch = mysqli_fetch_array($run_branch)) 
                    {
                       $branch_id   = $row_branch['branch_id'];
                       $branch_name = $row_branch['branch_name'];

                       echo"

                            <div class='col-lg-3 col-6'>
                            <div class='small-box bg-success'>
                            <div class='inner'>
                             <p>$branch_name</p>
                            </div>
                            <div class='icon'>
                            <i class='fas fa-home'></i>
                            </div>
                             <a href='view-sales.php?branch=$branch_id' class='small-box-footer'>View Sales <i class='fas fa-arrow-circle-right'></i></a>
                            </div>
                            </div>


                       ";
                    }
                ?>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include("includes/footer.php"); ?>


          <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
          <div class="modal-header">
          <h4 class="modal-title">Add New User </h4>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" method="post" action="add-user.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Full Name</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="name" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Username</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="username" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Password</label>
              <div class="col-lg-9">
                <input type="password" class="form-control" name="password" required>  
              </div>
            </div>

            <div class="form-group">
            <label class="control-label col-lg-3">Branch Name</label>
            <div class="col-lg-9">
            <select class="form-control" name="branch_name" required>
            <option disabled selected>Select Branch</option>
              <?php
                      
                  $select_branch = "SELECT * FROM branch";
                  $run_branch    = mysqli_query($con, $select_branch);

                  while($row_branch = mysqli_fetch_array($run_branch)) 
                  {
                      $branch_id   = $row_branch['branch_id'];
                      $branch_name = $row_branch['branch_name'];

                      echo "<option value='$branch_id'>$branch_name</option>";
                  }      
              ?>
            </select>
            </div> 
            </div>

            <div class="form-group">
            <label class="control-label col-lg-3">Status</label>
            <div class="col-lg-9">
            <select class="form-control" name="status" required>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
            </div> 
            </div>

            </div><br>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add User</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

<?php include("includes/footer-links.php"); ?>