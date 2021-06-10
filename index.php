<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - <?php include('dist/includes/title.php');?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  </head>
  <style type="text/css">
    .btn-sign
    {
      background: #fff; 
      color: #00a65a;
      padding: 5px;
      font-weight: 700;
      border: 1px solid #00a65a;
      border-radius: 10px;
    }

    .btn-clear
    {
      background: #fff; 
      color: #00a65a;
      padding: 5px;
      font-weight: 700;
      border: 1px solid #00a65a;
      border-radius: 10px;
    }
    
    .dziks
    {
        font-style: sans-serif;
        font-weight: 700;
        
    }
    
    .bg-img
    {
       background-image: linear-gradient(rgba(0, 0, 0, 0.13), rgba(0, 0, 0, 0.83)),
    url('images/banner1.jpg');
        /*background-image:url('images/banner1.jpg');*/
          /* Full height */
          height: 100vh;
        
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
    }
  </style>
  <body class="hold-transition login-page bg-img">
    <div class="login-box" style="background: #00a65a; padding: 30px; color: #fff; border-radius: 30px;">
      <div class="login-logo">
        <h3 class="dziks">Dziks Commodities & Agrochemical Company Ltd.</h3>
        <hr>
      </div>
      <div class="login-box-body" style="background: #00a65a; padding: 30px; color: #fff; border-radius: 30px;">
        <p class="login-box-msg">Sign in to start your session</p>
        <!-- Login Form -->
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
           </div>

		        <div class="form-group has-feedback">
              <select class="form-control select2" style="width:100%" name="branch" required>
                <?php
				          
                  include('dist/includes/dbcon.php');
                   $query3 = mysqli_query($con,"select * from branch order by branch_name")or die(mysqli_error($con));
                      while($row3 = mysqli_fetch_array($query3)){
                   ?>
                    <option value="<?php echo $row3['branch_id'];?>">
                      <?php echo $row3['branch_name'];?></option>

                  <?php }?>
                </select>
              </div>

          <div class="row">
			     <div class="col-xs-6 pull-right">
			      <button type="reset" class="btn-clear btn-block">Clear</button>
            </div>
			       <div class="col-xs-6 pull-right">
              <button type="submit" class="btn-sign btn-block btn-flat" name="login" default>Sign In</button>
            </div>
          </div>

        </form>
      </div>
    </div>
      
           
   
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
