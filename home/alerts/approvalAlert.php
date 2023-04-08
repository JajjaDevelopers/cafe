<?php
//grn messages
if(isset($_GET["grnap"])){
  if($_GET["grnap"]=="success"){
    $grn="GRN-".$_GET["grnNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Goods Received Note Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["grnap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//batch messages
if(isset($_GET["batchap"])){
  if($_GET["batchap"]=="success"){
    $grn="BRN-".$_GET["batchNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Batch Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["batchap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//release messages
if(isset($_GET["releaseap"])){
  if($_GET["releaseap"]=="success"){
    $grn="RLS-".$_GET["valNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Release Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["releaseap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//valuation messages
if(isset($_GET["valap"])){
  if($_GET["valap"]=="success"){
    $grn=$_GET["valNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Valuation Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["valap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//sales messages
if(isset($_GET["salap"])){
  if($_GET["salap"]=="success"){
    $grn=$_GET["salNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Sales Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["salap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//hull messages
if(isset($_GET["hullap"])){
  if($_GET["hullap"]=="success"){
    $grn=$_GET["hullNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Hull Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["hullap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//dry messages
if(isset($_GET["dryap"])){
  if($_GET["dryap"]=="success"){
    $grn=$_GET["dryNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Dry Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["dryap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//trans messages
if(isset($_GET["transap"])){
  if($_GET["transap"]=="success"){
    $grn=$_GET["transNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Transfer Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["transap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//bulk messages
if(isset($_GET["bulkap"])){
  if($_GET["bulkap"]=="success"){
    $grn=$_GET["bulkNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Bulk Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["bulkap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//stock adjust messages
if(isset($_GET["adjustap"])){
  if($_GET["adjustap"]=="success"){
    $grn=$_GET["adjustNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Stock Adjustment Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["adjustap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//stock count messages
if(isset($_GET["countap"])){
  if($_GET["countap"]=="success"){
    $grn=$_GET["countNo"];
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Stock Count Report&nbsp;<?=$grn?> &nbsp;Approved Successfully!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["countap"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}

//activity sheet
if(isset($_GET["apprStatus"])){
  if($_GET["apprStatus"]=="success"){
    $msg=$_GET["msg"];
    ?>
    <div class="alert alert-success alert-dismissible rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium"><?=$msg?></p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }elseif($_GET["apprStatus"]=="fail"){
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:brown">
        <p class="text-center text-warning" style="font-size:medium">You are not authorised to perform approval task!</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }
}