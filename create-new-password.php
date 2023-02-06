
<?php
 include_once "header.php";
?>

<div class="wrapper">
  <?php
    $selector=$_GET["selector"];
    $validator=$_GET["validator"];

    if(empty($selector) || empty($validator))
    {
      echo "Request validation failed! Try again";
    }else{

      if(ctype_xdigit($selector) !==false && ctype_xdigit($validator) !==false){
      ?>

<div class="container mt-5" id="divlogin">
  <div class="card my-4">
    <div class="card-header">
      <h3 class="text-center text-primary">PASSWORD RESET</h3>
    </div>
    <div class="card-body">
    <form action="connection/password-reset.php" method="post">
  <div class="row">
    <div class="col-md-12 justify-content-center">
      <div class="form-group">
        <input type="hidden" name="selector" value="<?=$selector?>">
        <input type="hidden" name="validator" value="<?=$validator?>">
      </div>
      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" name="pwd" class="form-control" placeholder="Enter New Password">
      </div>
      <div class="form-group">
        <label for="newPassword">New Password Repeat</label>
        <input type="password" name="pwdRepeat" class="form-control" placeholder="Repeat  New Password">
      </div>
       <button type="submit" name="reset-password-submit" class="btn btn-primary btn-lg mt-3 mx-auto">Reset Password</button>
      </div>
    </div>
  </div>
  </form>
</div>
  </div>

      <?php

      }

    }
  ?>
</div>

<?php
 include_once "footer.php";
?>