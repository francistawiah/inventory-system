<?php

	include("includes/db_conn.php");

	$cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);

	$insert_cat = "INSERT INTO expense_category(expense_cat_name)VALUES('$cat_name')";
	$run_cat    = mysqli_query($con, $insert_cat);

	if($run_cat)
	{
		echo "<script>alert('Category inserted successfully'); </script>";
		echo "<script>document.location='expense-cat.php'</script>";
	}


?>