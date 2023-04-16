<?php $pageTitle="Valuation Report"; ?>
<?php include_once('../forms/header.php'); 
include "../connection/valuationVariables.php";
?>
<form id="valuationForm" name="valuationForm" class="regularForm" style="height:fit-content; width: 900px" method="POST" action="../connection/valuation.php">
    <h3 class="formHeading">VALUATION REPORT</h3>
    <?php
     include "../alerts/message.php";
    ?>
    <div class="container">
        <div class="row" style="margin-left: 65%;">
            <div class="col-md-6" style="display:grid; margin-top:15px">
                <label for="valuationNumber" style="text-align: right;">Valuation No.:</label>
                <label for="valuationDate" style="text-align: right; margin-top:5px">Date:</label>
                <label for="batchNo" style="text-align: right; margin-top:5px">Batch No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" id="valuationNumber" name="valuationNumber" class="shortInput" readonly value="<?=$valuationNumber?>"
                style="width: 100px; text-align: center;">
                <input type="date" id="valuationDate" name="valuationDate" value="<?=$valDate?>" class="shortInput" style="width: 100px; text-align: center;"
                onchange="getFx(this.value)"><br>
                <input type="number" id="batchNo" name="batchNo" class="shortInput" value="<?=$batcNo?>" style="width: 100px; text-align: center;"
                onchange="updateOrder(this.value)">
            </div>
        </div>
    <div>
        <br>
        <?php include("../forms/customerSelector.php") ?>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <label for="contractAllocation">Contract Allocation :</label>
                    <select id="contractAllocation" name="contractAllocation" class="shortInput" style="width: 200px;">
                        <option value="1">Specified Contract</option>
                        <option value="0">Open Market</option>
                    </select>
                </div>
            </div>
        </div>
    <div id="ajaxDiv" style="display: none;"></div>
    
        <table id="valuationsTable">
            <tr>
                <th colspan="8" style="text-align: center;">VALUATION SCHEDULE</th>
            </tr>
            <tr>
                <td>Kibooko Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="" id="kibookoQty" name="kibookoQty" required class="tblNum"></td>
                <td colspan="3">FAQ Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="<?=$inputQty?>" id="FAQQty" name="FAQQty" required class="tblNum" onchange="captureQty()"></td>
            </tr>
            <tr>
                <td>Exchange Rate</td>
                <td colspan="2"><input type="number" value="<?= $fxRate?>" id="exchangeRate" name="exchangeRate" class="tblNum" required onchange="captureQty()"></td>
                <td colspan="5">Market facilitator and owner settlement rate</td>
                
            </tr>
            <tr>
                <th style="width: 250px;">Grade/Screen</th>
                <th style="width: 60px;">Actual Yield (%)</th>
                <th style="width: 80px;">QTY (Kg)</th>
                <th style="width: 60px;">Price (US$)/Kg</th>
                <th style="width: 60px;">Price (Cts/lb)</th>
                <th style="width: 100px;">Price (Ugx/Kg)</th>
                <th style="width: 100px;">Amount (US$)</th>
                <th style="width: 120px;">Amount (UGX)</th>
            </tr>
            <?php valEditDetails() ?>
            <tr>
                <th>Actual Total Value Before Costs</th>
                <td><input type="number" value="<?=$ttYield?>" id="totalYield" readonly name="totalYield" class="tblNum"></td>
                <td><input type="number" value="<?=$ttQty?>" id="totalQty" readonly name="totalQty" class="tblNum"></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="number" value="<?=$ttUsdAmt?>" id="grandTotaltUs" readonly name="grandTotaltUs" class="tblNum"></td>
                <td><input type="number" value="<?=$ttUgxAmt?>" id="grandTotaltUgx" readonly name="grandTotaltUgx" class="tblNum"></td>
            </tr>
            <tr>
                <th>Less Costs</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><input type="text" value="Costs:" id="costsDetails" name="costsDetails" class="tableInput" 
                style="text-align: left;" placeholder="Enter description of costs..."></td>
                
                <td><input type="number" value="<?=$valCostsUsd?>" id="totalCostsUsd" readonly name="totalCostsUsd" class="tblNum"></td>
                <td><input type="number" value="<?=$valCosts?>" id="totalCostsUgx" name="totalCostsUgx" class="tblNum"></td>
            </tr>
            <tr>
                <th colspan="6">Sub-total Costs</th>
                
                <td><input type="number" value="<?=$valCostsUsd?>" id="subTotalCostsUsd" readonly name="subTotalCostsUsd" class="tblNum"></td>
                <td><input type="number" value="<?=$valCosts?>" id="subTotalCostsUgx" readonly name="subTotalCostsUgx" class="tblNum"></td>
            </tr>
            <tr>
                <th colspan="6">Total Value after Costs</th>
                
                <td><input type="number" value="<?=$ttUsdAmt-$valCostsUsd?>" id="totalValueUsd" readonly name="totalValueUsd" class="tblNum"></td>
                <td><input type="number" value="<?=$ttUgxAmt-$valCosts?>" id="totalValueUgx" readonly name="totalValueUgx" class="tblNum"></td>
            </tr>
            
        </table>
        <p id="qtyCheck" style="color:red; display:none">Total items quantity must not exceed the base quantity and must not be 0!</p>
    </div>
    <?php submitButton("Modify", "submit", "btnsubmit"); ?>
</form>
<?php include_once('../forms/footer.php');?>
<!-- summarizing valuation info -->
<script>
    
    
</script>
<!-- <script src=".\ASSETS\SCRIPTS\valuationJavaScript.js"></script> -->
<script src="../assets/js/valuationJavaScript.js"></script>

