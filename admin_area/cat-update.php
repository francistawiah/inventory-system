<?php

 	include("includes/db_conn.php");

	$cat_id 		= mysqli_real_escape_string($con, $_POST['cat_id']);
	$cat_name 	    = mysqli_real_escape_string($con, $_POST['cat_name']);
	$cat_status 	= mysqli_real_escape_string($con, $_POST['cat_status']);


	$update_cat = "UPDATE category SET cat_name = '$cat_name', cat_status = '$cat_status' WHERE cat_id = '$cat_id'";
	$run_update = mysqli_query($con, $update_cat);

	if($run_update)
	{
		echo "<script>alert('Category updated successfully');</script>";
		echo "<script>document.location='categories.php'</script>";
	}


?>