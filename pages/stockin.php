<?php session_start();

if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stock-In | <?php include('../dist/includes/title.php'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style type="text/css">
      
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

      input[type="text"]
      {
        border: 1px solid #00a65a;
      }

     .box
     {
        border-top: 4px solid #00a65a;
        border-left: 4px solid #e3e3e3; 
        border-right: 4px solid #e3e3e3; 
        border-bottom: 4px solid #e3e3e3; 
     }

   

       .content-cus
    {
      position: relative;
      top: 30px;
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
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Stock In</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
	           <div class="col-md-4">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock-In Products</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="stockin_add.php" enctype="multipart/form-data">
  
                  <div class="form-group">
                    <label for="date">Product Name</label>
                    <div class="input-group col-md-12 select">
                    <select class="form-control select2" id="standard-select" name="prod_name" required>
                      <?php

            			     include('../dist/includes/dbcon.php');
            				   $query2 = mysqli_query($con,"select * from product where branch_id='$branch' order by prod_name")or die(mysqli_error());
            				    while($row = mysqli_fetch_array($query2))
                        {

            		       ?>

            				    <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?>    
                        </option>

		                <?php } ?>
                    </select>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="date">Supplier</label>
                    <div class="input-group col-md-12 select">
                    <select class="form-control select2" id="standard-select" name="supplier_name" required>
                      <?php

                       include('../dist/includes/dbcon.php');
                       $sel_sup = mysqli_query($con,"select * from supplier")or die(mysqli_error());
                        while($row_sup = mysqli_fetch_array($sel_sup))
                        {

                       ?>

                        <option value="<?php echo $row_sup['supplier_id'];?>">
                          <?php echo $row_sup['supplier_name'];?>    
                        </option>

                    <?php } ?>
                    </select>

                    </div>
                  </div>


                  <div class="form-group">
                    <label for="date">Brand Name</label>
                    <div class="input-group col-md-12 select">
                    <select class="form-control select2" id="standard-select" name="brand_name" required>
                      <?php

                       include('../dist/includes/dbcon.php');
                       $sel_brand = mysqli_query($con,"select * from brands")or die(mysqli_error());
                        while($row_brand = mysqli_fetch_array($sel_brand))
                        {

                       ?>

                        <option value="<?php echo $row_brand['brand_id'];?>"><?php echo $row_brand['brand_name'];?>    
                        </option>

                    <?php } ?>
                    </select>

                    </div>
                  </div>
		  
                  <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="date">Cost Per Product (If retail state retail price and wholesale otherwise)</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="cost_per_product" placeholder="Product Cost" required>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="input-group">
                      <button type="submit" class="btn-back" id="daterange-btn" name="">
                        Save
                      </button>
					             <button type="reset" class="btn-back" id="daterange-btn">
                        Clear
                      </button>
                    </div>
                  </div>
				          </form>	
                </div>
              </div>
            </div>
            
            <div class="col-xs-8">
              <div class="box">
    
                <div class="box-header">
                  <h3 class="box-title">Product Stock-In List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
        				        <th>Supplier</th>
                        <th>Brand</th>
                        <th>Cost Per Product</th>
                        <th>Total Cost</th>
        				        <th>Date Delivered</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    		
                        $branch = $_SESSION['branch'];
                    		
                        $sel_stock = "SELECT * FROM stockin WHERE branch_id = '$branch'";
                        $run_stock = mysqli_query($con, $sel_stock);
                    		
                        while($row = mysqli_fetch_array($run_stock))
                        {

                            $prod_id     = $row['prod_id'];
                            $supplier_id = $row['supplier_id'];
                            $brand_id   = $row['brand_id'];

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
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $row['qty']; ?></td>
            						<td><?php echo $supplier_name; ?></td>
                        <td><?php echo $brand_name;?></td>
                        <td>₵<?php echo number_format($row['cost_per_product'],2);?></td>
                        <td>₵<?php echo number_format($row['qty']*$row['cost_per_product'],2);?></td>
            						<td><?php echo $row['date'];?></td>
                        </tr>                   
                    <?php } ?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Supplier</th>
                        <th>Brand</th>
                        <th>Cost Per Product</th>
                        <th>Total Cost</th>
                        <th>Date Delivered</th> 
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->        
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->






    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
