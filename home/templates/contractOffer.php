<div style="margin-left: 70%">
        <label for="batchReportNumber">Offer No. :</label>
        <label id="offerNum" class="shortInput" name="offerNum"><?=$newBatchNo ?></label><br>
        <label for="date">Offer Date :</label>
        <input type="date" id="date" class="shortInput" name="date" value="<?= $today ?>"><br>
        <label for="contCategory">Category :</label>
        <input id="contCategory" class="shortInput" name="contCategory" readonly value="<?= $category ?>" style="width: 120px;">
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <label for="reference">Reference :</label>
                <input type="text" id="reference" name="reference" readonly value="<?=$contRef?>" class="shortInput" style="width: 200px;">
            </div>
        </div>
    </div>
<?php include "../forms/customerSelector.php"; ?>
<script>document.getElementById("salesReportBuyer").style.display="none";</script>
<div class="container">
        <div class="row">
            <div class="col-sm-2">
                <label for="contType">Contract Type:</label><br>
                <input type="text" id="contType" name="contType" readonly value="<?=$contType?>" class="shortInput" style="width: 100px;">
            </div>
            <div class="col-sm-2">
                <label for="incoterms">Incoterms</label><br>
                <input type="text" id="incoterms" name="incoterms" readonly value="<?=$terms?>" class="shortInput" style="width: 150px;">
            </div>
            <div class="col-sm-2">
                <label for="region">Destination</label><br>
                <input type="text" id="continent" name="continent" readonly value="<?=$continent?>" class="longInputField"style="width: 150px;">
            </div>
            <div class="col-sm-3">
                <label for="country">Country</label><br>
                <input type="text" id="country" name="country" readonly value="<?=$countryName?>" class="longInputField">
            </div>
            <div class="col-sm-3">
                <label for="country">Destination Port</label><br>
                <input type="text" id="port" name="port" readonly value="<?=$port?>" class="longInputField">
            </div>
        </div>
    </div>
    
        <?php
        contractsOfferTable();
        ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <label for="sourcing" >Sourcing Actions</label>
                <input type="text" id="sourcing" name="sourcing" readonly value="<?=$sourcing?>" class="shortInput" style="width: 500px;"><br>
                <label for="financing" >Financing Source</label>
                <input type="text" id="financing" name="financing" readonly value="<?=$financing?>" class="shortInput" style="width: 500px;">
            </div>
        </div><br>
        <?php terms();?>
    </div>

<script src="../assets/js/contractOfferTemp.js"></script>