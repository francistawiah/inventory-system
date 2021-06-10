
<?php 
      session_start();
      if(empty($_SESSION['id'])):
      header('Location:../index.php');
      endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Expenses | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <style>
      
      .btn-back
      {
          background: #00a65a;
          padding: 10px;
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

      .btn-add
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
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
      margin-bottom: 30px;
    }
    </style>
 </head>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a>
              <a class="btn-add" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-white"></i> Add New Expenses </a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Expenses</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Expenses</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Category</th>
						<th>Amount</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php
		
              		$query = mysqli_query($con,"SELECT * FROM expense WHERE branch_id = '$branch'")or die(mysqli_error());
              		
                  while($row = mysqli_fetch_array($query))
                  {
                      $expense_cat_id = $row['expense_cat_id'];
                     
                       // Get Stock total price
                      $get_cat = "SELECT * FROM expense_category WHERE expense_cat_id = '$expense_cat_id'";
                      $run_cat = mysqli_query($con, $get_cat);
                      $row_cat = mysqli_fetch_array($run_cat);
                      $expense_cat_name = $row_cat['expense_cat_name'];
                
                      ?>
	
                      <tr>
                        <td><?php echo $expense_cat_name; ?></td>
						<td><?php echo $row['expense_amt'];?></td>
                        <td><?php echo $row['expense_date'];?></td>
                        <td><?php echo $row['expense_desc'];?></td>
                        <td>
				<a href="#update<?php echo $row['expense_id'];?>" data-target="#update<?php echo $row['expense_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

         <a href="#delete<?php echo $row['expense_id'];?>" data-target="#delete<?php echo $row['expense_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
						</td>
              </tr>


        <div id="update<?php echo $row['expense_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        	<div class="modal-dialog">
        	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Expense Details</h4>
              </div>
              <div class="modal-body">
        			  <form class="form-horizontal" method="post" action="expense_update.php" enctype='multipart/form-data'>
             
      				<div class="form-group">
      					<label class="control-label col-lg-3" for="file">Expense Name</label>
      					<div class="col-lg-9">
      					   <input type="hidden" class="form-control" name="expense_id" value="<?php echo $row['expense_id'];?>" required>
      					    <select class="form-control select2" style="width: 100%;" name="expense_name" required>
      						  <option value="<?php echo $row['expense_id'];?>"><?php echo $expense_cat_name; ?></option>
      					      <?php
      					
							$query2 = mysqli_query($con,"select * from expense_category")or die(mysqli_error());
							  while($row2 = mysqli_fetch_array($query2)){
					        ?>
							    <option value="<?php echo $row['expense_cat_id'];?>"><?php echo $row2['expense_cat_name'];?></option>
					      <?php }?>
					    </select>
					</div>
				</div> 
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Amount</label>
					<div class="col-lg-9">
					  <input type="hidden" class="form-control" name="expense_id" value="<?php echo $row['expense_id'];?>" required> 
					  <input type="text" class="form-control" id="price" name="expense_amt" value="<?php echo $row['expense_amt'];?>" required>  
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Amount</label>
					<div class="col-lg-9">
					  <input type="hidden" class="form-control" name="expense_id" value="<?php echo $row['expense_id'];?>" required>
					 <textarea class="form-control" name="expense_desc">
					     <?php echo $row['expense_desc']; ?>
					 </textarea> 
					</div>
				</div>
				
				
              </div><br><br><br><br><br><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
			       </form>
            </div>	
          </div><!--end of modal-dialog-->
      </div>
 <!--end of modal-->               

 <!-- Delete Product Modal -->
 <div id="delete<?php echo $row['expense_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Expense Details</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="expense_del.php">
             
                  <input type="hidden" class="form-control" name="expense_id" value="<?php echo $row['expense_id'];?>" required> 
                      
                      <p>Are you sure you want to remove this expenses?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" name="delete" class="btn btn-danger" >
                      <a href="delete<?php echo $row['expense_id'];?>" style="color: #ffffff;">
                          Delete </a></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>


 <!--end of modal-->       
<?php }?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>Category</th>
						<th>Amount</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div>
            </div>
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

          <!-- Add Product Modal -->
        <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Expenses</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post" action="expense_add.php" enctype='multipart/form-data'>
               
       
              <div class="form-group">
                <label class="control-label col-lg-3" for="file">Expense Name</label>
                <div class="col-lg-9">
                    <select class="form-control select2" style="width: 100%;" name="expense_name" required>
                      <?php
                  
                    $query2 = mysqli_query($con,"select * from expense_category")or die(mysqli_error());
                      while($row2 = mysqli_fetch_array($query2)){
                      ?>
                        <option value="<?php echo $row2['expense_cat_id'];?>"><?php echo $row2['expense_cat_name'];?></option>
                      <?php }?>
                    </select>
                </div>
              </div> 
        
              <div class="form-group">
                <label class="control-label col-lg-3" for="price">Amount</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="price" name="expense_amt" placeholder="Amount Spent" required>  
                </div>
              </div>

            
        
              <div class="form-group">
                <label class="control-label col-lg-3" for="price">Description</label>
                <div class="col-lg-9">
                <textarea row="5" class="form-control" name="expense_desc">
                    
                </textarea>
                </div>
              </div>
        
               

              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Expense</button>
              </div>
            </form>
            </div>
        </div>
      </div><!--end of modal--> 

   
       <?php include('../dist/includes/footer_links.php');?>
   


  