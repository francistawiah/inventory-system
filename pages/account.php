<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  
 </head>
  <body class="hold-transition skin-red layout-top-nav">
    <div class="wrapper">
      <?php 

         include('../dist/includes/header.php');
         include('../dist/includes/dbcon.php');

      ?>
      <div class="content-wrapper">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customer</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Customer List</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                  			<th>Contact</th>
                  			<th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    		$branch = $_SESSION['branch'];
                    		$query = mysqli_query($con,"select * from customer where branch_id='$branch'")or die(mysqli_error());

                    		while($row = mysqli_fetch_array($query))
                        {
                    ?>
                        <tr>
                        <td><?php echo $row['cust_last'];?></td>
                        <td><?php echo $row['cust_first'];?></td>
                        <td><?php echo $row['cust_address'];?></td>
                  			<td><?php echo $row['cust_contact'];?></td>
                  			<td><?php echo number_format($row['balance'],2);?></td>
                        <td>
                				<a href="account_summary.php?cid=<?php echo $row['cust_id'];?>"><i class="glyphicon glyphicon-share-alt"></i></a>

                				<a href="#updateordinance<?php echo $row['cust_id'];?>" data-target="#updateordinance<?php echo $row['cust_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                        
                				<i class="glyphicon glyphicon-remove-sign text-red"></i>
						           </td>
                  </tr>

                  <!-- Customer Update -->
    <div id="updateordinance<?php echo $row['cust_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
    	  <div class="modal-content" style="height:auto">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Update Customer Details</h4>
                  </div>
                  <div class="modal-body">
    			  <form class="form-horizontal" method="post" action="customer_update.php" enctype='multipart/form-data'>
                    
    				<div class="form-group">
    					<label class="control-label col-lg-3" for="name">Customer Name</label>
    					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>  
    					  <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['cust_first']. " ".$row['cust_last'];?>" required>  
    					</div>
    				</div> 
    				<div class="form-group">
    					<label class="control-label col-lg-3" for="file">Address</label>
    					<div class="col-lg-9">
    					    <textarea class="form-control" id="name" name="address" required><?php echo $row['cust_address'];?></textarea>  
    					</div>
    				</div> 
    				<div class="form-group">
    					<label class="control-label col-lg-3" for="price">Contact Number</label>
    					<div class="col-lg-9">
    					  <input type="text" class="form-control" id="price" name="contact" value="<?php echo $row['cust_contact'];?>" required>  
    					</div>
    				</div>
    				
                  </div><br><br><br><hr>
                  <div class="modal-footer">
    		<button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
    			       </form>
                </div>
              </div>
           </div> <!--end of modal-->                    
            <?php } ?>					  
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                  			<th>Contact #</th>
                  			<th>Balance</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div>
            </div>
          </div>
         </section>
        </div>
      </div>
      <?php include('../dist/includes/footer.php');?>
    </div>

    <?php include('../dist/includes/footer_links.php');?>

