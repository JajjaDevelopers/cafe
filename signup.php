<?php include_once "header.php";?>
      <div class="container mt-5 text-info" id="divsignup">
        <div class="card  my-4 shadow-lg p-3 mb-5 bg-body rounded">
          <div class="card-header">
            <h3 class="text-center text-primary" >User Sign Up Form</h3>
          </div>
          <div class="card-body" style="background-color:white">
          <form action="./connection/formsignup.php" method="post">
        <div class="row">
          <div class="col-md-12 justify-content-center" >
          <div>
            <?php
                include "./alerts/errorsignup.php";
            ?>  
          </div>
            <div class="form-floating">
              <input type="text" name="fullname" class="form-control" >
              <label for="fullname">Full Name</label>
            </div>
            <div class="form-floating mt-3">
              <input type="text" name="username" class="form-control" >
              <label for="username">User Name</label>
            </div>
            <div class="form-floating mt-3">
              <input type="email" name="email" class="form-control" >
              <label for="email">Email Address</label>
            </div>
            <div class="form-floating mt-3">
              <input type="telephone" name="tel" class="form-control" >
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
<?php include_once "footer.php";?>
