<?php $pageTitle="Pre Offloading Sample"; ?>
<?php
include("../private/database.php");
include("../forms/header.php");
$sampNo = nextDocNumber("pre_quality", "assess_no", "POS");
?>
<form class="regularForm" method="post" action="../connection/preOffloadingSample.php" style="height:fit-content">
<?php //include "../templates/preoffloadingSample.php" ?>
<h3 class="formHeading">Pre Offloading Sample</h3>
<?php
    include "../alerts/message.php";
?>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="sampNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Sample No:</label>
    <input type="text" class="shortInput" id="sampNo" name="sampNo" value="<?= $sampNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="sampDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="sampDate" name="sampDate" value="<?= $today ?>" style="grid-column: 2; grid-row: 2">
</div>
<?php require("../forms/customerSelector.php");?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <label for="coffType">Coffee Type</label><br>
            <select id="type" name="coffeetype" class="shortInput"
                onchange="itemFilterOptions('category',this.value, 'typeCat')">
                <option value="all">All</option>
                <option value="Arabica">Arabica</option>
                <option value="Robusta">Robusta</option>
            </select><br>
        </div>
        <div class="col-sm-4">
            <label for="category">Type Category:</label><br>
            <select id="category" name="category" class="shortInput" style="width: 150px;"
                onchange="itemFilterOptions('gradeId',this.value, 'grades')">
                <option value="all">All</option>
            </select><br>
        </div>
        <div class="col-sm-4">
            <label for="gradeId">Grade:</label><br>
            <select id="gradeId" name="coffeegrades" class="shortInput" style="width: 250px;">
                <option value="all">All</option>
                
            </select><br>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-4">
            <label for="sampBags">Sampled Bags</label><br>
            <input type="number" id="sampBags" name="sampBags" value="<?=$sampBags?>" class="shortInput" style="width: 100px;" min="1">
        </div>
        <div class="col-sm-4">
            <label for="sampKg">Picked Weight (Kg)</label><br>
            <input type="number" id="sampKg" name="sampKg" value="<?=$sampMC?>" class="shortInput" style="width: 100px;" step="0.01">
        </div>
        <div class="col-sm-4">
            <label for="sampMC">Moisture (%)</label><br>
            <input type="number" id="sampMC" name="sampMC" value="<?=$sampMC?>" class="shortInput" style="width: 100px;" min="10" step="0.01">
        </div>
    </div><br><br>
    <div class="row">
        <div class="col-sm-12">
            <label style="margin-right: 20px;">Deceision:</label>
            <label style="color:green"><input type="radio" name="decision" value="Accepted" required>Accept</label>
            <label style="color:red"><input type="radio" name="decision" value="Rejected" style="margin-left: 50px;" required>Reject</label>
        </div>
    </div>
</div>
<div style="margin-top: 20px;">
    <label for="customer" class="form-label">Quality Remarks:</label>
    <input class="form-control" id="remarks" name="remarks" value="<?=$quality_remarks?>" placeholder="quality remarks" rows="3">
</div>
<?php include "users.php" ?>
<?php submitButton("Submit", "submit", "btnsubmit") ?>
<script src="../assets/js/itemsFilter.js"></script>

</form>
<?php include_once ("../forms/footer.php")?>

<script>
     $("#typeName").hide();
     $("#typCatName").hide();
     $("#gradeName").hide();
     $("#usersDiv").hide();

     function getGrades(str){
      if (str == " ") {
          return;
      } 
      const xhttp = new XMLHttpRequest();
      // Updating grades based on coffee type
      xhttp.onload = function() {
          document.getElementById("gradeId").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/grnAjax.php?q="+str);
      xhttp.send();
    }   
</script>