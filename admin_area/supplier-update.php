<?php

 	include("includes/db_conn.php");

	$sup_id 		= mysqli_real_escape_string($con, $_POST['sup_id']);
	$sup_name 	    = mysqli_real_escape_string($con, $_POST['sup_name']);
	$sup_address 	= mysqli_real_escape_string($con, $_POST['sup_address']);
	$sup_contact 	= mysqli_real_escape_string($con, $_POST['sup_contact']);
	$sup_status 	= mysqli_real_escape_string($con, $_POST['sup_status']);


	$update_sup = "UPDATE supplier SET supplier_name = '$sup_name', supplier_address = '$sup_address', supplier_contact = '$sup_contact', supplier_status = '$sup_status' WHERE supplier_id = '$sup_id'";
	$run_sup    = mysqli_query($con, $update_sup);

	if($run_sup)
	{
		echo "<script>alert('Supplier updated successfully');</script>";
		echo "<script>document.location='suppliers.php'</script>";
	}


?>