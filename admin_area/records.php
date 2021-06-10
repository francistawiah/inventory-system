<?php 
	
	 $active = 'Expense Category';
 	 include("includes/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Expense Categories </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Expense Categories</li>
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
                	Add New Expense Category 
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title">Expense Category Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
                        
                        $i = 0;
                        $sel_cat = "SELECT * FROM expense_category";
                        $run_cat = mysqli_query($con, $sel_cat);
                        
                        while($row = mysqli_fetch_array($run_cat))
                        {
                            $cat_id     = $row['expense_cat_id'];
                            $cat_name   = $row['expense_cat_name'];

                            $i++;

                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cat_name; ?></td>
                        
                        <td>
                        <a href="#update<?php echo $cat_id;?>" data-target="#update<?php echo $cat_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-edit text-blue"></i>
                        </a>

                         <a href="#delete<?php echo $cat_id; ?>" data-target="#delete<?php echo $cat_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-trash text-red"></i>
                        </a>
                       </td>
                       </tr>

          <!-- Update Modal -->
          <div id="update<?php echo $cat_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Expense Category Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="expense-cat-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Category Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="cat_id" value="<?php echo $cat_id; ?>" required>
                <input type="text" name="cat_name" class="form-control" value="<?php echo $cat_name; ?>" required>
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
       <div id="delete<?php echo $cat_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
         <h4 class="modal-title">Delete Expense Category Details</h4>
         </div>
         <div class="modal-body">
          <form class="form-horizontal" method="post" action="expense-cat-del.php">
             
          <input type="hidden" class="form-control" name="cat_id" value="<?php echo $cat_id; ?>" required> 
                      
          <p>Are you sure you want to <b>Delete</b> this Expense Category?</p>
              
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
                   <th>Category Name</th>
                   <th>Category Status</th>
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
                <h4 class="modal-title">Add New Category </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="expense-cat-add.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Expense Category Name</label>
              <div class="col-lg-9">
                <input type="text" name="cat_name" class="form-control" required> 
              </div>
            </div> 

            </div><br>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Category</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

<?php include("includes/footer-links.php"); ?>