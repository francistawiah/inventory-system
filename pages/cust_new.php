<?php 

session_start();

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
    <title>Customer | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 </head>

 <style type="text/css">
    
    input[type="text"]
    {
       border: 2px solid #fff;
    }  

    .box
    {
      border: 4px solid #605ca8;
      border-top: 4px solid #605ca8;
      background: #605ca8;
      border-radius: 10px;
    }

    .box-title
    {
      color: #fff;
      padding-left: 30px;

    }

    .control-label
    {
      color: #fff;
      padding-left: 30px;
      padding-bottom: 10px;
      font-size: 17px;
    }

    .txt-input
    {
      position: relative;
      left: 30px;
    }

    .btn-name
    {
       border: 2px solid #fff;
       border-radius: 5px;
       padding: 10px;
       color: #605ca8;
       background: #fff;
       font-weight: 700;
       margin-bottom: 30px;
    }

    .btn-name:hover
    {
      background: #605ca8;
      color: #fff;
      border: 2px solid #fff;
    }

    .c-name
    {
      color: #fff;
      padding-top: 10px; 
      font-size: 17px;
      padding-left: 30px;
      padding-bottom: 10px;
    }

    .select2
    {
       position: relative;
       left: 30px;
    }

    .btn-search
    {
       border: 2px solid #fff;
       border-radius: 5px;
       padding: 10px;
       margin-left: 30px;
       color: #605ca8;
       background: #fff;
       font-weight: 700;
       margin-bottom: 10px;
    }

    .btn-search:hover
    {
      background: #605ca8;
      color: #fff;
      border: 2px solid #fff;
    }

    .btn-back
    {
      position: relative;
      top: 20px;
       border: 2px solid #fff;
       border-radius: 5px;
       padding: 10px;
       color: #fff;
       background: #605ca8;
       font-weight: 700;
       text-decoration: none;
    }

    .btn-back:hover
    {
      background: #fff;
      color: #605ca8;
      border: 2px solid #605ca8;
    }

    .content-cus
    {
      position: relative;
      top: 50px;
    }

  

 </style>

  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customer</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
             <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Add New Customer</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="customer_add.php" enctype="multipart/form-data" class="form-horizontal">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date" class="control-label">Last Name</label>
                        <div class="input-group col-sm-8">
                          <input type="text" class="form-control txt-input" id="date" name="last" placeholder="Customer Last Name" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">  
                      <div class="form-group">
                        <label for="date" class="control-label">First Name</label> 
                        <div class="input-group col-md-8">
                          <input type="text" class="form-control txt-input" id="date" name="first" placeholder="Customer First Name" required>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>

                    <!--
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Contact #</label>
                        <div class="input-group col-md-8">  
                          <input type="text" class="form-control pull-right" id="date" name="contact" placeholder="Contact Number" required>
                        </div>
                      </div>  
                    </div>
                          
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Address</label>   
                        <div class="input-group col-md-8">
                          <textarea class="form-control pull-right" id="date" name="address" placeholder="Complete Address"></textarea>
                        </div>
                      </div>
                    </div>   -->  

                    
          
                       <div class="col-md-12">
                       <div class="col-md-12">
                        <button class="btn-name" id="daterange-btn" name="">Next</button>
                     </div>  
                    </div>  
                  </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Search Existing Customer</h3>
                </div>
                <div class="box-body">
                
                <form method="post" action="cash_transaction.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="date" class="c-name">Search Customer Name</label>
                    <div class="input-group col-md-12">
                      
                      <select class="form-control select2" style="width: 70%;" name="cid" required>
                      
                      <?php
                       include('../dist/includes/dbcon.php');
                        $query2=mysqli_query($con,"select * from customer where branch_id='$branch' order by cust_last, cust_first")or die(mysqli_error());
                          while($row2=mysqli_fetch_array($query2)){
                      ?>

                     <option value="<?php echo $row2['cust_id'];?>"><?php echo $row2['cust_last'].", ".$row2['cust_first'];?>
                     </option>
                     
                     <?php } ?>

                    </select>
                    </div>
                  </div>
      
                  
                  <div class="form-group">
                    <div class="input-group col-md-12">
                      <button class="btn-search" id="daterange-btn" name="">
                        Next
                      </button>
                    </div>
                  </div>
                 </form> 
        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            

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
