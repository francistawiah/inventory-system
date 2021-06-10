<?php 
	
	 $active = 'Brand';
 	 include("includes/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Brand </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
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
                	Add New Brand
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Brand Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Brand Name</th>
                  <th>Brand Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    
                        $sel_brand = "SELECT * FROM brands";
                        $run_brand = mysqli_query($con, $sel_brand);
                        
                        while($row = mysqli_fetch_array($run_brand))
                        {
                            $brand_id     = $row['brand_id'];
                            $brand_name   = $row['brand_name'];
                            $brand_status = $row['brand_status'];
                            
                    ?>
                      <tr>
                        <td><?php echo $brand_name; ?></td>
                        <td><?php echo $brand_status; ?></td>
                        
                        <td>
                        <a href="#update<?php echo $brand_id;?>" data-target="#update<?php echo $brand_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-edit text-blue"></i>
                        </a>

                         <a href="#delete<?php echo $brand_id; ?>" data-target="#delete<?php echo $brand_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-trash text-red"></i>
                        </a>
                       </td>
                       </tr>

          <!-- Update Modal -->
          <div id="update<?php echo $brand_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Brand Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="brand-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Brand Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="brand_id" value="<?php echo $brand_id; ?>" required>
                <input type="text" name="brand_name" class="form-control" value="<?php echo $brand_name; ?>" required>
              </div>
            </div> 
 

            <div class="form-group">
              <label class="control-label col-lg-3">Brand Status</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" name="brand_id" value="<?php echo $brand_id; ?>" required>  
                <select class="form-control" name="brand_status">
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
       <div id="delete<?php echo $brand_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
         <h4 class="modal-title">Delete Brand Details</h4>
         </div>
         <div class="modal-body">
          <form class="form-horizontal" method="post" action="brand-del.php">
             
          <input type="hidden" class="form-control" name="brand_id" value="<?php echo $brand_id; ?>" required> 
                      
          <p>Are you sure you want to <b>Delete</b> this Brand?</p>
              
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
                   <th>Brand Name</th>
                   <th>Brand Status</th>
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
                <h4 class="modal-title">Add New Brand </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="brand-add.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Brand Name</label>
              <div class="col-lg-9">
                <input type="text" name="brand_name" class="form-control" required> 
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Brand Status</label>
              <div class="col-lg-9">
                <select class="form-control" name="brand_status" required>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>                  
                </select>  
              </div>
            </div>

            </div><br>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Brand</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

<?php include("includes/footer-links.php"); ?>