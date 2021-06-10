<?php 
	
	 $active = 'Stockin';
 	 include("includes/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Stock In </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Stock In</li>
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
                	Add New Stocks 
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Stock-In Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Supplier</th>
                  <th>Brand</th>
                  <th>Cost Price</th>
                  <th>Qty</th>
                  <th>Total Price</th>
                  <th>Date</th>
                  <th>Branch</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    
                        $sel_stock = "SELECT * FROM stockin";
                        $run_stock = mysqli_query($con, $sel_stock);
                        
                        while($row = mysqli_fetch_array($run_stock))
                        {
                            $stockin_id  = $row['stockin_id'];
                            $prod_id     = $row['prod_id'];
                            $supplier_id = $row['supplier_id'];
                            $brand_id    = $row['brand_id'];
                            $branch_id   = $row['branch_id'];
                            $date        = $row['date'];

                            // Get Product
                            $get_prod  = "SELECT * FROM product WHERE prod_id = '$prod_id'";
                            $run_prod  = mysqli_query($con, $get_prod);
                            $row_prod  = mysqli_fetch_array($run_prod);
                            $prod_name = $row_prod['prod_name'];

                            // Get Branch
                            $get_branch = "SELECT * FROM branch WHERE branch_id = '$branch_id'";
                            $run_branch = mysqli_query($con, $get_branch);
                            $row_branch = mysqli_fetch_array($run_branch);
                            $branch_name = $row_branch['branch_name']; 

                            // Get Product
                            $sel_prod = "SELECT * FROM product WHERE prod_id = '$prod_id'";
                            $run_prod = mysqli_query($con, $sel_prod);
                            $row_prod = mysqli_fetch_array($run_prod);
                            $product_name = $row_prod['prod_name'];

                            // Get Supplier
                            $sel_sup = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id'";
                            $run_sup = mysqli_query($con, $sel_sup);
                            $row_sup = mysqli_fetch_array($run_sup);
                            $supplier_name = $row_sup['supplier_name'];

                            // Get Supplier
                            $sel_brand = "SELECT * FROM brands WHERE brand_id = '$brand_id'";
                            $run_brand = mysqli_query($con, $sel_brand);
                            $row_brand = mysqli_fetch_array($run_brand);
                            $brand_name = $row_brand['brand_name'];
                        
                    ?>
                      <tr>
                        <td><?php echo $prod_name; ?></td>
                        <td><?php echo $supplier_name; ?></td>
                        <td><?php echo $brand_name;?></td>
                        <td>₵<?php echo number_format($row['cost_per_product'],2);?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td>₵<?php echo number_format($row['qty']*$row['cost_per_product'],2);?></td>
                        <td><?php echo date("M d, Y",strtotime($date)) ?></td>
                        <td><?php echo $branch_name; ?></td>
                        

                        <td>
                        <a href="#update<?php echo $stockin_id;?>" data-target="#update<?php echo $stockin_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-edit text-blue"></i>
                        </a>

                         <a href="#delete<?php echo $stockin_id; ?>" data-target="#delete<?php echo $stockin_id; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-trash text-red"></i>
                        </a>
                       </td>
                       </tr>

          <!-- Update Modal -->
          <div id="update<?php echo $stockin_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Stock Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="stockin-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Product Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>
                <select class="form-control" name="prod_name">
                <option value="<?php echo $row_prod['prod_id']; ?>"><?php echo $row_prod['prod_name']; ?></option>
                  <?php

                    $sel_prod = "SELECT * FROM product";
                    $run_prod = mysqli_query($con, $sel_prod);

                    while($row_prod = mysqli_fetch_array($run_prod))
                    {
                       $prod_id   = $row_prod['prod_id'];
                       $prod_name = $row_prod['prod_name'];

                       echo "<option value='$prod_id'>$prod_name</option>";
                    }

                  ?>  
                </select>
              </div>
            </div> 

            <div class="form-group">
             <label class="control-label col-lg-3">Supplier</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>  
                <select class="form-control" name="supplier">
                  <option value="<?php echo $row_sup['supplier_id']; ?>"><?php echo $row_sup['supplier_name']; ?></option>
                  <?php

                    $sel_supp = "SELECT * FROM supplier";
                    $run_supp = mysqli_query($con, $sel_supp);

                    while($row_supp = mysqli_fetch_array($run_supp))
                    {
                       $supplier_id = $row_supp['supplier_id'];
                       $supplier_name = $row_supp['supplier_name'];

                       echo "<option value='$supplier_id'>$supplier_name</option>";
                    }

                  ?>
                </select>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Brand</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>  
                <select class="form-control" name="brand">
                  <option value="<?php echo $row_brand['brand_id']; ?>"><?php echo $row_brand['brand_name']; ?></option>
                  <?php

                    $sel_brand = "SELECT * FROM brands";
                    $run_brand = mysqli_query($con, $sel_brand);

                    while($row_brand = mysqli_fetch_array($run_brand))
                    {
                       $brand_id = $row_brand['brand_id'];
                       $brand_name = $row_brand['brand_name'];

                       echo "<option value='$brand_id'>$brand_name</option>";
                    }

                  ?>
                </select>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Branch Name</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>  
                <select class="form-control" name="branch_name">
                  <option value="<?php echo $row_branch['branch_id']; ?>"><?php echo $row_branch['branch_name']; ?></option>
                  <?php

                    $sel_brch = "SELECT * FROM branch";
                    $run_brch = mysqli_query($con, $sel_brch);

                    while($row_brch = mysqli_fetch_array($run_brch))
                    {
                       $branch_id   = $row_brch['branch_id'];
                       $branch_name = $row_brch['branch_name'];

                       echo "<option value='$branch_id'>$branch_name</option>";
                    }

                  ?>
                </select>     
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Cost Price (₵)</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>  
                <input type="text" class="form-control" name="cost_price" value="<?php echo $row['cost_per_product']; ?>" required>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Quantity</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required>  
                <input type="text" class="form-control" name="qty" value="<?php echo $row['qty']; ?>" required>  
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
       <div id="delete<?php echo $stockin_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
         <h4 class="modal-title">Delete Stock Details</h4>
         </div>
         <div class="modal-body">
          <form class="form-horizontal" method="post" action="stockin-del.php">
             
          <input type="hidden" class="form-control" name="stockin_id" value="<?php echo $stockin_id; ?>" required> 
                      
          <p>Are you sure you want to <b>Delete</b> this Product Stock?</p>
              
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
                   <th>Product Name</th>
                   <th>Supplier</th>
                   <th>Brand</th>
                   <th>Cost Price</th>
                   <th>Qty</th>
                   <th>Total Price</th>
                   <th>Date</th>
                   <th>Branch</th>
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
                <h4 class="modal-title">Add New Stock </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="stockin-add.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Product Name</label>
              <div class="col-lg-9">
                <select class="form-control" name="prod_name" required>
                  <option disabled selected>Select Product</option>
                  <?php

                    $sel_prod = "SELECT * FROM product";
                    $run_prod = mysqli_query($con, $sel_prod);

                    while($row_prod = mysqli_fetch_array($run_prod))
                    {
                       $prod_id   = $row_prod['prod_id'];
                       $prod_name = $row_prod['prod_name'];

                       echo "<option value='$prod_id'>$prod_name</option>";
                    }

                  ?>                  
                </select>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Supplier</label>
              <div class="col-lg-9">
                <select class="form-control" name="supplier" required>
                  <option disabled selected>Select Supplier</option>
                  <?php

                    $sel_supp = "SELECT * FROM supplier";
                    $run_supp = mysqli_query($con, $sel_supp);

                    while($row_supp = mysqli_fetch_array($run_supp))
                    {
                       $supplier_id = $row_supp['supplier_id'];
                       $supplier_name = $row_supp['supplier_name'];

                       echo "<option value='$supplier_id'>$supplier_name</option>";
                    }

                  ?>                  
                </select>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Brand</label>
              <div class="col-lg-9">
                <select class="form-control" name="brand" required>
                  <option disabled selected>Select Brand</option>
                  <?php

                    $sel_brand = "SELECT * FROM brands";
                    $run_brand = mysqli_query($con, $sel_brand);

                    while($row_brand = mysqli_fetch_array($run_brand))
                    {
                       $brand_id = $row_brand['brand_id'];
                       $brand_name = $row_brand['brand_name'];

                       echo "<option value='$brand_id'>$brand_name</option>";
                    }

                  ?>                  
                </select>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Branch Name</label>
              <div class="col-lg-9">
                <select class="form-control" name="branch_name" required>
                  <option disabled selected>Select branch</option>
                  <?php

                    $sel_brch = "SELECT * FROM branch";
                    $run_brch = mysqli_query($con, $sel_brch);

                    while($row_brch = mysqli_fetch_array($run_brch))
                    {
                       $branch_id   = $row_brch['branch_id'];
                       $branch_name = $row_brch['branch_name'];

                       echo "<option value='$branch_id'>$branch_name</option>";
                    }

                  ?>                  
                </select>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Cost Price</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="cost_price" required>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Quantity</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="qty" required>  
              </div>
            </div> 

            </div><br>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Stock</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   

<?php include("includes/footer-links.php"); ?>