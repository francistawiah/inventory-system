<?php


	include("includes/db_conn.php");
	
	if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['brand_id']);

		$sql = "DELETE FROM brands WHERE brand_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Brand deleted Successfully')</script>";
			echo "<script>window.open('brands.php', '_self')</script>";
		}
	}


?>