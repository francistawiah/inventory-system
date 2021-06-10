<?php 
	
	 $active = 'Supplier';
 	 include("includes/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Suppliers </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Suppliers</li>
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
                	Add New Supplier
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Suppliers Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Supplier Name</th>
                  <th>Address</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    
                        $sel_sup = "SELECT * FROM supplier";
                        $run_sup = mysqli_query($con, $sel_sup);
                        
                        while($row = mysqli_fetch_array($run_sup))
                        {
                            $sup_id      = $row['supplier_id'];
                            $sup_name    = $row['supplier_name'];
                            $sup_address = $row['supplier_address'];
                            $sup_contact = $row['supplier_contact'];
                            $sup_status  = $row['supplier_status'];
                            
                    ?>
                      <tr>
                        <td><?php echo $sup_name;    ?></td>
                        <td><?php echo $sup_address; ?></td>
                        <td><?php echo $sup_contact; ?></td>
                        <td><?php echo $sup_status;  ?></td>
            
                        <td>
                        <a href="#update<?php echo $sup_id;?>" data-target="#update<?php echo $sup_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-edit text-blue"></i>
                        </a>

                         <a href="#delete<?php echo $sup_id; ?>" data-target="#delete<?php echo $sup_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-trash text-red"></i>
                        </a>
                       </td>
                       </tr>

          <!-- Update Modal -->
          <div id="update<?php echo $sup_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Supplier Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="supplier-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Supplier Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>" required>
                <input type="text" name="sup_name" class="form-control" value="<?php echo $sup_name; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Address</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>" required>
                <input type="text" name="sup_address" class="form-control" value="<?php echo $sup_address; ?>" required>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-lg-3">Phone Number</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>" required>
                <input type="text" name="sup_contact" class="form-control" value="<?php echo $sup_contact; ?>" required>
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Supplier Status</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>" required>  
                <select class="form-control" name="sup_status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
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


        <!-- Delete Product Modal -->         
       <div id="delete<?php echo $sup_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
         <h4 class="modal-title">Delete Supplier Details</h4>
         </div>
         <div class="modal-body">
          <form class="form-horizontal" method="post" action="supplier-del.php">
             
          <input type="hidden" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>" required> 
                      
          <p>Are you sure you want to <b>Delete</b> this Supplier?</p>
              
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
        
<?php }?>          
                </tbody>
                <tfoot>
                <tr>
                   <th>Supplier Name</th>
                   <th>Address</th>
                   <th>Phone Number</th>
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
                <h4 class="modal-title">Add New Supplier </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="supplier-add.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Supplier Name</label>
              <div class="col-lg-9">
                <input type="text" name="sup_name" class="form-control" required> 
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Address</label>
              <div class="col-lg-9">
                <input type="text" name="sup_address" class="form-control" required> 
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Phone Number</label>
              <div class="col-lg-9">
                <input type="text" name="sup_contact" class="form-control" required> 
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Supplier Status</label>
              <div class="col-lg-9">
                <select class="form-control" name="sup_status" required>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>                  
                </select>  
              </div>
            </div>

            </div><br>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Supplier</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

<?php include("includes/footer-links.php"); ?>