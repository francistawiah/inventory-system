<?php

include("includes/db_conn.php");

if(isset($_POST['delete']))
	{
		$id = mysqli_real_escape_string($con, $_POST['user_id']);

		$sql = "DELETE FROM user WHERE user_id = '$id'";
		$query = mysqli_query($con, $sql);

		if($query)
		{
			echo "<script>alert('Deleted successfully!')</script>";
			echo "<script>document.location='users.php'</script>";
		}
	}


?>