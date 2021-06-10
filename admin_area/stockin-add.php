<?php


	include("includes/db_conn.php");


	$prod_name = mysqli_real_escape_string($con, $_POST['prod_name']);
	$supplier  = mysqli_real_escape_string($con, $_POST['supplier']);
	$brand     = mysqli_real_escape_string($con, $_POST['brand']);
	$branch    = mysqli_real_escape_string($con, $_POST['branch_name']);
	$cost_price = mysqli_real_escape_string($con, $_POST['cost_price']);
	$qty        = mysqli_real_escape_string($con, $_POST['qty']);

	 $query = mysqli_query($con,"select prod_name from product where prod_id = '$name'")or die(mysqli_error());
  
        $row     = mysqli_fetch_array($query);
		$product = $row['prod_name'];
		$remarks = "added $qty of $product";  
	
	mysqli_query($con,"INSERT INTO history_log(action, date)VALUES('$remarks',NOW())")or die(mysqli_error($con));
		
		
	mysqli_query($con,"UPDATE product SET prod_qty = prod_qty + '$qty' where prod_id = '$prod_name'") or die(mysqli_error($con)); 


	$insert_stock = "INSERT INTO stockin(supplier_id, brand_id, prod_id, qty, cost_per_product, date, branch_id)VALUES('$supplier', '$brand', '$prod_name', '$qty', '$cost_price', NOW(), '$branch')";
	$run_stock = mysqli_query($con, $insert_stock);

	if($run_stock)
	{
		echo "<script>alert('Stock inserted successfully') </script>";
		echo "<script>document.location='stockin.php'</script>";
	}


?>