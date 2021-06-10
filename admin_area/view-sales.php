<?php 

  include("includes/sales-header.php"); 


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Sales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Date picker</h3>
              </div>
              <div class="card-body">
                <!-- Date range -->
                <form method="post"> 
                 <div class="form-group col-md-6">
                  <label>Date range:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="date" class="form-control float-right active" id="reservation" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <button type="submit" class="btn btn-success" name="display">Display</button>
                </form>
                <!-- /.form group -->

                 <?php
		    		if (isset($_POST['display']))
		    	    {
		    		    $date   = $_POST['date'];
		    		    $date   = explode('-',$date);
		    		    $branch = $_GET['branch'];		
		    			$start  = date("Y/m/d",strtotime($date[0]));
		    			$end    = date("Y/m/d",strtotime($date[1]));

                 ?>

              </div>
            </div>
             
             <div class="col-md-12">
             <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Sales Report</h3>
              </div>
              <div class="card-body">
                 
                 <?php
				    
				    $branch = $_GET['branch'];
				    $query  = mysqli_query($con,"select * from branch where branch_id = '$branch'")or die(mysqli_error());
				  
				       $row = mysqli_fetch_array($query);
				        
					?>      
                  <h5 style="font-size: 20px; text-align: center; color: #00a65a;"><b><?php echo $row['branch_name'];?></b> </h5>  
                  <h6 style="font-size: 20px; text-align: center; color: #00a65a;">Address: <?php echo $row['branch_address'];?></h6>
                  <h6 style="font-size: 20px; text-align: center; color: #00a65a;">Contact: <?php echo $row['branch_contact'];?></h6>
                  
		

				  <h5 style="font-size: 20px; text-align: center; color: #00a65a; margin-bottom: 20px; "><b>Cash Sales Report as of <?php echo date("M d, Y",strtotime($start))." to ".date("M d, Y",strtotime($end));?></b></h5>
				  <hr>
    

				 <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Transaction #</th>
                        <th>Product</th>
                        <th>Qty</th>
            		    <th>Price</th>
                        <th>Total Amount</th>
                        <th>Amount Paid</th>
                        <th>Profit Margin</th>
                        <th>Profit</th>
                        <th>Date Paid</th>
                        <th colspan="9">OverAll Total</th>
                      </tr>
                    </thead>
                   <tbody>
                  <?php
                    
                    $branch_id = $_GET['branch'];

                  	$query = mysqli_query($con,"select * from sales natural join sales_details natural join product where date(date_added)>='$start' and date(date_added)<='$end' and branch_id='$branch_id' and modeofpayment='cash' order by date_added")or die(mysqli_error($con));

                  		$all_qty = 0; $grand = 0; $get_sell = 0;  $sum = 0; $sum2 = 0;

                  		while($row = mysqli_fetch_array($query))
                        {
                           $total = $row['qty'] * $row['price'];
                      	   $grand = $grand + $total;
                           $get_sell += $row['profit_margin'];

                           $prod_price = $row['prod_price']; 
                        
                            // Get Stockin
                           $get_stockin = "SELECT * FROM stockin";
                           $run_stockin = mysqli_query($con, $get_stockin);
                           $row_stockin = mysqli_fetch_array($run_stockin);
                           $cpp         = $row_stockin['cost_per_product'];


                           $pro_marg = $prod_price - $cpp;


                          
                           $query2 = "SELECT * FROM sales"; 
                           $sql   = mysqli_query($con, $query2);

                           

                            while($num = mysqli_fetch_assoc($sql))
                            {
                                $sum  += $num['cash_tendered'];
                                $sum2 += $num['discount'];
                            }
                  ?>
                <tr>
                <td><?php echo $row['sales_id'];;?></td>
                
                <td><?php echo $row['prod_name'];?></td>
                
                <td><?php echo $row['qty'];?></td>
    						
                <td><?php echo $row['price'];?></td>
                
                <td style="text-align:right">
                   <?php echo number_format($row['qty']*$row['price'],2);?>
                </td>
                
                <td><?php echo $row['cash_tendered']; ?></td>
                <td><?php echo $pro_marg; ?></td>
                <td><?php echo $row['profit_margin']; ?></td>
                
                <!--<td style="text-align:right">
                    <?php echo number_format($grand - $discount,2);
    								?>        
                </td>-->

                <td><?php echo date("M d, Y h:i a",strtotime($row['date_added']));?></td>    
    		
            <?php } ?>                       
            </tr>	
            </tbody>
            <tfoot>
          <tr>
          <th colspan="9">Total Cash Sales</th>
          <th style="text-align:right;"><h4><b><?php echo number_format($sum,2);?></b></h4></th>
        </tr>

				<tr>
            <th colspan="9">Total Discount</th>
            <th style="text-align:right;"><h4><b><?php echo number_format($sum2,2);?></b></h4></th>
          </tr>   


          <tr>
            <th colspan="9">Total Profit</th>
            <th style="text-align:right;"><h4><b><?php echo number_format($get_sell,2); ?></b></h4></th>
          </tr>   

          <!-- <tr>
            <th colspan="9">Total Profit</th>
            <th style="text-align:right;"><h4><b><?php echo 0; ?></b></h4></th>
          </tr> -->
          
          <!-- <tr>
            <th colspan="9">Total Cash Sales</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format(($grand-$discount),2);}?></b></h4></th>
			    </tr>	-->
         
                      <tr>
                        <th>Prepared by:</th>
                        <th>Signature:</th>
                      </tr>                   
                      <tr>
                        <th></th>
                        <th></th> 
                      </tr>  			  
                      </tfoot>
                     </table>
                     
                     <div style="margin-top: 20px; margin-bottom: 70px;">
                      <a class = "btn btn-success" href = "" onclick = "window.print()">
                        <i class ="fas fa-print"></i>
                        Print
                      </a>
                      <a class = "btn btn-success" href="sales.php">
                        <i class ="fas fa-arrow-left"></i>
                        Back to Homepage
                      </a>  
                    </div> 
              		</div>
              </div>
             </div>




            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include("includes/footer.php"); ?>
</div>
<!-- ./wrapper -->
<?php include("includes/sales-footer-links.php"); ?>

