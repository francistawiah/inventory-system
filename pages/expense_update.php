<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id 				= $_POST['expense_id'];
	$name 				= $_POST['expense_name'];
	$price 			    = $_POST['expense_amt'];
	$desc		        = $_POST['expense_desc'];


	mysqli_query($con,"update expense set expense_cat_id = $name, expense_amt = '$price', expense_date = NOW(), expense_desc = '$desc' where expense_id='$id'")or die(mysqli_error($con));
	
echo "<script type='text/javascript'>alert('Successfully updated expenses details!');</script>";
echo "<script>document.location='expenses.php'</script>";  

	
?>
