<?php

  include("includes/db_conn.php");


  $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
  $address     = mysqli_real_escape_string($con, $_POST['address']);
  $phone       = mysqli_real_escape_string($con, $_POST['phone']);


  $insert_store = "INSERT INTO branch(branch_name, branch_address, branch_contact)VALUES('$branch_name', '$address', '$phone')";
  $run_store = mysqli_query($con, $insert_store);


  if($run_store)
  {
     echo "<script>alert('Branch inserted successfully'); </script>";
     echo "<script>document.location='stores.php'</script>";
  }




?>