<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Password Reset</title>
  <link href="./ASSETS/bootsrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" id="divlogin" style="width:500px;">
  <div class="card my-4" id="resetpwd">
    <div class="card-header">
      <h3 class="text-center" >Password Reset</h3>
      <?php include("./alerts/resetpassword.php");?>
    </div>
    <div class="card-body">
    <form action="connection/reset-request.php" method="post">
      <div class="row">
        <div class="col-md-12 justify-content-center">

          <div class="form-group">
            <label for="username"><strong> Email Address</strong></label>
            <input type="email" name="email" class="form-control" placeholder="Please Enter Your account Email Address">
          </div>
        
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary my-3" name="reset-request-submit">Send Request</button>
          </div>
        </div>
      </div>
  </form>
</div>
  </div>
</div>
<script src="./ASSETS/bootsrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>