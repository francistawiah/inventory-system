<?php 
session_start();
$id=$_SESSION['id'];	
include('../dist/includes/dbcon.php');

	$discount   = $_POST['discount'];
	$payment    = $_POST['payment'];
	$amount_due = $_POST['amount_due'];
	//$total_cost = $_POST['total_cost'];	
	date_default_timezone_set("Africa/Accra"); 
	$date      = date("Y-m-d H:i:s");
	$cid       = $_REQUEST['cid'];
	$branch    = $_SESSION['branch'];
	$total    = $amount_due - $discount;
	$cid      = $_REQUEST['cid'];
	$tendered = $_POST['tendered'];
	$change   = $_POST['change'];

	 // Get Product
     $get_prod = "SELECT * FROM product";
     $run_prod = mysqli_query($con, $get_prod);
     $row_prod   = mysqli_fetch_array($run_prod);
     $prod_id   = $row_prod['prod_id'];
     $prod_price = $row_prod['prod_price'];
      

     // Get Stockin
     $get_stockin = "SELECT * FROM stockin";
     $run_stockin = mysqli_query($con, $get_stockin);
     $row_stockin = mysqli_fetch_array($run_stockin);
     $cpp         = $row_stockin['cost_per_product'];
    

     // Profit Margin
     $total_price = $prod_price - $cpp;

	mysqli_query($con,"INSERT INTO sales(user_id, discount,amount_due,total,date_added,modeofpayment,cash_tendered,cash_change,branch_id) 
	VALUES('$id','$discount','$amount_due','$total', NOW(),'cash','$tendered','$change','$branch')")or die(mysqli_error($con));
		
	$sales_id = mysqli_insert_id($con);
	$_SESSION['sid'] = $sales_id;
	$query = mysqli_query($con,"select * from temp_trans where branch_id ='$branch'")or die(mysqli_error($con));

		while ($row = mysqli_fetch_array($query))
		{
			$pid   = $row['prod_id'];	
 			$qty   = $row['qty'];
			$price = $row['price'];

			$ppm = $total_price * $qty;
			
			
			mysqli_query($con,"INSERT INTO sales_details(prod_id,qty,price,profit_margin,sales_id) VALUES('$pid','$qty','$price','$ppm','$sales_id')")or die(mysqli_error($con));
			mysqli_query($con,"UPDATE product SET prod_qty = prod_qty - '$qty' where prod_id = '$pid' and branch_id = '$branch'") or die(mysqli_error($con)); 
		}
		
		$query1 = mysqli_query($con,"SELECT or_no FROM payment NATURAL JOIN sales WHERE modeofpayment =  'cash' ORDER BY payment_id DESC LIMIT 0 , 1")or die(mysqli_error($con));

			$row1 = mysqli_fetch_array($query1);
				$or = $row1['or_no'];	

				if ($or == 0)
				{
					$or = 0001;
				}
				else
				{
					$or = $or + 1;
				}

				mysqli_query($con,"INSERT INTO payment(cust_id,user_id,payment,payment_date,branch_id,payment_for,due,status,sales_id,or_no) 
						VALUES('$cid','$id','$total','$date','$branch','$date','$total','paid','$sales_id','$or')")or die(mysqli_error($con));
				echo "<script>document.location ='receipt.php?cid=$cid'</script>";  	
		
		$result=mysqli_query($con,"DELETE FROM temp_trans where branch_id ='$branch'")	or die(mysqli_error($con));
		//echo "<script>document.location='receipt.php?cid=$cid'</script>";  	
		
	
?>