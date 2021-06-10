<?php

 	include("includes/db_conn.php");

	$brand_id 		= mysqli_real_escape_string($con, $_POST['brand_id']);
	$brand_name 	= mysqli_real_escape_string($con, $_POST['brand_name']);
	$brand_status 	= mysqli_real_escape_string($con, $_POST['brand_status']);


	$update_brand = "UPDATE brands SET brand_name = '$brand_name', brand_status = '$brand_status' WHERE brand_id = '$brand_id'";
	$run_update = mysqli_query($con, $update_brand);

	if($run_update)
	{
		echo "<script>alert('Brand updated successfully');</script>";
		echo "<script>document.location='brands.php'</script>";
	}


?>