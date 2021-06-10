<?php 
   
   include 'header.php';

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include 'main_sidebar.php';?>
       <?php include 'top_nav.php';?>    

        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">					
				 <div class = "x-panel">
				 	<!-- Form 1 -->
				 	<h3>Shop Title</h3>
				 	<hr>
				 	<form action="settings.php" method="post">
				 		<div class="form-group" style="width: 50%;">
				 		<label for="Shop Title">Shop Title</label>
				 		<input type="text" name="shop_title" class="form-control" placeholder="Enter your shop's name">
				 	    </div>

				 	    <div class="form-group" style="width: 50%;">
				 		<label for="Shop Logo">Shop Logo</label>
				 		<input type="file" name="photo_logo" class="form-control">
				 	    </div> 
 

				 	    <div class="form-group">
				 		<button type="submit" class="btn btn-success" name="insert_shop">Insert Details</button>
				 		<button type="submit" class="btn btn-success" name="update_shop">Update Details</button>
				 	   </div>
				 	</form>
	
                </div>
                
				</div>
				</div>
			</div>
        </div>		
        <footer>
          <div class="pull-right">
          Cwesical Enterprise <a href="#"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
  </body>
</html>

<?php
    
 
    if(isset($_POST['insert_shop']))
    {
    	$shop_title = mysqli_real_escape_string($con, $_POST['shop_title']);

        $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='JPG' && $ext!='png' && $ext!='PNG' && $ext!='jpeg' && $ext!='JPEG' && $ext!='gif' && $ext!='GIF' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
       
        // updating the data
        $final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, 'images/'.$final_name );

        // updating the database
        $statement = "INSERT INTO shop_info(shop_title, shop_img)VALUES('$shop_title', '$final_name')";
        $run = mysqli_query($con, $statement);



         if($run)
         {
         	echo "<script>alert('Shop Information updated successfully')</script>";
         	echo "<script>document.location='settings.php'</script>";
         }




    }
}




?>
