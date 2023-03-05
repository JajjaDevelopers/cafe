<h3 id="batchReportHeading" class="formHeading">Production Report</h3>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<?php
    include "../alerts/message.php";
    ?>
<div id="ajaxDiv1" style="display: none">
    
</div>
<div>
    <div style="margin-left: 70%">
        <label for="batchReportNumber">Batch No.:</label>
        <input id="batchReportNumber" class="shortInput" name="batchReportNumber" readonly value="<?=$batchRepNo?>"><br>
        <label for="batchOrderNumber">Order No.:</label>
        <input type="number" id="batchOrderNumber" class="shortInput" readonly name="batchOrderNumber" value="<?= $batchOrderNumber ?>"><br>
        <label for="batchReportDate">Date:</label>
        <input type="date" id="batchReportDate" class="shortInput" readonly name="batchReportDate" value="<?= $fmDate ?>">
        <br>
    </div>
    <div style="padding-top: 50px; margin-bottom: 5px; ">
        <?php
        //customerFill();
        include "../forms/customerSelector.php";
        ?>
        <label for="batchReportOfftaker">Offtaker</label>
        <input id="offTakerName" class="shortInput" value="<?=$offTaker?>" readonly name="offTakerName">
    </div>
    
</div>
<div>
    
    <div style="display: grid;">
        <table id="batchInputTable" style="width: 300px; grid-row: 1; grid-column: 1;">
            <tr>
                <th>INPUT:</th>
                <th style="width: 100px;">KGs</th>
            </tr>
            <tr>
                <td>INPUT <?= $inputGradeName?></td>
                <td><input type="number" id="inputQty" name="inputQty" class="tblNum" readonly value="<?= $netInputQty ?>"></td>
            </tr>
            <tr>
                <td>Add Spill.Priv.Batch</td>
                <td><input type="number" id="addSpillQty" readonly name="addSpillQty" class="tblNum"></td>
            </tr>
            <tr>
                <td>Less Spill C/F</td>
                <td><input type="number" id="lessSpillQty" name="lessSpillQty" readonly class="tblNum"></td>
            </tr>
            <tr>
                <td>NET INPUT</td>
                <td><input type="number" id="netInputQty" readonly readonly name="netInputQty" class="tblNum" value="<?= $netInputQty ?>"></td>
            </tr>
        </table>
        <div style="display: inline-block; grid-row: 1; grid-column: 2;">
            Avg. MC In: <input type="number" id="batchReportMcIn" class="shortInput" readonly name="batchReportMcIn" style="width: 60px;"
            readonly value="<?= $inputMc ?>">
            Avg. MC Out: <input type="doubleval" id="batchReportMcIn" class="shortInput" readonly name="batchReportMcOut" style="width: 60px;"
            value="<?= $outputMc ?>"><br>
            Remarks:<br><input name="remarks" value="<?=$notes?>" style="width: 300px; padding: 3px " readonly placeholder="Any comment or remarks">
        </div>
    </div>
    
    <h5 style="margin-top: 20px;">RETURNS</h5>
    <div style="display: grid;">
        <div style="grid-column:1; grid-row:1">
            <?php 
                getGrades($typeCategory, "HIGH", "", "high", "High Grades"); echo '<br>'; //HIgh grades
                getGrades($typeCategory, "LOW", "", "low", "Low Grades"); echo '<br>';//Low grades
                getGrades($typeCategory, "BLACKS", "", "blacks", "Color Sorter Rejects"); echo '<br>';//Blacks beans
                getGrades("NONE", "WASTES", "", "wastes", "Wastes"); echo '<br>';//Wastes
                getGrades("NONE", "OTHER LOSSES", "", "losses", "Other Losses"); echo '<br>';//Other Losses 
            ?>
        </div>
        <div style="grid-column:2; grid-row:1">
            <label>Color Sorted</label><br>
            <input type="number" id="colorSortedInput" name="colorSortedInput" value="<?=$colSorted?>" class="shortInput" readonly placeholder="color sorted" step="0.01">
        </div>
    </div>
    <table style="margin-top: 5px;">
        <tr>
            <th class="batchItemLabel">OVERALL OUT-TURN</th>
            <td class="batchItemBags"><input type="number" id="overallTotalBags" readonly name="overallTotalBags" value="<?=round($overallTotal/60,0)?>" class="tblNum"></td>
            <td class="batchItemKgs"><input type="number" id="overallTotalQty" readonly name="overallTotalQty" value="<?=round($overallTotal,2)?>" class="tblNum"></td>
            <td class="batchItemPercent"><input type="number" id="overallTotalPer" readonly name="overallTotalPer" value="<?=round($overallTotal*100/$netInputQty,2)?>" class="tblNum"></td>
        </tr>
    </table>
</div>
<div>
    <h6 style="margin-top: 5px;">BATCH RECEIPTS SUMMARY (INPUT)</h6>
    <table>
        <tr>
            <th style="width: 80px;">DATE</th>
            <th style="width: 50px;">GRN</th>
            <th style="width: 50px;">MC</th>
            <th class="batchItemKgs">KGS</th>
            <th class="batchItemLabel">ORIGIN / CLIENT</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>

<!-- <script>
    // get grade Ids    
    function categoryItemsFreq(){
        var coffeeType = "<?//= $coffeeType?>";
        
        const xhttp = new XMLHttpRequest();
        
        xhttp.onload = function() {
            var itemFrequency = JSON.parse(this.responseText);
        }
        xhttp.open("GET", "../ajax/batchReportOrdersAjax.php?q="+coffeeType);
        xhttp.send();
    }
    


    // Get oder input details
    document.getElementById("batchOrderNumber").addEventListener('change', updateOrder);
    function updateOrder(){
        var str = document.getElementById("batchOrderNumber").value;
        if (str == "") {
            document.getElementById("inputQty").setAttribute('value', '');
            document.getElementById("batchReportMcIn").setAttribute('value', '');
            return;
        } 
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("ajaxDiv1").innerHTML = this.responseText;
                    
            // set input qty
            var ajaxInputQty = document.getElementById("orderAjaxQty").value;
            document.getElementById("inputQty").setAttribute('value', ajaxInputQty);
            var inputQty = Number(document.getElementById("inputQty").value);
            var addSpill = Number(document.getElementById("addSpillQty").value);
            var lessSpill = Number(document.getElementById("lessSpillQty").value);
            document.getElementById("netInputQty").setAttribute('value', (inputQty + addSpill - lessSpill));
            
            var ajaxMcIn = document.getElementById("orderAjaxMc").value;
            document.getElementById("batchReportMcIn").setAttribute('value', ajaxMcIn);
            document.getElementById("batchReportMcOut").setAttribute('value', ajaxMcIn);

            var ajaxCoffeeType = document.getElementById("orderAjaxCoffeeType").value;
            document.getElementById("batchReportCoffeeType").setAttribute('value', ajaxCoffeeType);

        }
        xhttp.open("GET", "../ajax/batchReportInputAjax.php?q="+str);
        xhttp.send();
        getBatchReturns(str);
    }


    //Batch returns
    function getBatchReturns(no){
        
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("batchReturnsAjax").innerHTML = this.responseText;

            var receivedJson = document.getElementById("allIdsJson").innerHTML;
            var gradeLists = JSON.parse(receivedJson);
            document.getElementById("checkDiv").innerHTML = gradeLists[0][0];
        }
        xhttp.open("GET", "../ajax/batchReportReturnsAjax.php?q="+no);
        xhttp.send();
    }

</script>

<script src="../assets/js/batchReport.js"></script> -->


