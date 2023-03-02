<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sign Admin</title>
  <link href="./ASSETS/bootsrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
      <style>
          #divsignup{
          /* border:2px solid gray;*/
          width:800px;
          background-color:white;
        }
          #signupbtn:hover{
              background-color:green;
          }
          #signupbtn:focus{
              background-color:#765341;
          }
          #signupform{
            border:none;
            background-color: white;
            font-size:medium;
            color:black;
          }
      </style>
      <div class="container mt-5" id="divsignup">
        <div class="card  my-4 shadow-lg p-3 mb-5 bg-body rounded">
          <div class="card-header">
            <h3 class="text-center">Create New User Form</h3>
          </div>
          <div class="card-body" style="background-color:white">
          <form action="./connection/formsignup.php" method="post" id="signupform">
            <?php include "signupsession.php";?>
          <div class="col-md-12 justify-content-center" >
          <div>
              <!-- <h3 class="text-center text-primary" >Sign Up</h3> -->
                <!---Displaying errors--->
              <div class="container text-center text-danger" id="signupclear">
                <?php
                include "./alerts/errorsignup.php";
                ?>
              </div>
              <!-- <script src="./assets/js/signupclear.js"></script> -->
          </div>
          </div>
          <div class="row mt-3">
            <div class="form-group col-md-6">
                <label for="fullname" class="text-center">Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?=sessionData($field="name")?>">
            </div>
            <div class="form-group col-md-6">
              <label for="username"  class="text-center">User Name</label>
              <input type="text" name="username" class="form-control" value="<?=sessionData($field="username")?>">
            </div>
          </div>
          <div class="row mt-3">
            <div class="form-group col-md-6">
                <label for="email"  class="text-center">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?=sessionData($field="email2")?>">
            </div>
            <div class="form-group col-md-6">
              <label for="tel"  class="text-center">Tel</label>
              <input type="telephone" name="tel" class="form-control" value="<?=sessionData($field="tel2")?>">
            </div>
          </div>
          <div class="row mt-3">
            <div class="form-group col-md-6">
                <label for="password"  class="text-center">Password</label>
                <input type="password" name="pwd" class="form-control" >
              </div>
              <div class="form-group col-md-6">
                <label for="password" class="text-center">Confirm Password</label>
                <input type="password" name="confpwd" class="form-control" >
              </div>
          </div>
            <div class="form-check">
                <p class="text-primary">Access Privilege</p>
                <input class="form-check-input" type="radio" name="access" id="flexRadioDefault1" value="1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Chief
                </label>
            </div> 
            <div class="form-check">
              <input class="form-check-input" type="radio" name="access" id="flexRadioDefault2" value="2">
              <label class="form-check-label" for="flexRadioDefault2">
                Manager
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="access" id="flexRadioDefault3" value="3">
              <label class="form-check-label" for="flexRadioDefault3">
                Staff
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="access" id="flexRadioDefault4" value="4">
              <label class="form-check-label" for="flexRadioDefault4">
                Other
              </label>
            </div>

            <div class="form-group text-center">
              <input type="submit" name="submit" class="btn btn-primary my-3 " id="signupbtn" value="Create User">
            </div>
        </form>

          </div>
        </div>

      </div>
      <script src="./ASSETS/bootsrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
