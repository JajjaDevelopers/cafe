<?php $pageTitle="Contract Offer";
include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
$newBatchNo = nextDocNumber("contracts_summary", "contract_no", "CRT");
?>
<form class="regularForm" method="post" action="../connection/contractOffer.php" style="width: 800px; height:fit-content">
    <h3 class="formHeading">Contract Offer</h3>
    <div style="margin-left: 70%">
        <label for="batchReportNumber">Contract No.:</label>
        <label id="batchReportNumber" class="shortInput" name="batchReportNumber"><?=$newBatchNo ?></label><br>
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
                <select type="text" id="currency" name="currency" class="shortInput" style="width: 150px;" onchange="checkCurrency()">
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
                <th style="width: 80px;"><label id="pxCurrency"><?="Price "?></label></th>
                <th style="width: 100px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($x=1;$x<=6;$x++){ //check the length of pick item function
                ?>
                <tr>
                    <td><?=$x?></td>
                    <td><input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px;"></td>
                    <td>
                        <div id="<?='item'.$x.'Field'?>" style="display: grid;">
                            <input type="text" value="" id="<?='item'.$x.'Name'?>" readonly name="<?='item'.$x.'Name'?>" class="itmNameInput" style="grid-column: 1; width: 270px">
                            <select id="<?='item'.$x.'Select'?>" style="margin: 0px; width: 20px; grid-column: 2;" class="itemSelect" onchange="pickItem()">
                                <?php CoffeeGrades();?>
                            </select>
                        </div>
                    </td>
                    <td><input type="number" value="" id="<?='item'.$x.'Qty'?>"  name="<?='item'.$x.'Qty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Price'?>"  name="<?='item'.$x.'Price'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'AMount'?>" readonly name="<?='item'.$x.'AMount'?>" step="0.001" class="tblNum"></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="3">Total</th>
                <td><input type="number" value="" id="totalQty" readonly name="totalQty" class="tblNum"></td>
                <th id="totalCurrency"></th>
                <td><input type="number" value="" id="total" readonly name="total" class="tblNum"></td>
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
                    <option value="Australia">Australia</option>
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
        document.getElementById("pxCurrency").innerText="Price ("+selCurrency+"/Kg)";
    }

    function pickItem(){
        for (var x=1;x<=6;x++){
            var selectedItem = document.getElementById('item'+x+'Select').value;
            document.getElementById('item'+x+'Code').setAttribute("value", selectedItem.slice(0,6));
            document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(8));
        }
    }

    function updateInput(){
        var ttAmount=0;
        var ttQty=0;
        for (var x=1;x<=6;x++){
            var qty = Number(document.getElementById('item'+x+'Qty').value);
            ttQty+=qty;
            var price = Number(document.getElementById('item'+x+'Price').value);
            var amount = qty*price;
            ttAmount+=amount;
            document.getElementById('item'+x+'AMount').setAttribute("value", amount);
        }
        document.getElementById("totalQty").setAttribute("value", ttQty);
        document.getElementById("total").setAttribute("value", ttAmount);
    }
    
</script>
<script src="../assets/js/locations.js"></script>