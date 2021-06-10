<?php

	include("includes/db_conn.php");

	$user_id     = mysqli_real_escape_string($con, $_POST['user_id']);
    $name        = mysqli_real_escape_string($con, $_POST['name']);
    $username    = mysqli_real_escape_string($con, $_POST['username']);
    $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
    $password    = mysqli_real_escape_string($con, $_POST['password']);
    $status      = mysqli_real_escape_string($con, $_POST['status']);

     
     if($password == "")
     {
         
        mysqli_query($con,"UPDATE user SET username = '$username', name = '$name', status = '$status', branch_id = '$branch_name' where user_id = '$user_id'")or die(mysqli_error($con)); 
     }
     else
     {
         $pass = md5($password);
         $salt = "a1Bz20ydqelm8m1wql";
         $pass = $salt.$pass;

         mysqli_query($con,"UPDATE user SET username = '$username', password = '$pass', name = '$name', status = '$status', branch_id = '$branch_name' where user_id='$user_id'")or die(mysqli_error($con)); 
     }
     

    	echo "<script>alert('Updated Successfully!') </script>";
    	echo "<script>document.location='users.php'</script>";
    


?>