<?php 
	
	 $active = 'Product';
 	 include("includes/header.php"); 

  ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Products </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                	Add New Product 
                </a>
              </div>
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Product Information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Product</th>
                        <th>Supplier</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Total Qty</th>
                        <th>Qty Left</th>
                        <th>Qty Status</th>
                        <th>Price</th>
                        <th>Total Amt</th>
                        <th>Profit Margin</th>
                        <th>Profit</th>
                        <th>Branch</th>
                        <th>Product Status</th>
                        <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    
                  $query = mysqli_query($con,"SELECT * FROM product JOIN supplier USING(supplier_id) JOIN brands USING(brand_id) JOIN category USING(cat_id) ORDER BY prod_name")or die(mysqli_error());
                  
                  while($row = mysqli_fetch_array($query))
                  {
                      $prod_price = $row['prod_price'];
                      $prod_id    = $row['prod_id'];
                      $branch_id  = $row['branch_id'];

                      // Get branch
                      $get_branch = "SELECT * FROM branch WHERE branch_id = '$branch_id'";
                      $run_branch = mysqli_query($con, $get_branch);
                      $row_branch = mysqli_fetch_array($run_branch);
                      $branch_name = $row_branch['branch_name'];

                      // Get Product From Stock
                      // Summation of the total qty through stockin on the same product
                      $get_stock_prod = "SELECT * FROM stockin WHERE prod_id = '$prod_id'";
                      $run_stock_prod = mysqli_query($con, $get_stock_prod);
                      
                      $sum_qty = 0;

                      while($row_sp = mysqli_fetch_array($run_stock_prod))
                      {
                          $sum_qty += $row_sp['qty'];
                          $cpp         = $row_sp['cost_per_product'];
                          $stock_qty   = $row_sp['qty'];
                          $total_price = $sum_qty * $prod_price;
                          $total_stock = $cpp * $sum_qty;
                      }

                      ?>

                      <tr>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['supplier_name'];?></td>
                        <td><?php echo $row['brand_name'];?></td>
                        <td><?php echo $row['cat_name'];?></td>
                        <td><?php echo $sum_qty; ?></td>
                        <td><?php echo $row['prod_qty']; ?></td>
                        <td>
                        <?php 
                       
                        if ($row['prod_qty'] < 5)
                        {

                          echo "<span class='badge bg-red'>Low Stock Limit</span>";

  
                        }
                        else
                        {
                          echo "<span class='badge bg-green'>In-Stock</span>";
                        }

                        ?>
                        </td>
                        <td>₵<?php echo number_format($row['prod_price'],2);?></td>
                        <td><?php echo $total_price; ?></td>
                        <td><?php echo  $prod_price - $cpp; ?></td>
                        <td><?php echo $total_price - $total_stock; ?></td>
                        <!--<td><?php  echo $row['barcode'];?></td> -->
                        <!--<td><?php echo $row['reorder'];?></td>-->
                        <td><?php echo $branch_name; ?></td>
                        <td>

                          <?php 
                           
                        if ($row['prod_status'] == 'Active') 
                        {
                            echo "<span class='badge bg-green'>Active</span>";
                         }
                         else
                         {
                            echo "<span class='badge bg-red'>Inactive</span>";
                          }
                        ?>
                        </td>
                        <td>
                        <a href="#update<?php echo $row['prod_id'];?>" data-target="#update<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-edit text-blue"></i>
                        </a>

                         <a href="#delete<?php echo $row['prod_id'];?>" data-target="#delete<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-trash text-red"></i>
                        </a>

                        <a href="#share<?php echo $row['prod_id'];?>" data-target="#share<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                          <i class="fas fa-share text-green"></i>
                        </a>
                       </td>
                       </tr>

          <!-- Update Modal -->
          <div id="update<?php echo $prod_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <h4 class="modal-title">Update Product Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="product-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Product Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="prod_name">
                  <option value="<?php echo $row['prod_id']; ?>"><?php echo $row['prod_name']; ?></option>
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
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="supplier">
                  <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
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
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="brand">
                  <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>
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
              <label class="control-label col-lg-3">Categories</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="categories">
                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                  <?php

                    $sel_cat = "SELECT * FROM category";
                    $run_cat = mysqli_query($con, $sel_cat);

                    while($row_cat = mysqli_fetch_array($run_cat))
                    {
                       $cat_id   = $row_cat['cat_id'];
                       $cat_name = $row_cat['cat_name'];

                       echo "<option value='$cat_id'>$cat_name</option>";
                    }

                  ?>
                </select>     
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Branch Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
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
              <label class="control-label col-lg-3">Selling Price (₵)</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <input type="text" class="form-control" name="price" value="<?php echo $prod_price; ?>" required>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Status</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="status">
                  <option value="<?php echo $row['prod_status']; ?>"><?php echo $row['prod_status']; ?></option>
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
       <div id="delete<?php echo $prod_id; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="height:auto">
         <div class="modal-header">
             <h4 class="modal-title">Delete Product Details</h4>
         </div>

         <div class="modal-body">
          <form class="form-horizontal" method="post" action="product-del.php">
             
            <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required> 
                      
            <p>Are you sure you want to <b>Delete</b> this Product?</p>
              
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


          <!-- Share Modal -->
          <div id="share<?php echo $row['prod_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:auto">
           <div class="modal-header">
           <h4 class="modal-title">Transfer Product </h4>
           </div>
           <div class="modal-body">

            <form class="form-horizontal" method="post" action="share-update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Product Name</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="prod_name">
                  <option value="<?php echo $prod_id; ?>"><?php echo $row['prod_name']; ?></option>
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
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="supplier">
                  <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
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
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="brand">
                  <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>
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
              <label class="control-label col-lg-3">Categories</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="categories">
                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                  <?php

                    $sel_cat = "SELECT * FROM category";
                    $run_cat = mysqli_query($con, $sel_cat);

                    while($row_cat = mysqli_fetch_array($run_cat))
                    {
                       $cat_id   = $row_cat['cat_id'];
                       $cat_name = $row_cat['cat_name'];

                       echo "<option value='$cat_id'>$cat_name</option>";
                    }

                  ?>
                </select>     
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-lg-3">Branch From</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
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
              <label class="control-label col-lg-3">Branch To</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="branch_to">
                  <option disabled selected>Select branch to</option>
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
              <label class="control-label col-lg-3">Selling Price (₵)</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <input type="text" class="form-control" name="price" value="<?php echo $prod_price; ?>" required>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Quantity</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <input type="text" class="form-control" name="qty_trans" placeholder="Quantity to be transferred" required>  
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Transfer Reason</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <textarea class="textarea" name="trans_reason" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-3">Status</label>
              <div class="col-lg-9">
                <input type="hidden" class="form-control" name="prod_id" value="<?php echo $prod_id; ?>" required>  
                <select class="form-control" name="status">
                  <option value="<?php echo $row['prod_status']; ?>"><?php echo $row['prod_status']; ?></option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>     
              </div>
            </div> 

            </div><br>
            
            <div class="modal-footer">
            <button type="submit" class="btn btn-success"> Transfer Product </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   
        
<?php }?>          
                </tbody>
                <tfoot>
                <tr>
                   <th>Product</th>
                   <th>Supplier</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Total Qty</th>
                        <th>Qty Left</th>
                        <th>Qty Status</th>
                        <th>Price</th>
                        <th>Total Amt</th>
                        <th>Profit Margin</th>
                        <th>Profit</th>
                        <th>Branch</th>
                        <th>Product Status</th>
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
                <h4 class="modal-title">Add New Product </h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="product-add.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Product Name</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="prod_name" required>  
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
              <label class="control-label col-lg-3">Category</label>
              <div class="col-lg-9">
                <select class="form-control" name="categories" required>
                  <option disabled selected>Select Category</option>
                  <?php

                    $sel_cat = "SELECT * FROM category";
                    $run_cat = mysqli_query($con, $sel_cat);

                    while($row_cat = mysqli_fetch_array($run_cat))
                    {
                       $cat_id   = $row_cat['cat_id'];
                       $cat_name = $row_cat['cat_name'];

                       echo "<option value='$cat_id'>$cat_name</option>";
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
              <label class="control-label col-lg-3">Selling Price</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="price" required>  
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-lg-3">Product Status</label>
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
            <button type="submit" class="btn btn-success">Add Product</button>
            </div>
            </form>
            </div>
            </div>
            </div>
          <!--end of modal-->   










<?php include("includes/footer-links.php"); ?>