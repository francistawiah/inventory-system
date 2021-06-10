<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    
    <style type="text/css">
     
      @media print {
          .btn-print {
            display:none !important;
          }
      }

     
      .btn-back
      {
          background: #00a65a;
          padding: 10px;
          margin-left: 280px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;

      }

      .btn-back:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
      }

      .btn-display
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;

      }

      .btn-display:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
      }

      .btn-prt
      {
          background: #00a65a;
          padding: 10px;
          margin-top: 40px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
      }

      .btn-prt:hover
      {
         background: #fff;
         color: #00a65a;
         border: 1px solid #00a65a;
      }


    .box
     {
        border-top: 5px solid #00a65a;
        border-left: 4px solid #e3e3e3; 
        border-right: 4px solid #e3e3e3; 
        border-bottom: 4px solid #e3e3e3; 
     }

     .select2
     {
       border: 1px solid #00a65a;
     }

    .content-cus
    {
      position: relative;
      top: 30px;
    }

    /* Receipt  */
#invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}


#invoice-POS::selection{
  background: #f31544;
  color: #FFF;
}
#invoice-POS::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: 0.9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: 0.7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
  background-size: 60px 60px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: 0.5em;
  background: #EEE;

}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
  padding: 5px;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 0.5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
  text-align: center;
}
  

    </style>
 </head>
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <div class="content-wrapper" style="background: #00a65a; padding-top: 90px; ">
        <div class="container">
          <section class="content content-cus" style="background: #fff; border-radius: 20px;  ">
            <div class="row">
	           <div class="col-md-12">
              <div class="col-md-12">
              </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  <?php

                  include('../dist/includes/dbcon.php');
                      $id  =  $_SESSION['id'];
                      $branch =  $_SESSION['branch'];
                      $queryb = mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
                    
                          $rowb = mysqli_fetch_array($queryb);
                          
                  ?>			
                                   
                  <?php

                      $branch = $_SESSION['branch'];
                      $query = mysqli_query($con,"select * from sales where branch_id='$branch' order by sales_id desc LIMIT 0,1")or die(mysqli_error($con));
                        
                          $row = mysqli_fetch_array($query);
                         
                          $sales_id = $row['sales_id']; 
                          $sid      = $row['sales_id'];
                          $due      = $row['amount_due'];
                          $discount = $row['discount'];
                          $grandtotal = $due - $discount;
                          $tendered = $row['cash_tendered'];
                          $change   = $row['cash_change'];

                          $query1 = mysqli_query($con,"select * from payment where sales_id='$sales_id'")or die(mysqli_error($con));
                        
                          $row1 = mysqli_fetch_array($query1);

                  ?>    
                  
  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Dziks Commodities & Agrochemical Company Ltd.</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Branch  : <?php echo $rowb['branch_name'];?></br>
            Address : <?php echo $rowb['branch_address'];?> </br>
            Phone   : <?php echo $rowb['branch_contact'];?></br>
            Date:     <?php echo date("M d, Y");?> </br>
            Time:     
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

          <div id="table">
            <table>
              <tr class="tabletitle">
                <td class="item"><h2>Item</h2></td>
                <td class="Hours"><h2>Qty</h2></td>
                <td class="Rate"><h2>Sub Total</h2></td>
              </tr>

                  <?php
                          
                          $query = mysqli_query($con,"select * from sales_details natural join product where sales_id='$sid'")or die(mysqli_error($con));
                          
                          $grand = 0;
                          
                          while($row = mysqli_fetch_array($query))
                          {
                              $total = $row['qty'] * $row['price'];
                              $grand = $grand + $total;       
                  ?>
              <tr class="service">
                <td class="tableitem"><p class="itemtext"><?php echo $row['prod_name'];?></p></td>
                <td class="tableitem"><p class="itemtext"><?php echo $row['qty'];?></p></td>
                <td class="tableitem"><p class="itemtext">₵<?php echo number_format($total,2);?></p></td>
              </tr>
              <?php } ?>  

              


              <tr class="tabletitle">
                <td></td>
                <td class="Rate"><h2>Discount</h2></td>
                <td class="payment"><h2>₵<?php echo number_format($discount,2);?></h2></td>
              </tr>

              <tr class="tabletitle">
                <td></td>
                <td class="Rate"><h2>Total</h2></td>
                <td class="payment"><h2>₵<b><?php echo number_format($grand-$discount,2);?></b></h2></td>
              </tr>

            </table>
          </div><!--End Table-->

          <div id="legalcopy">
            <p class="legal"><strong>Thank you !</strong>  
            </p>
          </div>

        </div><!--End InvoiceBot-->
  </div><!--End Invoice-->



                   </div>
        				  </div>  
        				</form>	
                </div><br><br>
                <div style="padding-bottom: 40px;">
                <a class="btn-back btn-print" onclick="doPrint();"><i class ="glyphicon glyphicon-print"></i> Print</a>
                <a class="btn-prt btn-print" href ="cash_transaction.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Sales Point</a></div>
              </div>
            </div>  
          </div>
          </section>
        </div>
      </div>
    </div>

	<script>
		function doPrint() {
			window.print();            
			window.location.href = "cash_transaction.php"; 
		}
	</script>
	




	  <script type="text/javascript" src="autosum.js"></script>
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	  <script src="../dist/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
   
  </body>
</html>
