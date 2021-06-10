<?php

 	include("includes/db_conn.php");

	$cat_id 		= mysqli_real_escape_string($con, $_POST['cat_id']);
	$cat_name 	    = mysqli_real_escape_string($con, $_POST['cat_name']);
	

	$update_cat = "UPDATE expense_category SET expense_cat_name = '$cat_name' WHERE expense_cat_id = '$cat_id'";
	$run_update = mysqli_query($con, $update_cat);

	if($run_update)
	{
		echo "<script>alert('Category updated successfully');</script>";
		echo "<script>document.location='expense-cat.php'</script>";
	}


?>