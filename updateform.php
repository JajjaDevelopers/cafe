<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Account Creation</title>
  <link href="./ASSETS/bootsrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center align-items-center">
    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-6">
      <div class="card">
        <div class="card-header">
        <h1 class="text-center">Account Creation</h1>
          <div class="text-danger text-center">
            <?php include("./alerts/useraccountalert.php");?>
          </div>
        </div>
        <div class="card-body">
        <form action="./connection/updateuser.php" method="POST">
          <div class="form-group">
            <label for= "username">User Name</label>
            <input type="text" class="form-control" value="" name="username"/>
          </div>
          <div class="form-group">
            <label for= "tel">Telephone Contact</label>
            <input type="text" class="form-control" value="" name="telcontact"/>
          </div>
          <div class="form-group">
            <label for= "password">Password</label>
            <input type="password" class="form-control" value="" name="password"/>
            <p class="text-muted text-center" style="font-weight:bold;">Password must be at least eight characters</p>
          </div>
          <div class="form-group">
            <label for= "password">Confirm Password</label>
            <input type="password" class="form-control" value="" name="confpwd"/>
          </div>
          <div class="form-group mt-4 text-center">
            <input type="submit" name="register" value="Register" class="btn btn-primary">
          </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<script src="./ASSETS/bootsrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>