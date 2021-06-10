<?php

	include("includes/db_conn.php");

	$brand_name   = mysqli_real_escape_string($con, $_POST['brand_name']);
	$brand_status = mysqli_real_escape_string($con, $_POST['brand_status']);

	$insert_brand = "INSERT INTO brands(brand_name, brand_status)VALUES('$brand_name', '$brand_status')";
	$run_brand    = mysqli_query($con, $insert_brand);

	if($run_brand)
	{
		echo "<script>alert('Brand inserted successfully'); </script>";
		echo "<script>document.location='brands.php'</script>";
	}


?>