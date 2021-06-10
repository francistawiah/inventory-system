<?php


	include("includes/db_conn.php");
	
	if(isset($_POST['delete']))
	{
		$id = $_POST['stockin_id'];

		$sql = "DELETE FROM stockin WHERE stockin_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Stock deleted Successfully')</script>";
			echo "<script>document.location='stockin.php'</script>";
		}
	}


?>