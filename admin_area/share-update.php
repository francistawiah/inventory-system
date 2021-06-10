<?php

 	include("includes/db_conn.php");

 	$prod_id 		    = mysqli_real_escape_string($con, $_POST['prod_id']);
	$name 				= mysqli_real_escape_string($con, $_POST['prod_name']);
	$supplier 			= mysqli_real_escape_string($con, $_POST['supplier']);
	$price 				= mysqli_real_escape_string($con, $_POST['price']);
	$brand				= mysqli_real_escape_string($con, $_POST['brand']);
	$category 			= mysqli_real_escape_string($con, $_POST['categories']);
	$prod_status		= mysqli_real_escape_string($con, $_POST['status']);
	$branch_name        = mysqli_real_escape_string($con, $_POST['branch_name']);
	$branch_to          = mysqli_real_escape_string($con, $_POST['branch_to']);
	$qty_trans          = mysqli_real_escape_string($con, $_POST['qty_trans']);
	$trans_reason       = mysqli_real_escape_string($con, $_POST['trans_reason']);

	$total_amount = $price * $qty_trans;


	// Get Product name
	$select_prod = "SELECT * FROM product WHERE prod_id = '$name'";
	$run_prod    = mysqli_query($con, $select_prod);
	$row_p       = mysqli_fetch_array($run_prod);
	$prod_name   = $row_p['prod_name'];


   // Insert Into Product As New Product With New Branch
   $insert_prod = "INSERT INTO product(prod_name, prod_price, brand_id, cat_id, prod_qty, supplier_id, branch_id, prod_status)VALUES('$prod_name', '$price', '$brand', '$category', '0', '$supplier', '$branch_to', '$prod_status')";
   $run_prod = mysqli_query($con, $insert_prod);

   
   // Insert the Product Into The Stocks With Quantity
   $insert_stock = "INSERT INTO stockin(supplier_id, brand_id, prod_id, qty, cost_per_product, date, branch_id)VALUES('$supplier', '$brand', '$prod_name', '$qty_trans', '0', NOW(), '$branch_to')";
   $run_stock    = mysqli_query($con, $insert_stock);


   // Update The Same Product By Changing It's Quantity
   // Since Some Part Of It Has Been Transferred
   $update_stockin = "UPDATE stockin SET qty = qty - '$qty_trans' WHERE branch_id = '$branch_name'";
   $run_update  = mysqli_query($con, $update_stockin);

   // Insert Into Transfer Table With Reasons For The Transfer
   $insert_trans = "INSERT INTO inventory_transfer(prod_id, cat_id, brand_id, supplier_id, price, qty, total_amount, branch_id, branch_to, transfer_reason, date)VALUES('$prod_name', '$category', '$brand', '$supplier', '$price', '$qty_trans', '$total_amount', '$branch_name', '$branch_to', '$trans_reason', NOW())";
   $run_trans = mysqli_query($con, $insert_trans);
    

   	echo "<script>alert('Product transferred successfully')</script>";
   	echo "<script>document.location='product.php'</script>";

?>