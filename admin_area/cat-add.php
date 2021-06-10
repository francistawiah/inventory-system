<?php

	include("includes/db_conn.php");

	$cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);
	$cat_status = mysqli_real_escape_string($con, $_POST['cat_status']);

	$insert_cat = "INSERT INTO category(cat_name, cat_status)VALUES('$cat_name', '$cat_status')";
	$run_cat    = mysqli_query($con, $insert_cat);

	if($run_cat)
	{
		echo "<script>alert('Category inserted successfully'); </script>";
		echo "<script>document.location='categories.php'</script>";
	}


?>