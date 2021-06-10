<?php

include("includes/db_conn.php");

if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['branch_id']);

		$sql = "DELETE FROM branch WHERE branch_id = '$id'";
		$query = mysqli_query($db, $sql);

		if($query)
		{
			echo "<script>alert('Deleted successfully!')</script>";
			echo "<script>document.location='stores.php'</script>";
		}
	}


?>