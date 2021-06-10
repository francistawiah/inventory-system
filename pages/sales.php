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
    <title>Sales Report | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
  <script type="text/javascript" src="../dist/js/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../plugins/daterangepicker/daterangepicker.css" />
    <style type="text/css">
      h5, h6{
        text-align:center;
      }
		

      @media print {
          .btn-print {
            display:none !important;
		  }
		  .main-footer	{
			display:none !important;
		  }
		  .box.box-primary {
			  border-top:none !important;
		  }
		  .angel{
			  display:none !important;
		  }
          
      }

      table tr td {
           border-right: 4px solid #fff;
    }

  
      
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

      .btn-display
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;

      }

      .btn-display:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
      }

      .btn-prt
      {
          background: #00a65a;
          padding: 10px;
          margin-top: 40px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
          margin-left: 5px;
      }

      .btn-prt:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
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
    }

    table
    {
      background-color: #00a65a; 
      color: #fff; 
      margin-top: 20px; 
      font-weight: 700;
      border: 4px solid #e3e3e3;  
      padding: 50px;
    }

    </style>
 </head>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php'); ?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
        <section class="content content-cus">
        <div class="col-md-12">
			  <div class="box angel">
				<div class="box-header">
				  <h3 class="box-title"> Select Date </h3>
          <hr>
				</div>
				<div class="box-body">
				  <form method="post">
					<div class="form-group col-md-6">
						<label>Date range:</label>
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						<input type="text" name="date" class="form-control pull-right active" id="reservation" required>
					</div>
					</div>
          <br>
					<button type="submit" class="btn-display" name="display">Display</button>
				  </form>
         </div>
        </div>       
        </div>

		<?php
    		if (isset($_POST['display']))
    	{
    		    $date   = $_POST['date'];
    		    $date   = explode('-',$date);
    		    $branch = $_SESSION['branch'];		
    			  $start  = date("Y/m/d",strtotime($date[0]));
    			  $end    = date("Y/m/d",strtotime($date[1]));
    ?>
		<div class="col-md-12">
		
    <?php
    include('../dist/includes/dbcon.php');
    $branch = $_SESSION['branch'];
    $query  = mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
       $row = mysqli_fetch_array($query);
        
?>      
                  <h5 style="font-size: 20px; color: #00a65a;"><b><?php echo $row['branch_name'];?></b> </h5>  
                  <h6 style="font-size: 20px; color: #00a65a;">Address: <?php echo $row['branch_address'];?></h6>
                  <h6 style="font-size: 20px; color: #00a65a;">Contact: <?php echo $row['branch_contact'];?></h6>
                  
				  <h5 style="font-size: 20px; color: #00a65a;"><b>Cash Sales Report as of <?php echo date("M d, Y",strtotime($start))." to ".date("M d, Y",strtotime($end));?></b></h5>
                  
		
			            <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Transaction #</th>
                        <th>Product</th>
                        <th>Qty</th>
            					  <th>Price</th>
                        <th>Total Amount</th>
                        <!--<th>Amount Paid</th> -->
                        <th>Profit Margin</th>
                        <th>Profit</th>
                        <th>Date Paid</th>
                        <th colspan="9">OverAll Total</th>
                      </tr>
                    </thead>
                   <tbody>
                  <?php
                  	$query = mysqli_query($con,"select * from sales natural join sales_details natural join product where date(date_added)>='$start' and date(date_added)<='$end' and branch_id='$branch' and modeofpayment='cash' order by date_added")or die(mysqli_error($con));

                  		$all_qty = 0; $grand = 0; $get_sell = 0; $sum2 = 0; 

                  		while($row = mysqli_fetch_array($query))
                        {

                           $prod_id    = $row['prod_id'];
                           $total      = $row['qty'] * $row['price'];
                      		 $grand      = $grand + $total;
                           $get_sell  += $row['profit_margin'];
                           $sum2      += $row['discount'];
                           $prod_price = $row['prod_price'];

                           //Get Payment
                           $select_pay = "SELECT * FROM payment";
                           $run_pay    = mysqli_query($con, $select_pay);
                           $sum = 0;

                           while($row_pay = mysqli_fetch_array($run_pay))
                           {
                              $sum += $row_pay['payment'];
                           }
                                                      
                        
                        // Get Product From Stock
                        // Summation of the total qty through stockin on the same product
                        $get_stock_prod = "SELECT * FROM stockin WHERE prod_id = '$prod_id'";
                        $run_stock_prod = mysqli_query($con, $get_stock_prod);
                        
                        while($row_sp = mysqli_fetch_array($run_stock_prod))
                        {
                           $cpp         = $row_sp['cost_per_product'];
                        }
                                
                  ?>
                <tr>
                <td><?php echo $row['sales_id'];;?></td>
                
                <td><?php echo $row['prod_name'];?></td>
                
                <td><?php echo $row['qty'];?></td>
    						
                <td>₵<?php echo $row['price'];?></td>
                
                <td style="text-align:right">
                   ₵<?php echo number_format($row['qty'] * $row['price'],2);?>
                </td>
                
                <!--<td><?php echo $row['cash_tendered']; ?></td> -->
                <td>₵<?php echo $prod_price - $cpp; ?></td>
                <td>₵<?php echo $row['profit_margin']; ?></td>
                <td><?php echo date("M d, Y h:i a",strtotime($row['date_added']));?></td>    
    		
            <?php }?>                       
            </tr>	
            </tbody>
            <tfoot>
          <tr>
            
          </tr>

          <tr>
          <th colspan="9">Total Cash Sales</th>
          <th style="text-align:right;"><h4><b>₵<?php echo number_format($sum,2);?></b></h4></th>
        </tr>

				<tr>
            <th colspan="9">Total Discount</th>
            <th style="text-align:right;"><h4><b>₵<?php echo number_format($sum2,2);?></b></h4></th>
          </tr>   


          <tr>
            <th colspan="9">Total Profit</th>
            <th style="text-align:right;"><h4><b>₵<?php echo number_format($get_sell,2); ?></b></h4></th>
          </tr>   


          <tr>
            <th colspan="9">Overall Cash Sales</th>
            <th style="text-align:right;"><h4><b>₵<?php echo number_format($sum - $get_sell,2); ?></b></h4></th>
          </tr>   
          
          <tr>
            <th>Prepared by:</th>
            <th>Signature:</th>
          </tr> 
                <?php
                    
                    $id       = $_SESSION['id'];
                    $query    = mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
                    $row      = mysqli_fetch_array($query);
                ?>                      
            <tr>
              <th><?php echo $row['name'];?></th>
              <th></th> 
            </tr>  			  
             </tfoot>
            </table>
            
            <div style="margin-top: 20px; margin-bottom: 70px;">
            <a class = "btn-prt btn-print" href = "" onclick = "window.print()">
              <i class ="glyphicon glyphicon-print"></i>
              Print
            </a>
            <a class = "btn-prt btn-print" href="home.php">
              <i class ="glyphicon glyphicon-arrow-left"></i>
              Back to Homepage
            </a>  
            </div> 
            </div>
          </section>
        </div>
      </div>
      <?php include('../dist/includes/footer.php');?>
    </div>







  <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="../plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="../plugins/input-mask/jquery.inputmask.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="../plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../dist/js/demo.js"></script>
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
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

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
