<?php


	include("includes/db_conn.php");
	
	if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['cat_id']);

		$sql = "DELETE FROM expense_category WHERE expense_cat_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Category deleted Successfully')</script>";
			echo "<script>window.open('expense-cat.php', '_self')</script>";
		}
	}


?>