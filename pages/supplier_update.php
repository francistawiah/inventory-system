<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id 				= $_POST['id'];
	$name 				= $_POST['name'];
	$address 			= $_POST['address'];
	$contact 			= $_POST['contact'];
	$supplier_status 	= $_POST['supplier_status'];	
	
	mysqli_query($con,"update supplier set supplier_name='$name', supplier_address='$address',supplier_contact='$contact', supplier_status= '$supplier_status'  where supplier_id='$id'")or die(mysqli_error());
	
	echo "<script type='text/javascript'>alert('Successfully updated supplier details!');</script>";
	echo "<script>document.location='supplier.php'</script>";  

	
?>
