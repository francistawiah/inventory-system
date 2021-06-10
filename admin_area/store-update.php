<?php

	include("includes/db_conn.php");

	$branch_id     = mysqli_real_escape_string($con, $_POST['branch_id']);
    $branch_name   = mysqli_real_escape_string($con, $_POST['branch_name']);
    $address       = mysqli_real_escape_string($con, $_POST['address']);
    $phone         = mysqli_real_escape_string($con, $_POST['phone']);
        
    $update_branch = "UPDATE branch SET branch_name = '$branch_name', branch_address = '$address', branch_contact = '$phone' WHERE branch_id = '$branch_id'";
    $run_branch = mysqli_query($con, $update_branch);

    if($run_branch)
    {
    	echo "<script>alert('Updated Successfully!') </script>";
    	echo "<script>document.location='stores.php'</script>";
    }


?>