<?php


	include('../dist/includes/dbcon.php');

	
	if(isset($_POST['delete']))
	{
		$id = $_POST['install_id'];

		$sql = "DELETE FROM installment WHERE install_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Customer deleted Successfully')</script>";
			echo "<script>window.open('install.php', '_self')</script>";
		}
	}






?>