<?php


	include('../dist/includes/dbcon.php');

	if(isset($_POST['delete']))
	{
		$id = $_POST['supplier_id'];

		$sql = "DELETE FROM supplier WHERE supplier_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Supplier deleted Successfully')</script>";
			echo "<script>window.open('supplier.php', '_self')</script>";
		}
	}


?>