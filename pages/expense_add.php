<?php 
session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name 	 = mysqli_real_escape_string($con, $_POST['expense_name']);
	$price 	 = mysqli_real_escape_string($con, $_POST['expense_amt']);
	$desc  	 = mysqli_real_escape_string($con, $_POST['expense_desc']);

	
	mysqli_query($con,"INSERT INTO expense(expense_cat_id, expense_amt, expense_date, expense_desc, branch_id)VALUES('$name','$price', NOW(),'$desc', '$branch')")or die(mysqli_error($con));

	echo "<script>alert('Expenses added successfully!');</script>";
	echo "<script>document.location='expenses.php'</script>";  
		
?>