<?php

	
	include("includes/db_conn.php");

    $stockin_id = mysqli_real_escape_string($con, $_POST['stockin_id']);
    $prod_name  = mysqli_real_escape_string($con, $_POST['prod_name']);
    $supplier   = mysqli_real_escape_string($con, $_POST['supplier']);
    $brand      = mysqli_real_escape_string($con, $_POST['brand']);
    $branch     = mysqli_real_escape_string($con, $_POST['branch_name']);
    $cost_price	= mysqli_real_escape_string($con, $_POST['cost_price']);
    $qty        = mysqli_real_escape_string($con, $_POST['qty']);


    $update_stock = "UPDATE stockin SET prod_id = '$prod_name', supplier_id = '$supplier', brand_id = '$brand', cost_per_product = '$cost_price', qty = '$qty', date = NOW(), branch_id = '$branch' WHERE stockin_id = '$stockin_id'";
    $run_stock = mysqli_query($con, $update_stock);

    if($run_stock)
    {
    	echo "<script>alert('Stock Updated Successfully'); </script>";
    	echo "<script>document.location='stockin.php'</script>";
    }



?>