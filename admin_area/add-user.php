<?php

  include("includes/db_conn.php");

  $name           = mysqli_real_escape_string($con, $_POST['name']);
  $username       = mysqli_real_escape_string($con, $_POST['username']);
  $branch_name    = mysqli_real_escape_string($con, $_POST['branch_name']);
  $status         = mysqli_real_escape_string($con, $_POST['status']);
  $password       = mysqli_real_escape_string($con, $_POST['password']);

  // Password Hashing
  $pass = md5($password);
  $salt = "a1Bz20ydqelm8m1wql";
  $pass = $salt.$pass;
  
  $insert_user = "INSERT INTO user(username, password, name, status, branch_id)VALUES('$username','$pass','$name', '$status', '$branch_name')";
  $run_user = mysqli_query($con, $insert_user);

  if($run_user)
  {
     echo "<script>alert('User inserted successfully'); </script>";
     echo "<script>document.location='users.php'</script>";
  }


?>