<h3 class="formHeading">Pre Offloading Sample</h3>
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
            <input class="shortInput" value="<?=$coffee_type?>" id="typeName">
            <select id="type" name="coffeetype" class="shortInput"
                onchange="itemFilterOptions('category',this.value, 'typeCat')">
                <option value="all">All</option>
                <option value="Arabica">Arabica</option>
                <option value="Robusta">Robusta</option>
            </select><br>
        </div>
        <div class="col-sm-4">
            <label for="category">Type Category:</label><br>
            <input class="shortInput" value="<?=$type_category?>" id="typCatName" name="typCatName" style="width: 150px;" readonly>
            <select id="category" name="category" class="shortInput" style="width: 150px;"
                onchange="itemFilterOptions('gradeId',this.value, 'grades')">
                <option value="all">All</option>
                
            </select><br>
        </div>
        <div class="col-sm-4">
            <label for="gradeId">Grade:</label><br>
            <input id="gradeName" value="<?=$grade_name?>" class="shortInput" style="width: 250px;">
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
            <label for="sampMC">Weight (Kg)</label><br>
            <input type="number" id="sampMC" name="sampMC" value="<?=$sampMC?>" class="shortInput" style="width: 100px;" min="10" step="0.01">
        </div>
        <div class="col-sm-4">
            <label for="sampMC">Moisture (%)</label><br>
            <input type="number" id="sampMC" name="sampMC" value="<?=$sampMC?>" class="shortInput" style="width: 100px;" min="10" step="0.01">
        </div>
    </div>
</div>
<div style="margin-top: 20px;">
    <label for="customer" class="form-label">Quality Remarks:</label>
    <input class="form-control" id="remarks" name="remarks" value="<?=$quality_remarks?>" placeholder="quality remarks" rows="3">
</div>
<div id="usersDiv" class="container">
  <div class="row">
    <div class="col-md-4">
        <?= "Prepared By: ".$prepBy?><br>
        <?= "Verified By: ".$verpBy?><br>
        <?= "Approved By: ".$apprpBy?>
    </div>
    <div class="col-md-8">
        <?= "Date: ".$prep_time ?><br>
        <?= "Date: ".$ver_time ?><br>
        <?= "Date: ".$appr_time ?>
    </div>
  </div>
</div>
<script src="../assets/js/itemsFilter.js"></script>