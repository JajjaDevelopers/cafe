<?php
//grn messages
if(isset($_GET["verify"])){
  if($_GET["verify"]=="success"){
    $grn="GRN-".$_GET["grn"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">GRN&nbsp;<?=$grn?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["verify"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
//release messages
if(isset($_GET["release"])){
  if($_GET["release"]=="success"){
    $rel="RLS-".$_GET["relno"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Release &nbsp;<?=$rel?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["release"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
//valuation messages
if(isset($_GET["valuation"])){
  if($_GET["valuation"]=="success"){
    $numb="VAL-".$_GET["valNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">valuation &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["valuation"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
//sales Report messages
if(isset($_GET["sales"])){
  if($_GET["sales"]=="success"){
    $numb="SAL-".$_GET["salNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">sales Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["sales"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
