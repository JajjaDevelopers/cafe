
  <?php
  //message for successful sign Up by a person
  $error="";
  if(isset($_GET["error"]))
  {?>
  <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
      <p class="text-center text-white" style="font-size:medium"> You have signed up successful. You can now login!</p>
    <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  }

  if(isset($_GET["message"])=="notactive")
  {?>

  <div class="alert alert-danger alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
    <p class="text-center text-white" style="font-size:medium">Your account is not active. Consult system administrators for further assistance</p>
    <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  }

  //message upon password reset
  if(isset($_GET["newpwd"]))
  {
    if($_GET["newpwd"]=="newpasswordupdated")
    {?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
      <p class="text-center text-white" style="font-size:medium">Your have successfully updated your password</p>
      <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    }else if($_GET["newpwd"]=="empty")
    {?>
      <div class="alert alert-danger alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">You submitted empty field! Click again the link in your email to reset!</p>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }else if($_GET["newpwd"]=="pwddonotmatch")
    {?>
       <div class="alert alert-danger alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Passwords didnot much! Click again the link in your email to reset!</p>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
       
    }
 }
?>
