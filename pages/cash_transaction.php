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
    <title>Transaction | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <script src="../dist/js/jquery.min.js"></script>
    
 </head>
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
         color: #605ca8;
         border: 1px solid #00a65a;
      }

      .btn-checkout
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
      }

        .btn-cancel
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

     .box-title
     {
     	text-transform: uppercase;
     	color: #00a65a;
     	font-size: 20px;
     	font-weight: 700;
     }

     input[type="text"]
     {
     	border: 1px solid #00a65a;
     }

     label
     {
     	color: #00a65a;
     	font-size: 15px;
     }

     table thead tr th
     {
     	background: #00a65a;
     	color: #fff;
     }
    

    .content-cus
    {
      position: relative;
      top: 30px;
      margin-bottom: 30px;
    }
    </style>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onload="myFunction()">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a> 
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
              <li class="active"> Product </li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
          <div class="row">
	      <div class="col-md-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Sales Transaction </h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
					<!--<input id="barcodeval"  type="text" placeholder="Barcode" class="form-control" autofocus=""> --> 
					 <div id="data-loader" style="display: none; text-align: center;">
				        <img src="../dist/img/ajax-loader.gif"> 
					 </div> 
					 <div id="fetch_result" style="display: none; text-align: center;">
						 
					<form method="post" action="transaction_add.php">
						<?php
						  $branch = $_SESSION['branch'];
						  $cid = '7';
						?>
						<input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required> 
						<input type="hidden" class="form-control" id="pro_id" name="prod_name" value="" required>
						
						<div class="row">
							<div class="col-md-8 text-center">
							<div class="form-group">
							<br />
							
							<div class="input-group">
							  <p style="text-align:center;"><span id="pro_name" style="font-size:29px;"></span></p>
							  
							</div>
						    </div>
						    </div>
							
							<div class="col-md-4">
							<div class="form-group">
							<label for="date"></label>
							  <p>Available : <span id="available"></span></p>
						    </div>
						    </div>
							
							
						</div>
						<div class="row">
							<div class="col-md-4">
							<div class="form-group">
							
							<div class="input-group">
							  <p>Price :Ghc <span id="price"></span></p>
							  
							</div>
						    </div>
						    </div>
							
							<div class="col-md-4">
							<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg">-</button>
			            				</span>
							          	<input type="text" id="qty" name="qty" placeholder="Quantity" tabindex="2" value="1"  required class="form-control input-lg" style="width:100px;">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg">+
							                </button>
							            </span>
							        </div>
			            		</div>
						    </div>
							
							<div class="col-md-4">
							<div class="form-group">
							
							<div class="input-group">
							  <p>Total : <span id="total"></span></p>
							  
							</div>
						    </div>
						    </div>
							
						</div>
						<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<button class="btn btn-lg btn-success" type="submit" tabindex="3" name="addtocart" style="width:70% !important;">Add To Cart</button>
						    </div>
						</div>
						</div>							
					</form>
					 </div>	 
					<br /><hr /><br />
					
	<!-- Barcode Script -->		
	<script>
		$(document).ready(function(){ 	
		$(document).on('input', '#barcodeval', function(e){
		  
		  var x = document.getElementById("barcodeval").value;
		  //alert('Seen:'+x);
		 
		   //$('#fetch_result').hide();
		  // $( "#fetch_result" ).empty();
		  $('#data-loader').show(); 
	 
		  $.ajax({
          url: 'getproduct.php',
          type: 'GET',
          data: 'barcode='+x,
          dataType: 'json',
		  cache: false
		  })
     .done(function(data){
		
			var proid = JSON.parse(data[0].proid);
			var product = JSON.stringify(data[0].productname);
			var quantity = JSON.parse(data[0].quantity);
			var price = JSON.parse(data[0].price);
			
			$('#pro_id').val(proid);
			$('#available').text(quantity);
			$('#price').text(price);
			
			var product = product.replace('"', '');
			var product = product.replace('"', '');
			$('#pro_name').text(product);
			
			$('#fetch_result').show();		 
			$('#data-loader').hide();
		
          
     })
     .fail(function(){
		 alert('Product not found');
         // $('#fetch_result').html('Error, Please try again...');
		  //$( "#fetch_result" ).empty();
          $('#data-loader').hide();
     });
		 
		 
		 });	
		});
	</script>
	<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#qty').val();
		quantity++;
		$('#qty').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#qty').val();
		if(quantity > 1){
			quantity--;
		}
		$('#qty').val(quantity);
	});

});
</script>
<!-- Barcode Script End -->

        <form method="post" action="transaction_add.php">
		    <div class="row" style="min-height:400px">					
			 <div class="col-md-6">
			   <div class="form-group">
				  <label for="date">Product Name</label>
					<select class="form-control select2" name="prod_name" tabindex="1" autofocus required>
						<?php
				            $branch = $_SESSION['branch'];
				            $cid    = $_REQUEST['cid'];
							
							include('../dist/includes/dbcon.php');

							$query2 = mysqli_query($con,"select * from product where branch_id='$branch' order by prod_name")or die(mysqli_error());
							
							while($row = mysqli_fetch_array($query2))
							{
						?>
						 
						 <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name']." Available(".$row['prod_qty'].")";?></option>

						<?php } ?>

						</select>
					    <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
						  </div>
					</div>
					<div class=" col-md-2">
						<div class="form-group">
					    <label for="date">Quantity</label>
						<div class="input-group">
						<input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" tabindex="2" value="1" required>
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="date"></label>
							<div class="input-group">
							<button class="btn-back" type="submit" tabindex="3" name="addtocart"> + To Cart</button>
							</div>
						</div>	
					</form>	
					</div>
					<div class="col-md-12">

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>     
                        <th>Product Name</th>
						            <th>Price</th>
						             <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
							
					 $query = mysqli_query($con,"select * from temp_trans natural join product where branch_id = '$branch'")or die(mysqli_error());
					 
					 $grand = 0;
							    
					 while($row = mysqli_fetch_array($query))
					 {
					       $id    = $row['temp_trans_id'];
					       $total = $row['qty'] * $row['price'];
					       $grand = $grand + $total;
							
					?>
           <tr>
						<td><?php echo $row['qty'];?></td>
            <td><?php echo $row['prod_name'];?></td>
						<td><?php echo number_format($row['price'],2);?></td>
						<td><?php echo number_format($total,2);?></td>
            <td>
							
					         <a href="#updateordinance<?php echo $row['temp_trans_id'];?>" data-target="#updateordinance<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

		              <a href="#delete<?php echo $row['temp_trans_id'];?>" data-target="#delete<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
              
					</td>
       </tr>


			  <div id="updateordinance<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	         <div class="modal-dialog">
	           <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Sales Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="transaction_update.php" enctype='multipart/form-data'>
			  <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>  	
			  <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Qty</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price" name="qty" value="<?php echo $row['qty'];?>" required>  
					</div>
				</div>
				
              </div><br>
              <div class="modal-footer">
		       <button type="submit" class="btn btn-primary">Save changes</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
         </div>
      </div>
 <!--end of Quantity update modal-->

        <div id="delete<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Item</h4>
              </div>
              <div class="modal-body">
                
              <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>
                <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
                <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
 
                    <p>Are you sure you want to remove <?php echo $row['prod_name'];?>?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Delete</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
               </form>
             </div>     
          </div>
      </div> 

 <!-- Barcode Section -->
 <div id="scan" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Scan Barcode</h4>
              </div>
              <div class="modal-body">
                
              <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>
                <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
                <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
                <input id="barcode" oninput="scanCode(this.value)" type="text" placeholder="Barcode" class="form-control" autofocus="">
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Delete</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
         </div>
      </div>
 <!--end of Barcode scan --> 
 
<?php }?>					  
                    </tbody>
                  </table>
                </div>
				</div>	       
				</form>	
                </div>
              </div>
            </div>
            <div class="col-md-3">
            <div class="box">
           <div class="box-body">


          <!-- Point Of Sale -->
    <form method="post" name="autoSumForm" action="sales_add.php">
		<div class="row">
		<div class="col-md-12">  
		
		<div class="form-group">
		<label for="date">Total</label>							
		<input type="text" style="text-align:right" class="form-control" id="total" name="total" placeholder="Total" value="<?php echo $grand;?>" onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>
		</div>
		
		<div class="form-group">
		<label for="date">Discount</label>
		<input type="text" class="form-control text-right" id="discount" name="discount" value="0" tabindex="6" placeholder="Discount" onFocus="startCalc();" onBlur="stopCalc();">
	    <input type="hidden" class="form-control text-right" id="cid" name="cid" value="<?php echo $cid;?>">
		 </div>
		    
		<div class="form-group">
		<label for="date">Amount Due</label>					
		<input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo number_format($grand,2);?>" readonly>				
	    </div>
              
		<div class="form-group" id="tendered">
        <label for="date">Cash Tendered</label><br>
        <input type="text" style="text-align:right" class="form-control" onFocus="startCalc();" onBlur="stopCalc();"  id="cash" name="tendered" placeholder="0.00">
        </div>

        <div class="form-group" id="change">
        <label for="date">Change</label><br>
        <input type="text" style="text-align:right" class="form-control" id="changed" name="change" placeholder="Change" required>
        </div>
	    </div>
		</div>	
                  
        <button class="btn-checkout btn-lg btn-block " id="daterange-btn" name="cash" type="submit" tabindex="7"> CheckOut </button>
		<button type="reset" class="btn-cancel btn-lg btn-block" id="daterange-btn" tabindex="8">
        <a style="color: #fff" href="home.php">Cancel Sale</a>
        </button>
        </form>	
        </div>
        </div>
        </div>
        </div>  
        </section>
        </div>
       </div>
       <?php include('../dist/includes/footer.php');?>
       </div>





	  <script>
      $("#cash").click(function(){
          $("#tendered").show('slow');
          $("#change").show('slow');
      });

    $(function() {

      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this item?"))
      {
	$.ajax({
	type: "GET",
	url: "temp_trans_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
	
	<script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
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
          "ordering": true,x`
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
