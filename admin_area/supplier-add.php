<?php

	include("includes/db_conn.php");

	$sup_name 	    = mysqli_real_escape_string($con, $_POST['sup_name']);
	$sup_address 	= mysqli_real_escape_string($con, $_POST['sup_address']);
	$sup_contact 	= mysqli_real_escape_string($con, $_POST['sup_contact']);
	$sup_status 	= mysqli_real_escape_string($con, $_POST['sup_status']);

	$insert_sup = "INSERT INTO supplier(supplier_name, supplier_address, supplier_contact, supplier_status)VALUES('$sup_name', '$sup_address', '$sup_contact', '$sup_status')";
	$run_sup    = mysqli_query($con, $insert_sup);

	if($run_sup)
	{
		echo "<script>alert('Supplier inserted successfully'); </script>";
		echo "<script>document.location='suppliers.php'</script>";
	}


?>