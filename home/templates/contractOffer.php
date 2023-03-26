<div style="margin-left: 70%">
    <label for="batchReportNumber">Contract No.:</label>
    <label id="batchReportNumber" class="shortInput" name="batchReportNumber"><?=$newBatchNo ?></label><br>
    <label for="date">Date</label>
    <input type="date" id="date" class="shortInput" name="date" readonly value="<?= $contDate ?>"><br>
    
    <br>
</div>
<?php include "../forms/customerSelector.php"; ?>
<script>document.getElementById("salesReportBuyer").style.display="none";</script>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <label for="reference">Reference</label><br>
            <input type="text" id="reference" name="reference" value="<?= $contRef ?>" readonly class="shortInput" style="width: 200px;">
        </div>
        <div class="col-sm-4">
            <label for="currency">Currency</label><br>
            <input type="text" id="currency" name="currency" value="<?= $currency ?>" readonly class="shortInput" style="width: 150px;" onchange="checkCurrency()">
        </div>
        <div class="col-sm-4">
            <label for="incoterms">Incoterms</label><br>
            <input type="text" id="incoterms" name="incoterms" value="<?= $terms ?>" readonly class="shortInput" style="width: 150px;">
        </div>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th style="width: 20px;">#</th>
            <th >Item Code</th>
            <th style="width: 300px;">Item Description</th>
            <th style="width: 80px;">Qty (Kg)</th>
            <th style="width: 80px;"><label id="pxCurrency"><?="Price "?></label></th>
            <th style="width: 100px;">Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        contractsOfferTable();
        ?>
        <tr>
            <th colspan="3">Total</th>
            <td><input type="text" value="<?=num(($ttQty))?>" id="totalQty" readonly name="totalQty" class="tblNum"></td>
            <th id="totalCurrency"></th>
            <td><input type="text" value="<?=num($ttValue)?>" id="total" readonly name="total" class="tblNum"></td>
        </tr>
    </tbody>
</table>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <label for="region">Continent</label><br>
            <input type="text" id="continent" name="continent" value="<?= $continent ?>" readonly class="longInputField" style="width: 150px;">
        </div>
        <div class="col-sm-5">
            <label for="country">Country</label><br>
            <input type="text" id="country" name="country" value="<?= $countryName ?>" readonly class="longInputField">
        </div>
        <div class="col-sm-4">
            <label for="shipdDate">Shipment Date</label><br>
            <input type="text" id="shipdDate" name="shipdDate" readonly value="<?= $shipDate ?>" class="shortInput" style="width: 150px;">
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-6">
            <label for="sourcing" >Sourcing Actions</label><br>
            <input type="text" id="sourcing" name="sourcing" readonly value="<?= $sourcing ?>" class="shortInput" style="width: 350px;">
        </div>
        <div class="col-sm-6">
            <label for="financing" >Financing Source</label><br>
            <input type="text" id="financing" name="financing" readonly value="<?= $financing ?>" class="shortInput" style="width: 350px;">
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12">
            <label for="contractSatus">Contract Status</label><br>
            <input type="text" id="contractSatus" name="contractSatus" value="<?= $status ?>" readonly class="shortInput" style="width: 200px; background-color:brown; color:white">
        </div>
    </div>
</div>


