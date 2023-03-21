<?php $pageTitle="Contract Offer";
include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
?>
<form class="regularForm" style="width: 800px; height:fit-content">
    <h3 class="formHeading">New Contract Offer</h3>
    <div style="margin-left: 70%">
        <label for="batchReportNumber">Contract No.:</label>
        <?php
            $newBatchNo = nextDocNumber("batch_reports_summary", "batch_report_no", "BR");
            echo '<label id="batchReportNumber" class="shortInput" name="batchReportNumber">'.$newBatchNo .'</label>'.'<br>';
        ?>
        <label for="date">Date</label>
        <input type="date" id="date" class="shortInput" name="date" value="<?= $today ?>"><br>
        
        <br>
    </div>
    <?php include "../forms/customerSelector.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <label for="reference">Reference</label><br>
                <input type="text" id="reference" name="reference" class="shortInput" style="width: 200px;">
            </div>
            <div class="col-sm-4">
                <label for="currency">Currency</label><br>
                <select type="text" id="currency" name="currency" class="shortInput" style="width: 150px;">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="UGX">UGX</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="incoterms">Incoterms</label><br>
                <select type="text" id="incoterms" name="incoterms" class="shortInput" style="width: 150px;">
                    <option value="FOB">FOB</option>
                    <option value="FOT">FOT</option>
                    <option value="Ex-Warehouse">Ex-Warehouse</option>
                </select>
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
                <th style="width: 80px;">Price</th>
                <th style="width: 100px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($x=1;$x<=6;$x++){
                ?>
                <tr>
                    
                    <td><?=$x?></td>
                    <td><input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px;"></td>
                    <td>
                        <div id="<?='item'.$x.'Field'?>" style="display: grid;" class="itemName">
                            <input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="itmNameInput">
                            <input type="text" value="" id="<?='item'.$x.'Name'?>" name="item'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">
                            <select id="<?='item'.$x.'Select'?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">
                                <?php CoffeeGrades();?>
                            </select>
                        </div>
                    </td>
                    <td><input type="number" value="" id="<?='item'.$x.'Code'?>"  name="<?='item'.$x.'Code'?>" class="itmNameInput"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Code'?>"  name="<?='item'.$x.'Code'?>" class="itmNameInput"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="itmNameInput"></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="4">Total</th>
                <th id="totalCurrency"></th>
                <td><input type="number" value="" id="total" readonly name="total" class="itmNameInput"></td>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <label for="region">Continent</label><br>
                <select type="text" id="continent" name="continent" class="longInputField" onchange="getCountry()" style="width: 150px;">
                    <option value="Africa">Africa</option>
                    <option value="Europe">Europe</option>
                    <option value="North America">North America</option>
                    <option value="Asia">Asia</option>
                    <option value="South America">South America</option>
                    <option value="South America">Australia</option>
                </select>
            </div>
            <div class="col-sm-5">
                <label for="country">Country</label><br>
                <select type="text" id="country" name="country" class="longInputField">
                </select>
            </div>
            <div class="col-sm-4">
                <label for="shipdDate">Shipment Date</label><br>
                <input type="date" value="" id="shipdDate" name="shipdDate"  name="total" class="shortInput" style="width: 150px;">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12">
                <label for="sourcing" >Sourcing Actions</label>
                <input type="text" id="sourcing" name="sourcing" class="shortInput" style="width: 500px;"><br>
                <label for="financing" >Financing Source</label>
                <input type="text" id="financing" name="financing" class="shortInput" style="width: 500px;">
            </div>
        </div>
    </div>


    <?php submitButton("Submit", "submit", "btnsubmit") ?>
</form>
<?php include "../forms/footer.php" ?>
<script>
    checkCurrency();
    function checkCurrency(){
        var selCurrency = document.getElementById("currency").value;
        document.getElementById("totalCurrency").innerText=selCurrency;
    }
    
</script>