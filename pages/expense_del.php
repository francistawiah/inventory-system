<?php


	include('../dist/includes/dbcon.php');
	
	if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['expense_id']);

		$sql = "DELETE FROM expense WHERE expense_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Expense deleted Successfully')</script>";
			echo "<script>window.open('expenses.php', '_self')</script>";
		}
	}






?>