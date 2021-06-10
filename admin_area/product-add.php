<?php 

	include("includes/db_conn.php");

	$name 	  			= mysqli_real_escape_string($con, $_POST['prod_name']);
	$price 	  			= mysqli_real_escape_string($con, $_POST['price']);
	$brand    			= mysqli_real_escape_string($con, $_POST['brand']);
	$category 			= mysqli_real_escape_string($con, $_POST['categories']);
	$supplier 			= mysqli_real_escape_string($con, $_POST['supplier']);
	//$barcode			= $_POST['barcode'];
	$prod_status		= mysqli_real_escape_string($con, $_POST['status']);
	$branch_name        = mysqli_real_escape_string($con, $_POST['branch_name']);
	//$reorder  			= $_POST['reorder'];

	
		$query = mysqli_query($con,"select * from product where prod_name='$name'")or die(mysqli_error($con));
		$count = mysqli_num_rows($query);

		if ($count > 0)
		{
			echo "<script>alert('Product already exist!');</script>";
			echo "<script>document.location='product.php'</script>";  
		}
		
		

	mysqli_query($con,"INSERT INTO product(prod_name, prod_price, brand_id, cat_id, supplier_id, branch_id, prod_status) VALUES('$name','$price', '$brand','$category', '$supplier', '$branch_name', '$prod_status')")or die(mysqli_error($con));

	echo "<script>alert('Successfully added new product!');</script>";
	echo "<script>document.location='product.php'</script>";  
		
?>