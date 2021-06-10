<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("dist/includes/login_style.php"); ?>
	</head>
<body>
<div id="cssload-pgloading">
		<div class="cssload-loadingwrap">
			<ul class="cssload-bokeh">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>

</body>

</html>
<?php 
include('dist/includes/dbcon.php');

if(isset($_POST['login']))
{

		$user_unsafe = $_POST['username'];
		$pass_unsafe = $_POST['password'];
		$branch      = $_POST['branch'];

		$user  = mysqli_real_escape_string($con,$user_unsafe);
		$pass1 = mysqli_real_escape_string($con,$pass_unsafe);

		$pass = md5($pass1);
		$salt = "a1Bz20ydqelm8m1wql";
		$pass = $salt.$pass;

		date_default_timezone_set('Africa/Accra');

		$date = date("Y-m-d H:i:s");

		$query = mysqli_query($con,"select * from user natural join branch where username='$user' and password='$pass' and branch_id='$branch' and status='active'")or die(mysqli_error($con));
			$row  = mysqli_fetch_array($query);
		    $id   = $row['user_id'];
		    $name = $row['name'];
		    $counter = mysqli_num_rows($query);

		           $id = $row['user_id'];
		           $_SESSION['branch'] = $row['branch_id'];
		           $_SESSION['skin'] = $row['skin'];

		  	if ($counter == 0) 
			  {	
				  echo "<script type='text/javascript'>alert('Invalid Username or Password!');
				  document.location='index.php'</script>";
			  } 
			  elseif ($counter > 0)
			  {
			 	 $_SESSION['id'] = $id;	
			  	 $_SESSION['name'] = $name;		
			  

				$remarks = "has logged in the system at ";  
				mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));
		         
		 		}                

				 echo "<script type='text/javascript'>document.location='pages/cash_transaction.php'</script>";
			  }
		 
?>

	
