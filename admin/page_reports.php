
<?php include 'header.php';

$branch_id = $_GET['id'];

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include 'main_sidebar.php';?>

        <!-- top navigation -->
       <?php include 'top_nav.php';?>
        <!-- /top navigation -->

        <!-- page content -->
        <div role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">	
					<div class = "x-panel">
						<div class="right_col" role="main">

	<div class="col-md-12">
			  <div class="box box-primary angel">
				<div class="box-header">
				  <h3 class="box-title">Select Date</h3>
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
					<button type="submit" class="btn btn-primary" name="display">Display</button>
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
    include('dbcon.php');
    $branch = $_GET['id'];
    $query  = mysqli_query($con,"select * from branch where branch_id='$branch'");
  
       $row = mysqli_fetch_array($query);
        
?>      
                  <h5><b><?php echo $row['branch_name'];?></b> </h5>  
                  <h6>Address: <?php echo $row['branch_address'];?></h6>
                  <h6>Contact: <?php echo $row['branch_contact'];?></h6>
                  
				  <h5><b>Cash Sales Report as of <?php echo date("M d, Y",strtotime($start))." to ".date("M d, Y",strtotime($end));?></b></h5>
                  
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
							<a class = "btn btn-primary btn-print" href="home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>  


							      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Transaction #</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Qty</th>
            			<th>Price</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                   <tbody>
                  <?php
                  	$query = mysqli_query($con,"select * from sales natural join sales_details natural join product natural join customer where date(date_added)>='$start' and date(date_added)<='$end' and branch_id='$branch' and modeofpayment='cash' order by date_added")or die(mysqli_error($con));

                  		$qty = 0; $grand = 0; $discount = 0;

                  		while($row = mysqli_fetch_array($query))
                        {
                           $total = $row['qty'] * $row['price'];
                      	$grand = $grand + $total;
                           $discount = $discount + $row['discount'];
                  ?>
                <tr>
                <td><?php echo $row['sales_id'];;?></td>
                <td><?php echo $row['cust_last'].", ".$row['cust_first'];?></td>
                <td><?php echo $row['prod_name'];?></td>
                <td><?php echo $row['qty'];?></td>
    						<td><?php echo $row['price'];?></td>
                <td style="text-align:right">
                   <?php echo number_format($row['qty']*$row['price'],2);?>
                </td>
                <td><?php echo $row['discount'];?></td>
                <td style="text-align:right">
                    <?php echo number_format($row['qty'] * $row['price'] - $row['discount'],2);
    								?>        
                </td>
                <td><?php echo date("M d, Y h:i a",strtotime($row['date_added']));?></td>    
    		
            <?php }?>                       
            </tr>	
            </tbody>
            <tfoot>
          <tr>
          <th colspan="9">Total</th>
          <th style="text-align:right;"><h4><b><?php echo  number_format($grand,2);?></b></h4></th>
        </tr>

				<tr>
            <th colspan="9">Total Discount</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format($discount,2);?></b></h4></th>
          </tr>   
          
          <tr>
            <th colspan="9">Total Cash Sales</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format(($grand-$discount),2);}?></b></h4></th>
			    </tr>	
          <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr> 
                      <tr>
                        <th>Prepared by:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr> 
                      <?php
                          $id = $_SESSION['id'];
                          $query = mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
                          $row = mysqli_fetch_array($query);
                      ?>                      
                      <tr>
                        <th><?php echo $row['name'];?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>  			  
                      </tfoot>
                     </table> 
						
							<!--
								<?php					 
			$branch=$_GET['id'];
			$query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());  
			$row=mysqli_fetch_array($query);
        
	?>      
                  <h5><b><?php echo $row['branch_name'];?></b> </h5>  
                  <h6>Address: <?php echo $row['branch_address'];?></h6>
                  <h6>Contact #: <?php echo $row['branch_contact'];?></h6>
				  <h5><b>Product Inventory as of today, <?php echo date("M d, Y h:i a");?></b></h5>
                  
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
				  <a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>   -->

				  
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


	

	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<script src="js/highcharts.js"></script>
    <!-- Bootstrap -->
    <script src="js/exporting.js"></script>
	 
    <!-- FastClick -->
   
	<script type="text/javascript">
    $(document).ready(function() {
      var options = {
              chart: {
                  renderTo: 'graph',
                  type: 'column',
                  marginRight: 20,
                  marginBottom: 25
              },
              title: {
                  text: '',
                  x: -20 //center
              },
              subtitle: {
                  text: '',
                  x: -10
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  
                  title: {
                      text: 'Total Monthly Sales'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                  formatter: function() {
                          return '<b>'+ this.series.name +'</b><br/>'+  Highcharts.numberFormat(this.y, 0)
                          this.x +': '+ this.y
                          
                  ;
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: 0,
                  y: 100,
                  borderWidth: 0
              },
              series: []
          }
          
          $.getJSON("data.php", function(json) {
			options.xAxis.categories = json[0]['name'];
            options.series[0] = json[1];
            //options.series[1] = json[2];
            
            
            
            chart = new Highcharts.Chart(options);
          });
      });
    </script>
	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
  </body>
</html>
