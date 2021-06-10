<?php


	include("includes/db_conn.php");
	
	if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['sup_id']);

		$sql = "DELETE FROM supplier WHERE supplier_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Supplier deleted Successfully')</script>";
			echo "<script>window.open('suppliers.php', '_self')</script>";
		}
	}


?>