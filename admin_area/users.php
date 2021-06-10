<?php 
	
	 $active = 'Stores';
 	 include("includes/header.php"); 

  ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <a href="#add" data-target="#add" data-toggle="modal" class="btn btn-success">
                	Add User
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> User Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Branch Name</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php


                    $select_user = "SELECT * FROM user JOIN branch USING(branch_id)";
                    $run_user    = mysqli_query($con, $select_user);

                    while($row_user  = mysqli_fetch_array($run_user))
                    {
                        $user_id     = $row_user['user_id'];
                        $branch_id   = $row_user['branch_id'];
                        $username    = $row_user['username'];
                        $password    = $row_user['password'];
                        $name        = $row_user['name'];
                        $status      = $row_user['status'];

                        // Get Branch
                        $select_store = "SELECT * FROM branch WHERE branch_id = '$branch_id'";
                        $run_store    = mysqli_query($con, $select_store);
                        $row_user     = mysqli_fetch_array($run_store);
                        $branch_name  = $row_user['branch_name'];

                	?>

                <tr>
                  <td><?php echo $name;        ?></td>
                  <td><?php echo $branch_name; ?></td>
                  <td><?php echo $username;    ?></td>
                  <td> **************            </td>
                  <td><?php echo $status;      ?></td>
                  <td> 
                    <a href="#update<?php echo $user_id; ?>" data-target="#update<?php echo $user_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                      <i style="color: blue" class="fas fa-edit"></i>
                    </a>

                    <a href="#delete<?php echo $user_id; ?>" data-target="#delete<?php echo $user_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                      <i style="color: red" class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                


          <!-- Update Modal -->
          <div id="update<?php echo $user_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
          <div class="modal-header">
          <h4 class="modal-title">Update Users Details</h4>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" method="post" action="user-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Full Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>  
              </div>
            </div>  

            <div class="form-group">
            <label class="control-label col-lg-3">Branch Name</label>
            <div class="col-lg-9">
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>
            <select class="form-control" name="branch_name" required>
             <option value="<?php echo $branch_id ?>"><?php echo $branch_name; ?></option>
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
              <label class="control-label col-lg-3">Username</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Password</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required> 
                <input type="text" class="form-control" name="password" placeholder="Enter new password here">  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Status</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required> 
              <select class="form-control" name="status">
              <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
              <option value="Inactive">Inactive</option>
              <option value="Active">Active</option>
              </select>  
              </div>
            </div>

            </div><br>
            
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

         <!-- Delete Modal -->         
       <div id="delete<?php echo $user_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
          <h4 class="modal-title">Delete User Details</h4>
         </div>
         <div class="modal-body">
          <form class="form-horizontal" method="post" action="user-del.php">   
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required> 
            <p>Are you sure you want to <b>Delete</b> this User?</p>
         </div>
         <div class="modal-footer">
          <button type="submit" name="delete" class="btn btn-danger"> 
           Delete
          </button>
          <button type="button" class="btn btn-success" data-dismiss="modal">
           Close
          </button>
          </div>
         </form>
        </div>
        </div>
      </div>  
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Full Name</th>
                  <th>Branch Name</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
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