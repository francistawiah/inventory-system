<?php

	include('../dist/includes/dbcon.php');

function ShowUsers()
	{
		global $con;

		$sql = "SELECT * FROM user WHERE status ='active'";

		$query = mysqli_query($con, $sql)or die();

		$count = mysqli_num_rows($query);


		echo $count;

	}

function ShowBrands()
	{
		global $con;

		$query = "SELECT * FROM brands WHERE brand_status ='active'";

		$run = mysqli_query($con, $query);

		$count_run = mysqli_num_rows($run);


		echo $count_run;

	}

function ShowCat()
	{
		global $con;

		$sql = "SELECT * FROM category WHERE cat_status ='active'";

		$query = mysqli_query($con, $sql);

		$count = mysqli_num_rows($query);

		echo $count;

	}

function ShowSupplier()
	{
		global $con;

		$sql = "SELECT * FROM supplier WHERE supplier_status ='active'";

		$query = mysqli_query($con, $sql);

		$count = mysqli_num_rows($query);

		echo $count;

	}

function ShowCust()
	{
		global $con;

		$sql = "SELECT * FROM customer";

		$query = mysqli_query($con, $sql);

		$count = mysqli_num_rows($query);

		echo $count;

	}

function ShowProd()
	{
		global $con;

		$sql = "SELECT * FROM product WHERE prod_status ='active'";

		$query = mysqli_query($con, $sql);

		$count = mysqli_num_rows($query);

		echo $count;

	}


function ShowCred()
	{
		global $con;

		$sql = "SELECT * FROM creditors WHERE creditor_status ='active'";

		$query = mysqli_query($con, $sql);

		$count = mysqli_num_rows($query);

		echo $count;

	}


	function ShowDiscount()
	{
			global $con;

            $query = "SELECT * FROM sales";
            $sql   = mysqli_query($con, $query);

            $sum = 0;

            while($num = mysqli_fetch_assoc($sql))
            {
                $sum += $num['discount'];
            }
        
        	echo "₵";
            echo number_format($sum, 2); 
	}

	function ShowSales()
	{
			global $con;

            $query = "SELECT * FROM sales"; 
            $sql   = mysqli_query($con, $query);

            $sum = 0;

            while($num = mysqli_fetch_assoc($sql))
            {
                $sum += $num['cash_tendered'];
            }
        
        	echo "₵";
            echo number_format($sum, 2); 
	}



	function ShowCreditorAmt()
	{
			global $con;

            $query = "SELECT * FROM creditors";
            $sql   = mysqli_query($con, $query);

            $sum = 0;

            while($num = mysqli_fetch_assoc($sql))
            {
                $sum += $num['quantity']*$num['product_price'];
            }
        
        	echo "₵";
            echo number_format($sum, 2); 
	}


	function ShowCreditorAmtPaid()
	{
			global $con;

            $query = "SELECT * FROM creditors";
            $sql   = mysqli_query($con, $query);

            $sum = 0;

            while($num = mysqli_fetch_assoc($sql))
            {
                $sum += $num['down_paymt'];
            }
        
        	echo "₵";
            echo number_format($sum, 2); 
	}

	function ShowCreditorAmtleft()
	{
			global $con;

            $query = "SELECT * FROM creditors";
            $sql   = mysqli_query($con, $query);

            $sum = 0;

            while($num = mysqli_fetch_assoc($sql))
            {
                $sum += $num['quantity']*$num['product_price']-$num['down_paymt'];
            }
        
        	echo "₵";
            echo number_format($sum, 2); 
	}
?>