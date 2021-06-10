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
    <title>Category | <?php include('../dist/includes/title.php');?></title>
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
      
      
      .btn-back-t
      {
          background: #00a65a;
          padding: 10px;
          border-radius: 5px;
          color: #fff;
          font-size: 15px;
          margin-right: 10px;

      }

      .btn-back:hover
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

    .content-cus
    {
      position: relative;
      top: 30px;
      margin-bottom: 40px;
    }
      
    </style>
 </head>
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a> 
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Category</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
	           <div class="col-md-4">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add New Category</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="cat_add.php" enctype="multipart/form-data">
  
                  <div class="form-group">
                    <label for="date">Category</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="category" placeholder="Category" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="price">Status</label>
                    <div class="input-group col-md-12">
                      <select class="form-control pull-right" name="cat_status" style="width:100%;" required>
                       <option value="Active">Active</option>
                       <option value="Inactive">Inactive</option>
                    </select>
                    </div>
                  </div>
          		  
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn-back-t" id="daterange-btn" name="">
                        Save
                      </button>
					            <button type="reset" class="btn-back" id="daterange-btn">
                        Clear
                      </button>
                    </div>
                  </div><!-- /.form group -->
				          </form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            
            <div class="col-xs-8">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Category List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                			<th>Unit</th>
                      <th>Status</th>
                			<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    		
                    		$query = mysqli_query($con,"select * from category order by cat_name") or die(mysqli_error());

                    		while($row = mysqli_fetch_array($query))
                        {
                    		
                    ?>
                      <tr>
                        <td><?php echo $row['cat_name'];?></td>
                         <td>

                          <?php 

                            if ($row['cat_status'] == 'Active') 
                            {
                                echo "<span class='badge bg-green'>Active</span>";
                             }
                             else
                             {
                                echo "<span class='badge bg-red'>Inactive</span>";
                             }

                         ?>

                         </td>
                        <td>
                				
                        <a href="#updateCategory<?php echo $row['cat_id'];?>" data-target="#updateCategory<?php echo $row['cat_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

                         <a href="#delete<?php echo $row['cat_id'];?>" data-target="#delete<?php echo $row['cat_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>

        						</td>
                     </tr>


<!-- Category Update Modal -->
<div id="updateCategory<?php echo $row['cat_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height: auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Category Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="cat_update.php" enctype='multipart/form-data'>
                
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Category</label>
					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cat_id'];?>" required>  
					  <input type="text" class="form-control" id="name" name="category" value="<?php echo $row['cat_name'];?>" required>  
					</div>
				</div> 


        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Status</label>
          <div class="col-lg-9">
            <select class="form-control" name="cat_status" style="width: 100%;" required>
             <option value="Active">Active</option>
             <option value="Inactive">Inactive</option>
          </select>
          </div>
        </div>
				
				
              </div><hr>
              <div class="modal-footer">
		         <button type="submit" class="btn btn-primary">Update Category</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			       </form>
            </div>
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->              


 <!-- Delete Category Modal -->
 <div id="delete<?php echo $row['cat_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Category</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="category_del.php">
             
                <input type="hidden" class="form-control" name="cat_id" value="<?php echo $row['cat_id'];?>" required> 
                      
                      <p>Are you sure you want to remove Customer?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" name="delete" class="btn btn-danger" >
                      <a href="delete<?php echo $row['cat_id'];?>" style="color: #ffffff;">
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
                        <th>Unit</th>
                        <th>Status</th>
			                   <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
