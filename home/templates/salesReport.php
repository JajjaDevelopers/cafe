<h2 class="formHeading">SALES REPORT</h2>
    <?php
        //include "../alerts/message.php";
    ?>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<div style="margin-left: 60%;">
    <input name="salNo" value="<?=$salNo?>" readonly style="display: none;">
    <label for="salesReportNumber" id="salesReportNumberLabel" class="salesReportLabel" >Sales No.:</label>
    <input type="text" id="salesReportNumber" readonly class="shortInput" style="width: 100px; text-align: center;"
    value="<?=$salesNo?>"><br>

    <label for="salesReportDate" id="salesReportNumberLabel" class="salesReportLabel" >Date:</label>
    <input type="date" id="salesReportDate" name="salesReportDate" class="shortInput" value="<?=$salDate?>" style="width: 100px; text-align: center;"><br>

    <label for="exchangeRate" class="salesReportLabel" >Exchange Rate:</label>
    <input type="number" id="exchangeRate" name="exchangeRate" class="longInputField" value="<?=$salFx?>" style="width: 90px; margin-right: 0px;">
    
</div>
<div id="ajaxDiv" style="display: none;">
</div>
    <?php include("../forms/customerSelector.php") ?>
    <div>
<div class="container" style="margin-left: 0px;">
    <div class="row">
        <div class="col-xs-6">
            <label for="salesReportCategory">Category:</label><br>
            <input id="catName" style="width: 100px;" value="<?=$salCat?>" readonly class="shortInput">
            <select id="salesReportCategory" name="salesReportCategory" style="width: 100px;">
                <option value="Local">Local Sale</option>
                <option value="Export">Export</option>
            </select>
        </div>
        <div class="col-xs-6">
            <label for="salesReportCurrency">Currency:</label><br>
            <input id="currName" value="<?=$currency?>" readonly class="shortInput">
            <select id="salesReportCurrency" name="salesReportCurrency" style="width: 100px;">
                <option value="UGX">UGX</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select>
        </div>
    </div>
</div>
</div><br>
<div>
    <table>
        <tr>
            <th style="width: 355px;">Grade</th>
            <th style="width: 80px;">QTY (Kgs)</th>
            <th style="width: 100px;">Batch Number</th>
            <th style="width: 70px;">Price (USD/Kg)</th>
            <th style="width: 70px;">Price (UGX/Kg)</th>
            <th style="width: 100px;">Amount (USD)</th>
            <th style="width: 100px;">Amount (UGX)</th>
        </tr>
        <?php
        for ($i=1;$i<=10;$i++){
            ?>
        <tr>
            <td>
                <div id="item1Field" style="display: grid;" class="itemName">
                    <input type="text" value="" id="<?= 'item'.$i.'Code'?>" readonly name="<?= 'item'.$i.'Code'?>" class="itmNameInput" style="grid-column: 1; width: 60px; display:none">
                    <input type="text" value="" id="<?= 'item'.$i.'Name'?>" readonly name="<?= 'item'.$i.'Name'?>" class="itmNameInput" style="grid-column: 2; width: 330px">
                    <select id="<?= 'item'.$i.'Select'?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="setCodeAndName(this.id)">
                        <?php CoffeeGrades(); ?>
                    </select>
                </div>
            </td>
            <td><input type="number" value="" id="<?= 'item'.$i.'Qty'?>" name="<?= 'item'.$i.'Qty'?>" class="tblNum"></td>
            <td><input type="text" value="" id="<?= 'item'.$i.'Batch'?>" name="<?= 'item'.$i.'Batch'?>" class="tblNum"></td>
            <td><input type="number" value="" id="<?= 'item'.$i.'UsdPx'?>" name="<?= 'item'.$i.'UsdPx'?>" class="tblNum"></td>
            <td><input type="number" value="" id="<?= 'item'.$i.'UgxPx'?>" name="<?= 'item'.$i.'UgxPx'?>" class="tblNum"></td>
            <td><input type="number" value="" id="<?= 'item'.$i.'UsdAmount'?>" readonly name="<?= 'item'.$i.'UsdAmount'?>" class="tblNum"></td>
            <td><input type="number" value="" id="<?= 'item'.$i.'UgxAmount'?>" readonly name="<?= 'item'.$i.'UgxAmount'?>" class="tblNum"></td>
        </tr>
        <?php
        }
        ?>
        
        <tr>
            <th>Total</th>
            <th><input type="number" value="" id="totalQty" readonly name="totalQty" class="tableInput"></th>
            <th></th>
            <th></th>
            <th></th>
            <th><input type="number" value="" id="usdGrandTotal" readonly name="usdGrandTotal" class="tableInput"></th>
            <th><input type="number" value="" id="ugxGrandTotal" readonly name="ugxGrandTotal" class="tableInput"></th>
        </tr>
    </table>
    <div style="max-height: 50px;">
        <label for="salesReportNotes">Comment:</label><br>
        <input id="salesReportNotes" name="salesReportNotes" value="<?=$salNotes?>" class="shortInput" max="100" style="width: 700px;">
    </div> 
</div>

