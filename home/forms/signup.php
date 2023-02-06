<?php $pageTitle="Sign up New User"; ?>
<?php
  session_start();

  error_reporting(1);
  if(isset($_SESSION["userName"]) or isset($_SESSION["userEmail"]))
  {
    ?>
      <?php include_once('header.php'); ?>
      <style>
          #divsignup{
          border:2px solid gray;
          width:525px;
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
            color:green;
          }
      </style>
      <div class="container mt-5" id="divsignup" style="background-color:green;border-radius:15px;">
        <div class="card  my-4 shadow-lg p-3 mb-5 bg-body rounded">
          <div class="card-header">
            <h3 class="text-center text-primary" >User Sign Up Form</h3>
          </div>
          <div class="card-body" style="background-color:white">
          <form action="../connection/formsignup.php" method="post" id="signupform">
        <div class="row">
          <div class="col-md-12 justify-content-center" >
          <div>
              <!-- <h3 class="text-center text-primary" >Sign Up</h3> -->
                <!---Displaying errors--->
              <div class="container text-center" style="color:red" id="signupclear">
                <?php
                include "../alerts/errorsignup.php";
                ?>
              </div>
              <script src="../assets/js/signupclear.js"></script>
          </div>
            <div class="form-floating">
              <input type="text" name="fullname" class="form-control" value="<?=$_SESSION["fname"]?>">
              <label for="fullname">Full Name</label>
            </div>
            <div class="form-floating mt-3">
              <input type="text" name="username" class="form-control" value="<?=$_SESSION["fusername"]?>">
              <label for="username">User Name</label>
            </div>
            <div class="form-floating mt-3">
              <input type="email" name="email" class="form-control" value="<?=$_SESSION["email"]?>">
              <label for="email">Email Address</label>
            </div>
            <div class="form-floating mt-3">
              <input type="telephone" name="tel" class="form-control" value="<?=$_SESSION["tel"]?>">
              <label for="tel">Tel</label>
            </div>
            <div class="form-floating mt-3">
              <input type="password" name="pwd" class="form-control" >
              <label for="password">Password</label>
            </div>
            <div class="form-floating mt-3">
              <input type="password" name="confpwd" class="form-control" >
              <label for="password">Confirm Password</label>
            </div>

            <div class="form-check mt-3">
              <p class="text-primary">Access Privilege</p>
              <input class="form-check-input" type="radio" name="access" id="flexRadioDefault1" value="1">
              <label class="form-check-label" for="flexRadioDefault1">
                Admin
              </label>
            </div>  
            <div class="form-check">
              <input class="form-check-input" type="radio" name="access" id="flexRadioDefault2" value="2">
              <label class="form-check-label" for="flexRadioDefault2">
                Staff
              </label>
            </div>

            <div class="form-group text-center">
              <input type="submit" name="submit" class="btn btn-primary my-3 btn-lg " id="signupbtn" value="Sign Up User">
            </div>
          </div>
        </div>
        </form>

          </div>
        </div>

      </div>
      <?php include_once('footer.php'); ?>
      
    <?php
  } else
  {
    include "redirect.php";
  }
?>
