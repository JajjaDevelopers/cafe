<?php
require_once "header.php";
?>

<div class="container mt-5" id="divlogin">
  <div class="container text-primary text-center">
    <?php
    if (isset($_GET["reset"]))
    {
      if($_GET["reset"]=="success")
      {
        echo "<p>Check your email to reset password!</p>";
      }
    }
    ?>
  </div>
  <div class="card my-4">
    <div class="card-header">
      <h3 class="text-center text-primary" >Password Reset</h3>
    </div>
    <div class="card-body">
      <p class="text-success">An email will be sent to you with the necessary link to reset your 
        password
      </p>
    <form action="connection/reset-request.php" method="post">
  <div class="row">
    <div class="col-md-12 justify-content-center">

      <div class="form-group">
        <label for="username"><strong> Email Address</strong></label>
        <input type="email" name="email" class="form-control" placeholder="Please Enter Your Email">
      </div>
    
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary my-3 btn-lg" name="reset-request-submit">Send Request</button>
      </div>
    </div>
  </div>
  </form>
</div>
  </div>
</div>
  
<?php
require_once "footer.php";
?>