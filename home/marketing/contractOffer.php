<?php $pageTitle="Contract Offer";
include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
$newBatchNo = nextDocNumber("contracts_summary", "contract_no", "COF");
?>
<form class="regularForm" method="post" action="../connection/contractOffer.php" style="width: 1000px; height:fit-content">
    <h3 class="formHeading">Contract Offer</h3>
    <div style="margin-left: 70%">
        <label for="batchReportNumber">Offer No.:</label>
        <label id="batchReportNumber" class="shortInput" name="batchReportNumber"><?=$newBatchNo ?></label><br>
        <label for="date">Date</label>
        <input type="date" id="date" class="shortInput" name="date" value="<?= $today ?>"><br>
        <label for="date">Category</label>
        <select type="date" id="date" class="shortInput" name="date" value="<?= $today ?>" style="width: 120px;">
            <option value="Conventional">Conventional</option>
            <option value="Specialty">Specialty</option>
            <option value="Fair Trade">Fair Trade</option>
            <option value="GI">GI</option>
        </select>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <label for="reference">Reference :</label>
                <input type="text" id="reference" name="reference" class="shortInput" style="width: 200px;">
            </div>
        </div>
    </div>
    <?php include "../forms/customerSelector.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <label for="currency">Currency</label><br>
                <select type="text" id="currency" name="currency" class="shortInput" style="width: 100px;" onchange="checkCurrency()">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="UGX">UGX</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="currency">Contract Type:</label><br>
                <select type="text" id="currency" name="currency" class="shortInput" style="width: 100px;" onchange="checkCurrency()">
                    <option value="Spot">Spot</option>
                    <option value="Forward">Forward</option>
                </select>
            </div>
            <div class="col-sm-6">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-3">
                <label for="incoterms">Incoterms</label><br>
                <select type="text" id="incoterms" name="incoterms" class="shortInput" style="width: 150px;">
                    <option value="FOB">FOB</option>
                    <option value="FOT">FOT</option>
                    <option value="Ex-Warehouse">Ex-Warehouse</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="region">Destination</label><br>
                <select type="text" id="continent" name="continent" class="longInputField" onchange="getCountry()" style="width: 150px;">
                    <option value="Africa">Africa</option>
                    <option value="Europe">Europe</option>
                    <option value="North America">North America</option>
                    <option value="Asia">Asia</option>
                    <option value="South America">South America</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="country">Country</label><br>
                <select type="text" id="country" name="country" class="longInputField">
                </select>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">#</th>
                <th style="width: 80px;">Item Code</th>
                <th style="width: 200px;">Item Description</th>
                <th style="width: 250px;">Quality Specifications</th>
                <th style="width: 80px;">Bags</th>
                <th style="width: 80px;">Qty (Kg)</th>
                <th style="width: 80px;"><label id="pxCurrency"><?="Bases Price "?></label></th>
                <th style="width: 80px;">GI Premium</th>
                <th style="width: 80px;">Social Premium</th>
                <th style="width: 80px;">Quality Premium</th>
                <th style="width: 100px;">Amount</th>
                <th style="width: 90px;">Shipment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($x=1;$x<=6;$x++){ //check the length of pick item function
                ?>
                <tr>
                    <td><?=$x?></td>
                    <td><input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px"></td>
                    <td>
                        <div id="<?='item'.$x.'Field'?>" style="display: grid;">
                            <input type="text" value="" id="<?='item'.$x.'Name'?>" readonly name="<?='item'.$x.'Name'?>" class="itmNameInput" style="grid-column: 1; width: 200px">
                            <select id="<?='item'.$x.'Select'?>" style="margin: 0px; width: 20px; grid-column: 2;" class="itemSelect" onchange="pickItem()">
                                <?php CoffeeGrades();?>
                            </select>
                        </div>
                    </td>
                    <td><input type="text" value="" id="<?='item'.$x.'QualitySpecs'?>" name="<?='item'.$x.'QualitySpecs'?>" class="itmNameInput" ></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Bags'?>"  name="<?='item'.$x.'Bags'?>" class="tblNum" step="0.01" ></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Qty'?>"  name="<?='item'.$x.'Qty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'Price'?>"  name="<?='item'.$x.'Price'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'GiPrem'?>"  name="<?='item'.$x.'GiPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'SocialPrem'?>"  name="<?='item'.$x.'SocialPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'QualityPrem'?>"  name="<?='item'.$x.'QualityPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'AMount'?>" readonly name="<?='item'.$x.'AMount'?>" step="0.001" class="tblNum"></td>
                    <td><input type="date" value="" id="<?='item'.$x.'ShipDate'?>" name="<?='item'.$x.'ShipDate'?>" step="0.001" class="tableInput" style="width: 90px;"></td>

                </tr>
                <?php
            }
            ?>
            <tr style="display: none;">
                <th colspan="2">Total</th>
                <td><input type="number" value="" id="totalQty" readonly name="totalQty" class="tblNum"></td>
                <th id="totalCurrency"></th>
                <td><input type="number" value="" id="total" readonly name="total" class="tblNum"></td>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <label for="sourcing" >Sourcing Actions</label>
                <input type="text" id="sourcing" name="sourcing" class="shortInput" style="width: 500px;"><br>
                <label for="financing" >Financing Source</label>
                <input type="text" id="financing" name="financing" class="shortInput" style="width: 500px;">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label for="offerTerms">Terms</label>
                <table style="border:0px solid">
                    <tbody>
                        <?php
                        for ($x=1;$x<=15;$x++){
                        ?>
                        <tr style="border:0px solid">
                            <td style="border:0px solid"><?=$x.'.'?></td>
                            <td style="width: 600px; border:0px solid"><input id="<?='term'.$x?>" class="tableInput"></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
        document.getElementById("pxCurrency").innerText="Base Price ("+selCurrency+"/Kg)";
    }

    function pickItem(){
        for (var x=1;x<=6;x++){
            var selectedItem = document.getElementById('item'+x+'Select').value;
            document.getElementById('item'+x+'Code').setAttribute("value", selectedItem.slice(0,6));
            document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(8));
            document.getElementById('item'+x+'QualitySpecs').setAttribute("value", selectedItem.slice(8));
        }
    }

    function updateInput(){
        var ttAmount=0;
        var ttQty=0;
        for (var x=1;x<=6;x++){
            var qty = Number(document.getElementById('item'+x+'Qty').value);
            ttQty+=qty;
            var price = Number(document.getElementById('item'+x+'Price').value);
            var giPrem = Number(document.getElementById('item'+x+'GiPrem').value);
            var socialPrem = Number(document.getElementById('item'+x+'SocialPrem').value);
            var qualityPrem = Number(document.getElementById('item'+x+'QualityPrem').value);

            var amount = price+giPrem+socialPrem+qualityPrem;

            ttAmount+=amount;
            document.getElementById('item'+x+'AMount').setAttribute("value", amount);
        }
        document.getElementById("totalQty").setAttribute("value", ttQty);
        document.getElementById("total").setAttribute("value", ttAmount);
    }
    
</script>
<script src="../assets/js/locations.js"></script>