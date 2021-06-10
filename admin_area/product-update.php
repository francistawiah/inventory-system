<?php 


	include("includes/db_conn.php");

	$prod_id 		    = mysqli_real_escape_string($con, $_POST['prod_id']);
	$name 				= mysqli_real_escape_string($con, $_POST['prod_name']);
	$supplier 			= mysqli_real_escape_string($con, $_POST['supplier']);
	$price 				= mysqli_real_escape_string($con, $_POST['price']);
	//$reorder 			= $_POST['reorder'];
	$brand				= mysqli_real_escape_string($con, $_POST['brand']);
	//$barcode			= $_POST['barcode'];
	$category 			= mysqli_real_escape_string($con, $_POST['categories']);
	$prod_status		= mysqli_real_escape_string($con, $_POST['status']);
	$branch_name        = mysqli_real_escape_string($con, $_POST['branch_name']);
	

	mysqli_query($con,"update product set prod_name = '$name', prod_price = '$price', supplier_id = '$supplier', brand_id = '$brand', cat_id = '$category', prod_status = '$prod_status', branch_id = '$branch_name' where prod_id = '$prod_id'")or die(mysqli_error($con));
	
   echo "<script>alert('Successfully updated product details!');</script>";
   echo "<script>document.location='product.php'</script>";  

	
?>
