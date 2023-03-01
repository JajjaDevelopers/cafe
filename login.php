<?php
require_once "header.php";
?>
<div class="text-cente mt-4">
  <?php include("./alerts/logmessage.php");?>
</div>

<style>
   #loginbtn:hover{
        background-color:green;
    }
    #loginbtn:focus{
        background-color:blue;
    }
</style>

<div class="container mt-5 border  rounded-3 " id="divlogin" style="background-color: green;">
  <div class="card my-4 shadow-lg p-3 mb-5 bg-body rounded">
    <div class="card-header text-center">
    <img src="ASSETS/images/logo2.jpg" width="100" height="100" >
      <!-- <span class="material-icons-sharp " style="font-size:48px;">
      account_circle
      </span> -->
      <h4>User Account</h4>
    </div>
    <div class="card-body">
    <form action="connection/formlogin.php" method="post">
  <div class="row">
    <div class="col-md-12 justify-content-center">

      <div class="form-floating ">
        <input type="text" name="username" class="form-control" value="<?php include "loginsession.php";?>">
        <label for="username">Username or Email</label>
      </div>
      <div class="form-floating mt-3">
        <input type="password" name="password" class="form-control">
        <label for="username">Password</label>
      </div>
      <div class="form-group text-center">
        <div class="text-danger text-center">
          <?php
          include "alerts/errorlogin.php";
          ?>
        </div>
        <!-- <input type="submit" name="submit" class="btn btn-primary my-3 " id="loginbtn" value="Sign In"> -->
        <button type="submit" name="submit" class="btn btn-primary my-3 btn-block " id="loginbtn">Sign into Nucafe ERP</button>
      </div>
    </div>
  </div>
  </form>
</div>

<div class="card-footer">
  <h4><a href="reset-password.php">Forgotten Password?</a></h4>
</div>
  
  </div>
</div>
  
<?php
require_once "footer.php";
?>