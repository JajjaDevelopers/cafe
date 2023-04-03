<h2 class="formHeading">SALES REPORT</h2>
    <?php
        //include "../alerts/message.php";
    ?>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<div>
    <div style="display: grid;">
        <div style="padding-left:550px; grid-column:1; grid-row:1">
            <input name="salNo" value="<?=$salNo?>" readonly style="display: none;">
            <label for="salesReportNumber" id="salesReportNumberLabel" class="salesReportLabel" >Sales No.:</label><br>
            <label for="salesReportDate" id="salesReportNumberLabel" class="salesReportLabel" >Date:</label><br>
            <label for="exchangeRate" class="salesReportLabel" >Exchange Rate:</label>
        </div>
        <div style=" grid-column:2; grid-row:1">
            <input type="text" id="salesReportNumber" readonly style="width: 100px; text-align: left; border: 0px; background-color:inherit"
            value="<?=$salesNo?>"><br>
            <input type="date" id="salesReportDate" name="salesReportDate" readonly value="<?=$salDate?>" style="width: 100px; text-align: left; border: 0px;background-color:inherit"><br>
            <input type="text" id="exchangeRate" name="exchangeRate" readonly value="<?=num($salFx)?>" style="width: 100px; border: 0px; background-color:inherit">
        </div>
    </div>
</div>
<div style="margin-left: 60%;">
    
    

    
    

    
    
    
</div>
<div id="ajaxDiv" style="display: none;">
</div>
    <?php include("../forms/customerSelector.php") ?>
    <br>
<div>
    <!-- <table>
        <tr>
            <th style="width: 355px;">Grade</th>
            <th style="width: 80px;">QTY (Kgs)</th>
            <th style="width: 100px;">Batch Number</th>
            <th style="width: 70px;">Price (USD/Kg)</th>
            <th style="width: 70px;">Price (UGX/Kg)</th>
            <th style="width: 100px;">Amount (USD)</th>
            <th style="width: 100px;">Amount (UGX)</th>
        </tr> -->
        <?php
        salesItemDetails();
        ?>
        
    <div style="max-height: 50px;">
        <label for="salesReportNotes">Comment:</label><br>
        <input id="salesReportNotes" name="salesReportNotes" value="<?=$salNotes?>" readonly class="shortInput" max="100" style="width: 700px;">
    </div> 
</div>

