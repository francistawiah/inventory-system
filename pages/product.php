
<?php 
      session_start();
      if(empty($_SESSION['id'])):
      header('Location:../index.php');
      endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <style>
      
      .btn-back
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;

      }


      .btn-back:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
      }

      .btn-add
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
      }

    .box
     {
         border-top: 5px solid #00a65a;
        border-left: 4px solid #e3e3e3; 
        border-right: 4px solid #e3e3e3; 
        border-bottom: 4px solid #e3e3e3; 
     }

     .select2
     {
       border: 1px solid #00a65a;
     }

    .content-cus
    {
      position: relative;
      top: 30px;
      margin-bottom: 30px;
    }
    </style>
 </head>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a>
              <a class="btn-add" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-white"></i> Add New Product </a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product List</h3>
                </div>
                <div class="box-body">
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
                        <th>Product Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php
		
              		$query = mysqli_query($con,"SELECT * FROM product JOIN supplier USING(supplier_id) JOIN brands USING(brand_id) JOIN category USING(cat_id) WHERE branch_id = '$branch' ORDER BY prod_name")or die(mysqli_error());
              		
                  while($row = mysqli_fetch_array($query))
                  {
                      $prod_id    = $row['prod_id'];
                      $prod_price = $row['prod_price'];
                      $reorder    = $row['reorder'];

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
                         // Total Stock qty by Selling Price = Total Selling Price
                         $total_price = $sum_qty * $prod_price;
                         // Total Stock qty by Cost price = Total Cost price from supplier 
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
                       
                        if ($row['prod_qty'] <= $reorder)
                        {

                          echo "<span class='badge bg-red'>Low Stock</span>";

                        }
                        elseif ($row['prod_qty'] == 0) 
                        {
                          echo "<span class='badge bg-red'>Stock-Out</span>";                                                      
                        }
                        else
                        {
                          echo "<span class='badge bg-green'>In-Stock</span>";
                        }

                        ?>
                        </td>
            			      <td>₵<?php echo number_format($row['prod_price'],2);?></td>
                        <td>₵<?php echo $total_price; ?></td>
                        <td>₵<?php echo $prod_price - $cpp; ?></td>
                        <td>₵<?php echo $total_price - $total_stock; ?></td>
									      <!--<td><?php  echo $row['barcode'];?></td> -->
            						<!--<td><?php echo $row['reorder'];?></td>-->
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
				<a href="#update<?php echo $row['prod_id'];?>" data-target="#update<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

         <a href="#delete<?php echo $row['prod_id'];?>" data-target="#delete<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
						</td>
              </tr>


        <div id="update<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        	<div class="modal-dialog">
        	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Product Details</h4>
              </div>
              <div class="modal-body">
        			  <form class="form-horizontal" method="post" action="product_update.php" enctype='multipart/form-data'>
              
        				<div class="form-group">
        					<label class="control-label col-lg-3" for="name">Product Name</label>
        					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['prod_id'];?>" required>  
        					  <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
        					</div>
        				</div> 
     
      				<div class="form-group">
      					<label class="control-label col-lg-3" for="file">Supplier</label>
      					<div class="col-lg-9">
      					    <select class="form-control select2" style="width: 100%;" name="supplier" required>
      						  <option value="<?php echo $row['supplier_id'];?>"><?php echo $row['supplier_name'];?></option>
      					      <?php
      						
							$query2=mysqli_query($con,"select * from supplier")or die(mysqli_error());
							  while($row2=mysqli_fetch_array($query2)){
					      ?>
							    <option value="<?php echo $row['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
					      <?php }?>
					    </select>
					</div>
				</div> 
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Price</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price" name="prod_price" value="<?php echo $row['prod_price'];?>" required>  
					</div>
				</div>

          <div class="form-group">
              <label class="control-label col-lg-3">Brand</label>
              <div class="col-lg-9">
                <select class="form-control select2" style="width: 100%;" name="brand" required>
              <option value="<?php echo $row['brand_id'];?>"><?php echo $row['brand_name'];?></option>
                <?php
            
              $queryb=mysqli_query($con,"select * from brands order by brand_name")or die(mysqli_error());
                while($rowb=mysqli_fetch_array($queryb)){
                ?>
                  <option value="<?php echo $rowb['brand_id'];?>"><?php echo $rowb['brand_name'];?></option>
                <?php }?>
              </select>
              </div><!-- /.input group -->
              </div><!-- /.form group -->
				
				      <div class="form-group">
							<label class="control-label col-lg-3" >Category</label>
							<div class="col-lg-9">
							  <select class="form-control select2" style="width: 100%;" name="category" required>
              <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                <?php
            
              $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
              </select>
							</div><!-- /.input group -->
						  </div><!-- /.form group -->
					<div class="form-group">
      					<label class="control-label col-lg-3" for="price">Barcode</label>
      					<div class="col-lg-9">
      					  <input type="number" class="form-control" id="barcode" name="barcode" value="<?php echo $row['barcode'];?>" required>  
      					</div>
      				</div>
      				<div class="form-group">
      					<label class="control-label col-lg-3" for="price">Reorder</label>
      					<div class="col-lg-9">
      					  <input type="number" class="form-control" id="price" name="reorder" value="<?php echo $row['reorder'];?>" required>  
      					</div>
      				</div>

              <div class="form-group">
              <label class="control-label col-lg-3" for="price">Status</label>
              <div class="col-lg-9">
                <select class="form-control" name="prod_status" id="price" style="width: 100%;" required>
                 <option value="Active">Active</option>
                 <option value="Inactive">Inactive</option>
              </select>
              </div>
            </div>

				
              </div><br><br><br><br><br><br><br><br><br><br><br><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Product</button>
              </div>
			       </form>
            </div>	
          </div><!--end of modal-dialog-->
      </div>
 <!--end of modal-->               

 <!-- Delete Product Modal -->
 <div id="delete<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Product</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="product_del.php">
             
                  <input type="hidden" class="form-control" name="prod_id" value="<?php echo $row['prod_id'];?>" required> 
                      
                      <p>Are you sure you want to remove Product?</p>
              
                    </div><br>
                   <div class="modal-footer">
                     
                      <a href="delete<?php echo $row['prod_id'];?>" style="color: #ffffff;">
                           <button type="submit" name="delete" class="btn btn-danger" >
                          Delete </button>
                    </a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
      
        </div><!--end of modal-dialog-->
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
                        <th>Product Status</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div>
            </div>
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

          <!-- Add Product Modal -->
        <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Product</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post" action="product_add.php" enctype='multipart/form-data'>
               
                        
                <div class="form-group">
                  <label class="control-label col-lg-3" for="name">Product Name</label>
                  <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                    <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name" required>  
                  </div>
                </div> 
       
              <div class="form-group">
                <label class="control-label col-lg-3" for="file">Supplier</label>
                <div class="col-lg-9">
                    <select class="form-control select2" style="width: 100%;" name="supplier" required>
                      <?php
                  
                    $query2 = mysqli_query($con,"select * from supplier")or die(mysqli_error());
                      while($row2 = mysqli_fetch_array($query2)){
                      ?>
                        <option value="<?php echo $row2['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
                      <?php }?>
                    </select>
                </div>
              </div> 
        
              <div class="form-group">
                <label class="control-label col-lg-3" for="price">Price</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="price" name="prod_price" placeholder="Product Price" required>  
                </div>
              </div>

              <div class="form-group">
              <label class="control-label col-lg-3" >Brand</label>
              <div class="col-lg-9">
                <select class="form-control select2" style="width: 100%;" name="brand" required>
                <?php
            
              $queryb=mysqli_query($con,"select * from brands order by brand_name")or die(mysqli_error());
                while($rowb = mysqli_fetch_array($queryb)){
                ?>
                <option value="<?php echo $rowb['brand_id'];?>"><?php echo $rowb['brand_name'];?></option>
                <?php }?>
              </select>
              </div><!-- /.input group -->
              </div><!-- /.form group -->
        
              <div class="form-group">
              <label class="control-label col-lg-3" >Category</label>
              <div class="col-lg-9">
              <select class="form-control select2" style="width: 100%;" name="category" required>
              
                <?php
            
              $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
              </select>
              </div><!-- /.input group -->
              </div><!-- /.form group -->
              <div class="form-group">
      					<label class="control-label col-lg-3" for="price">Barcode</label>
      					<div class="col-lg-9">
      					  <input type="number" class="form-control" id="barcode" name="barcode" required>  
      					</div>
      		  </div>
              <div class="form-group">
                <label class="control-label col-lg-3" for="price">Reorder</label>
                <div class="col-lg-9">
                  <input type="number" class="form-control" id="price" name="reorder" placeholder="Reorder Point">  
                </div>
              </div>
        
               <div class="form-group">
                <label class="control-label col-lg-3" for="price">Status</label>
                <div class="col-lg-9">
                  <select class="form-control" name="prod_status" id="price" style="width: 100%;" required>
                   <option value="Active">Active</option>
                   <option value="Inactive">Inactive</option>
                </select>
                </div>
              </div>

              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Product</button>
              </div>
            </form>
            </div>
        </div>
      </div><!--end of modal--> 

   
       <?php include('../dist/includes/footer_links.php');?>
   


  