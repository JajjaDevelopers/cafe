<?php
    if (isset($_GET["reset"]))
    {
      if($_GET["reset"]=="success")
      {?>
        <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
         <p class="text-center text-white" style="font-size:medium">Password-reset link sent. Check your inbox or spam!</p>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
     <?php
      }elseif($_GET["reset"]=="fail"){
        ?>
        <div class="alert alert-danger alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
         <p class="text-center text-white" style="font-size:medium">Sorry, we are unable to send password-reset link! Kindly contact system administrators</p>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
     <?php
      }
    }