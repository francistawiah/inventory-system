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
            <h1>Stores / Branches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Stores</li>
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
                	Add Store
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Store Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone Contact</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php

                    $select_store = "SELECT * FROM branch";
                    $run_store = mysqli_query($con, $select_store);

                    while($row_store = mysqli_fetch_array($run_store))
                    {
                        $branch_id   = $row_store['branch_id'];
                        $branch_name = $row_store['branch_name'];
                        $address     = $row_store['branch_address'];
                        $phone       = $row_store['branch_contact'];		

                	?>

                <tr>
                  <td><?php echo $branch_name; ?></td>
                  <td><?php echo $address; ?></td>
                  <td><?php echo $phone; ?></td>
                  <td> 
                    <a href="#update<?php echo $branch_id; ?>" data-target="#update<?php echo $branch_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                      <i style="color: blue" class="fas fa-edit"></i>
                    </a>

                    <a href="#delete<?php echo $branch_id; ?>" data-target="#delete<?php echo $branch_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                      <i style="color: red" class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                


          <!-- Update Modal -->
          <div id="update<?php echo $branch_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Branch Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="store-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Branch Name</label>
              <div class="col-lg-9"><input type="hidden" class="form-control" name="branch_id" value="<?php echo $branch_id; ?>" required>  
              
                <input type="text" class="form-control" name="branch_name" value="<?php echo $branch_name; ?>" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Branch Address</label>
              <div class="col-lg-9"><input type="hidden" class="form-control" name="branch_id" value="<?php echo $branch_id; ?>" required>  
              
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Phone Number</label>
              <div class="col-lg-9"><input type="hidden" class="form-control" name="branch_id" value="<?php echo $branch_id; ?>" required>  
              
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required>  
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
       <div id="delete<?php echo $branch_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
             <h4 class="modal-title">Delete Branch Details</h4>
         </div>

         <div class="modal-body">
          <form class="form-horizontal" method="post" action="store-del.php">
             
            <input type="hidden" class="form-control" name="branch_id" value="<?php echo $row_store['branch_id']; ?>" required> 
                      
            <p>Are you sure you want to <b>Delete</b> this Branch?</p>
              
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
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone Contact</th>
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
                <h4 class="modal-title">Add New Branch </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="add-store.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Branch Name</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="branch_name" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Branch Address</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="address" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Phone Number</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="phone" required>  
              </div>
            </div> 

            </div><br>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Branch</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   










<?php include("includes/footer-links.php"); ?>