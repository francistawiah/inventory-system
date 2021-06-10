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
    <title>Brands | <?php include('../dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style type="text/css">
      
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

      input[type="text"]
      {
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


    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <div class="content-wrapper" style="background: #fff;">
        <div class="container">
          <section class="content-header">
            <h1>
              <a class="btn-back" href="home.php">Back</a>
              <a class="btn-add" href="#add" data-target="#addBrandModal" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-white"></i> Add New Brand</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Brands</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content content-cus">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Brand List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      
                        <th>Brand Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

                      $SQL = "SELECT * FROM brands ORDER BY brand_name";
                      $conn = mysqli_query($con, $SQL) or die('Error:'.mysqli_error($con));

                      if(mysqli_num_rows($conn) > 0)
                        {
                          while($row=mysqli_fetch_array($conn))      
                          {
                      //get_Brands(); 
                      ?>

                       <tr>                     
                        <td><?php echo $row['brand_name'];?></td>
                        <td><?php 
                       
                          if($row['brand_status']=='Active') 
                            {
                            echo "<span class='badge bg-green'>Active</span>";
                            }
                           else
                           {
                            echo "<span class='badge bg-red'>Inactive</span>";
                            }
                        ?></td>
                        <td>
                        <a href="#update<?php echo $row['brand_id'];?>" data-target="#update<?php echo $row['brand_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

                         <a href="#delete<?php echo $row['brand_id'];?>" data-target="#delete<?php echo $row['brand_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
                         
                         </td>
                          </tr>

                           <!-- Update Brand Modal -->      
      <div id="update<?php echo $row['brand_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Brand Details</h4>
              </div>
              <div class="modal-body">

            <form class="form-horizontal" method="post" action="brand_update.php" enctype='multipart/form-data'>
                    
            <div class="form-group">
              <label class="control-label col-lg-3">Brand Name</label>
              <div class="col-lg-9">
                  <input type="hidden" class="form-control" name="brand_id" value="<?php echo $row['brand_id'];?>" required>  
                <input type="text" class="form-control" name="brand_name" value="<?php echo $row['brand_name'];?>" required>  
              </div>
            </div> 
          
           
            <div class='form-group'>
              <label class='control-label col-lg-3' for='price'> Brand Status</label>
              <div class='col-lg-9'>
                <select class='form-control select2' name='brand_status' style='width: 100%;' required>
                 <option value='Active'>Active</option>
                 <option value='Inactive'>Inactive</option>
              </select>
              </div>
            </div>  

                  </div><br><br><br><br><br><br>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                 </form>
                  </div>
              </div><!--end of modal-dialog-->
       </div>
 <!--end of modal-->        


<!-- Delete Brand Modal -->
 <div id="delete<?php echo $row['brand_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Brand</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="brand_del.php">
             
                  <input type="hidden" class="form-control" name="brand_id" value="<?php echo $row['brand_id'];?>" required> 
                      
                      <p>Are you sure you want to remove Brand?</p>
              
                    </div><br>
                    <div class="modal-footer">
                      <button type="submit" name="delete" class="btn btn-danger" >
                      <a href="delete<?php echo $row['brand_id'];?>" style="color: #ffffff;">
                          Delete </a></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>






<?php } }?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php include('../dist/includes/footer.php');?>
  </div>


 
              <!-- Add New Brand Modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="addBrandModal">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Brand </h4>
      </div>
      <form class="form-horizontal" role="form" action="brand_add.php" method="POST">
      <div class="modal-body"> 

            <div class="form-group">
              <label class="control-label col-sm-3" for="brandName">Brand Name</label>
              <div class="col-sm-9">
                <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" autocomplete="off" required>
              </div>
            </div>

          <div class="form-group">
          <label class="control-label col-lg-3" for="price"> Brand Status</label>
          <div class="col-lg-9">
            <select class="form-control" name="brand_status" style="width: 100%;" required>
             <option value="Active">Active</option>
             <option value="Inactive">Inactive</option>
          </select>
          </div>
        </div>
        
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
    </div>
    </form>
    </div>
    </div>
   </div>











          
 <!--end of modal--> 
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
