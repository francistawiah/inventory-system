<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Supplier | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
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
      
      .btn-back-t
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
          margin-right: 10px;

      }

      .btn-back:hover
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

    .content-cus
    {
      position: relative;
      top: 30px;
      margin-bottom: 40px;
    }
      
    </style>
 </head>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php 

            include('../dist/includes/header.php');
            include('../dist/includes/dbcon.php');

      ?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Supplier</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
            <div class="col-xs-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Supplier List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Supplier Name</th>
						            <th>Address</th>
                        <th>Phone Number</th>
                        <th>Supplier Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      		
                      		$query = mysqli_query($con,"select * from supplier")or die(mysqli_error());
                      		
                          while($row = mysqli_fetch_array($query))
                          {
                      		
                      ?>
                      <tr>
                        <td><?php echo $row['supplier_name'];?></td>
                        <td><?php echo $row['supplier_address'];?></td>
                        <td><?php echo $row['supplier_contact'];?></td>
                        <td>
                          <?php 

                               if ($row['supplier_status']=='Active') 
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
				
              				<a href="#updateSupplier<?php echo $row['supplier_id'];?>" data-target="#updateSupplier<?php echo $row['supplier_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                        <i class="glyphicon glyphicon-edit text-blue"></i>
                      </a>

                      <a href="#delete<?php echo $row['supplier_id'];?>" data-target="#delete<?php echo $row['supplier_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                        <i class="glyphicon glyphicon-trash text-red"></i>
                      </a>
      						</td>
                  </tr>


              <!-- Update Supplier Modal -->
				<div id="updateSupplier<?php echo $row['supplier_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              	<div class="modal-dialog">
              	  <div class="modal-content" style="height:auto">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Update Supplier Details</h4>
                      </div>
              <div class="modal-body">
			  
        <form class="form-horizontal" method="post" action="supplier_update.php" enctype='multipart/form-data'>
                
          				<div class="form-group">
          					<label for="name">Supplier Name</label>
          					<div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['supplier_id'];?>" required>  
          					  <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['supplier_name'];?>" required>  
          					</div>
          				</div> 
                    
                    <div class="form-group">
                    <label for="date">Supplier Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date" name="address" placeholder="Supplier Complete Address" required><?php echo $row['supplier_address'];?></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
               
                    <div class="form-group">
                    <label for="date">Supplier Contact #</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="contact" placeholder="Contact # of Supplier" value="<?php echo $row['supplier_contact'];?>" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->    
        
				      <div class="form-group">
              <label for="price">Status</label>
              <div class="input-group col-md-12">
              <select class="form-control" name="supplier_status" id="price" style="width: 100%;" required>
                 <option value="Active">Active</option>
                 <option value="Inactive">Inactive</option>
              </select>
              </div>
            </div>

				
              </div><hr>
              <div class="modal-footer">
		            <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			       </form>
            </div>
        </div><!--end of modal-dialog-->
      </div>
 <!--end of modal-->   	  

 <!-- Delete Supplier Modal -->
 <div id="delete<?php echo $row['supplier_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Supplier Details</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="supplier_del.php">
             
                  <input type="hidden" class="form-control" name="supplier_id" value="<?php echo $row['supplier_id'];?>" required> 
                      
                      <p>Are you sure you want to remove Supplier?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      
                      <a href="delete<?php echo $row['supplier_id'];?>" style="color: #ffffff;">
                          <button type="submit" name="delete" class="btn btn-danger" >
                          Delete </button>
                    </a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>



                 
<?php }?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Supplier Name</th>
                        <th>Address</th>
                        <th>Contact #</th>
                        <th>Supplier Status</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div>
	           <div class="col-md-3">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add New Supplier</h3>
                </div>
                <div class="box-body">
                
            <form method="post" action="supplier_add.php" enctype="multipart/form-data">
					  <div class="form-group">
						<label for="date">Supplier Name</label>
						<div class="input-group col-md-12">
						  <input type="text" class="form-control pull-right" id="date" name="name" placeholder="Supplier Name" required>
						</div><!-- /.input group -->
					  </div><!-- /.form group -->
		         <div class="form-group">
                    <label for="date">Supplier Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date" name="address" placeholder="Supplier Complete Address" required></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                    <div class="form-group">
                    <label for="date">Supplier Contact #</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="contact" placeholder="Contact # of Supplier" required>
                    </div>
                  </div>

              <div class="form-group">
              <label for="price">Supplier Status</label>
              <div class="input-group col-md-12">
                <select class="form-control" name="supplier_status" id="price" style="width: 100%;" required>
                 <option value="Active">Active</option>
                 <option value="Inactive">Inactive</option>
              </select>
              </div>
            </div>
  
				
					  <div class="form-group">
						<div class="input-group">
						  <button class="btn-back-t" id="daterange-btn" name="">
							Save
						  </button>
						  <button type="reset" class="btn-back" id="daterange-btn">
							Clear
						  </button>
						</div>
					  </div><!-- /.form group -->
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
