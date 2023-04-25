<?php $pageTitle="Sales Report";
include_once('../forms/header.php');
include("../connection/salesReportVariables.php");

?>

<form class="regularForm" style="height: fit-content; width:900px" method="POST" action="../connection/salesreport.php">
    <h2 class="formHeading">SALES REPORT</h2>
        <?php
            include "../alerts/message.php";
        ?>
    <div style="margin-left: 70%;">
        <label for="salesReportNumber" id="salesReportNumberLabel" class="salesReportLabel" >Sales No.:</label>
        <input type="text" id="salesReportNumber" readonly class="shortInput" style="width: 100px; text-align: center;"
        value="<?=$salesNo?>"><br>

        <label for="salesReportDate" id="salesReportNumberLabel" class="salesReportLabel" >Date:</label>
        <input type="date" id="salesReportDate" name="salesReportDate" class="shortInput" value="<?=$salDate?>" style="width: 100px; text-align: center;" required><br>

        <label for="exchangeRate" class="salesReportLabel" >Exchange Rate:</label>
        <input type="number" value="<?=$salFx?>" id="exchangeRate" name="exchangeRate" class="longInputField" placeholder="Ex.Rate" step="0.0001" style="width: 90px; margin-right: 0px;" required>
      
    </div>
    <div id="ajaxDiv" style="display: none;"> </div>
    <div>
        <?php include "../forms/customerSelector.php"; ?>
        <label for="salesReportCategory" id="salesReportBuyerLabel" class="salesReportLabel">Category:</label>
        <select id="salesReportCategory" class="longInputField" name="salesReportCategory" style="width: 100px;" required>
            <option value="Local">Local Sale</option>
            <option value="Export">Export</option>
        </select>

        <label for="salesReportCurrency" class="salesReportLabel">Currency:</label>
        <select id="salesReportCurrency" class="longInputField" name="salesReportCurrency" style="width: 100px;">
            <option value="UGX">UGX</option>
            <option value="USD">USD</option>
            <!-- <option value="EUR">EUR</option> -->
        </select>
    </div>
    <div>
        <table>
            <tr>
                <th style="width: 355px;">Grade</th>
                <th style="width: 80px;">QTY (Kgs)</th>
                <th style="width: 100px; display:none">Batch Number</th>
                <th style="width: 80px;">Price (USD/Kg)</th>
                <th style="width: 90px;">Price (UGX/Kg)</th>
                <th style="width: 100px;">Amount (USD)</th>
                <th style="width: 100px;">Amount (UGX)</th>
            </tr>
            <?php editSalesItems(); ?>
        </table>
        <?php documentNotes("700px") ?>
        
    </div>

    <?php submitButton("Modify", "submit", "btnsubmit") ?>
    
</form>
<?php   include_once('../forms/footer.php'); ?>
<script>
       
</script>
<script src="../assets/js/salesreport.js"></script>
<!-- <script src="../assets/js/salesreport.js"></script> -->

