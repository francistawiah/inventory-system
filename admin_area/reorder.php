<?php 
	
	 $active = 'Reorder';
 	 include("includes/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Reorder </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Reorder</li>
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
              <div class="card-body">
             <div class="card">
            <div class="card-header">
              <h3 class="card-title">Low Stock Products </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Product Name</th>
                  <th>Supplier</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Category</th>          
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php
                        
                        $i = 0;
                        $query = mysqli_query($con,"select * from product natural join supplier natural join category where prod_qty <= reorder order by prod_name") or die(mysqli_error());
                      while($row = mysqli_fetch_array($query))
                     {
    
                            $i++;

                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['supplier_name'];?></td>
                        <td><?php echo $row['prod_qty'];?></td>
                        <td><?php echo number_format($row['prod_price'],2);?></td>
                        <td><?php echo $row['cat_name'];?></td>
                        <td>
                        <a href="#">
                          <button class="btn btn-success" type="submit" name="request">
                          Make Request
                          </button>
                        </a>
                       </td>
                       </tr>
                 <?php } ?>          
                </tbody>
                <tfoot>
                <tr>
                   <th>No.</th>
                  <th>Product Name</th>
                  <th>Supplier</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Category</th>          
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
<?php include("includes/footer-links.php"); ?>