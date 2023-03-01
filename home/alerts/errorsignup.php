<?php
    if(isset($_GET["error"]))
    {
      $_SESSION["error"]=$_GET["error"];
      if($_SESSION["error"]==="passwordsdontmatch")
      {
        echo "Passwords don't match";
      }
      if($_SESSION["error"]==="lessthaneight"){
    echo "The password is too short, must have a minimum of 8 characters";
      }
      if($_SESSION["error"]==="invalidname")
      {
        echo "User name is invalid, only letters and numbers are allowed";
      }
      if($_SESSION["error"]==="emptyfield")
      {
        echo "Some fields are missing";
      }
      if($_SESSION["error"]==="incorrectnumber")
      {
        echo "Invalid phone number";
      }
      if($_SESSION["error"]==="userexists")
      {
        echo "A user already exists in a database";
      }
      if($_SESSION["error"]==="invalidemail")
      {
        echo "Your email is invalid";
      }
      if($_SESSION["error"]==="successfully")
      {?>
      <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Signed Up user successfully!</p>
      <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      <?php
      }
    }
  ?>