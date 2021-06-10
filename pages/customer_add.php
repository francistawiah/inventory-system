<?php 
    
    session_start();
    include('../dist/includes/dbcon.php');
	$branch  = $_SESSION['branch'];
	$last    = $_POST['last'];
	$first   = $_POST['first'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	
	    $query2 = mysqli_query($con,"select * from customer where cust_last ='$last' and cust_first ='$first' and branch_id ='$branch'")or die(mysqli_error($con));
	    $row    = mysqli_fetch_array($query2);
	    $cust_id = $row['cust_id'];
		
		$count = mysqli_num_rows($query2);
		
		$_SESSION['custId'] = $cust_id;

		if ($count > 0)
		{
			

			echo "<script type ='text/javascript'>alert('Customer already exist!');</script>";
			echo "<script>document.location ='cust_new.php'</script>";  
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO customer(cust_last,cust_first,cust_address,cust_contact,branch_id) 
				VALUES('$last','$first','$address','$contact','$branch')")or die(mysqli_error($con));

			$id = mysqli_insert_id($con);

			echo "<script>document.location='cash_transaction.php?cid=$id'</script>";  
		}
?>