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
    <title>Customer | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style>
      
      .btn-back
      {
          background: #605ca8;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;

      }

      .btn-back:hover
      {
         background: #fff;
         color: #605ca8;
         border: 1px solid #605ca8;
      }

    .box
     {
        border-top: 5px solid #605ca8;
        border-left: 4px solid #e3e3e3; 
        border-right: 4px solid #e3e3e3; 
        border-bottom: 4px solid #e3e3e3; 
     }

     .select2
     {
       border: 1px solid #605ca8;
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
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Customer List</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
            						<th>No. #</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>Contact </th>
                        <th>Action</th>
						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    		$branch = $_SESSION['branch'];
                    		$query = mysqli_query($con,"select * from customer where branch_id='$branch'")or die(mysqli_error());
                    		$i = 1;
                    		while($row = mysqli_fetch_array($query)){
                    		$cid = $row['cust_id'];
                    ?>
                      <tr>
					              <td><?php echo $row['cust_id'];?></td>
                        <td><?php echo $row['cust_last'];?></td>
                        <td><?php echo $row['cust_first'];?></td>
                        <td><?php echo $row['cust_address'];?></td>
            						<td><?php echo $row['cust_contact'];?></td>
                        <td>
            				<a href="#updateCustomer<?php echo $row['cust_id'];?>" data-target="#updateCustomer<?php echo $row['cust_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

                     <a href="#delete<?php echo $row['cust_id'];?>" data-target="#delete<?php echo $row['cust_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>

                     <a href="account_summary.php?cid=<?php echo $row['cust_id'];?>" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-th text-green"></i></a>
            						</td>
                  </tr>


				 

        <!-- Update Customer Modal -->
  <div id="updateCustomer<?php echo $row['cust_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">??</span></button>
                <h4 class="modal-title">Update Customer Details</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post" action="customer_update.php" enctype='multipart/form-data'>
              
                <div class="form-group">
                  <label class="control-label col-lg-3" for="name">Last Name</label>
                  <div class="col-lg-9">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>  
                    <input type="text" class="form-control" id="name" name="last" value="<?php echo $row['cust_last'];?>" required>  
                  </div>
                </div> 
     
              <div class="form-group">
                <label class="control-label col-lg-3" for="file">First Name</label>
                <div class="col-lg-9">
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>  
                <input type="text" class="form-control" id="name" name="first" value="<?php echo $row['cust_first'];?>" required>  
                </div>
             </div> 
        
              <div class="form-group">
                <label class="control-label col-lg-3" for="file">Address</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="name" name="address" value="<?php echo $row['cust_address'];?>" required>  
                </div>
              </div>

          <div class="form-group">
              <label class="control-label col-lg-3" >Contact</label>
              <div class="col-lg-9">
              <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>  
                <input type="text" class="form-control" id="name" name="contact" value="<?php echo $row['cust_contact'];?>" required>  
              </div>
              </div>

              </div><br><br><br><br><br><br><br><br><br><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Customer</button>
              </div>
             </form>
            </div>  
          </div>
      </div>
 <!--end of modal-->    



 <!-- Delete Customer Modal -->
 <div id="delete<?php echo $row['cust_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">??</span></button>
                <h4 class="modal-title">Delete Customer</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="customer_del.php">
             
                  <input type="hidden" class="form-control" name="cust_id" value="<?php echo $row['cust_id'];?>" required> 
                      
                      <p>Are you sure you want to remove Customer?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" name="delete" class="btn btn-danger" >
                      <a href="delete<?php echo $row['cust_id'];?>" style="color: #ffffff;">
                          Delete </a></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
        </div>
      </div>
 <!--end of modal-->    
   
                  <?php $i++; } ?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>Contact #</th>
                        <th>Action</th>
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
