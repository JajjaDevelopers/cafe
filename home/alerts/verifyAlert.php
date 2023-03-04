<?php
//grn messages
if(isset($_GET["grnote"])){
  if($_GET["grnote"]=="success"){
    $grn=$_GET["grn"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Goods Received Note Report&nbsp;<?=$grn?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["grnote"]=="fail"){
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
    $rel=$_GET["relno"];
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
    $numb=$_GET["valNo"];
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
    $numb=$_GET["salNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Sales Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
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

//batch Report messages
if(isset($_GET["batch"])){
  if($_GET["batch"]=="success"){
    $numb=$_GET["batchNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Batch Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["batch"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//hull Report messages
if(isset($_GET["hull"])){
  if($_GET["hull"]=="success"){
    $numb=$_GET["hullNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Hulling Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["hull"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//dry Report messages
if(isset($_GET["dry"])){
  if($_GET["dry"]=="success"){
    $numb=$_GET["dryNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Drying Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["dry"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//transfer Report messages
if(isset($_GET["transfer"])){
  if($_GET["transfer"]=="success"){
    $numb=$_GET["transNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Transfer Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["transfer"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//bulk Report messages
if(isset($_GET["bulk"])){
  if($_GET["bulk"]=="success"){
    $numb=$_GET["bulkNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Bulk Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["bulk"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//adjustment Report messages
if(isset($_GET["adjust"])){
  if($_GET["adjust"]=="success"){
    $numb=$_GET["adjustNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Stock Adjustment Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["adjust"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//stock counting Report messages
if(isset($_GET["count"])){
  if($_GET["count"]=="success"){
    $numb=$_GET["countNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Stock count Report &nbsp;<?=$numb?> &nbsp;Verified Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["count"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform verification task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}
