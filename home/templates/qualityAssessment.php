<h3 class="formHeading">Quality Assessment</h3>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="sampNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Sample No:</label>
    <input type="text" class="shortInput" id="sampNo" name="sampNo" value="<?= $assessNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;" readonly>
    <label for="sampDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="sampDate" name="sampDate" value="<?= $today ?>" style="grid-column: 2; grid-row: 2">
</div>
<?php require("../forms/customerSelector.php");?>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <label for="grnNo">GRN No.</label><br>
            <input class="shortInput" id="grnNo" name="grnNo" value="<?=$grnNo?>" readonly>
        </div>
        <div class="col-sm-6">
            <label for="gradeId">Grade</label><br>
            <input class="shortInput" id="gradeId" name="gradeId" value="<?=$grade?>" readonly style="width:300px">
        </div>
        <div class="col-sm-3">
            <label for="qty">Weight (Kg)</label><br>
            <input class="shortInput" id="qty" name="qty" value="<?=$qty?>" readonly>
        </div>
    </div><br>
    <div class="row">
    <div class="col-sm-3">
            <label for="bags">Bags</label><br>
            <input class="shortInput" id="bags" name="bags" value="<?=$bags?>" readonly>
        </div>
        <div class="col-sm-6">
            <label for="purpose">Purpose</label><br>
            <input class="shortInput" id="purpose" name="purpose" value="<?=$purpose?>" readonly style="width:300px">
        </div>
        <div class="col-sm-3">
            <label for="mc">Moisture (%)</label><br>
            <input class="shortInput" id="mc" name="mc" value="<?=$mc?>" readonly>
        </div>
    </div>
</div>
<table>
    <tr>
        <th style="width:230px">Higher Grades</th>
        <td style="width:150px"></td>
        <th style="width:230px">Category 1</th>
        <td style="width:150px"></td>
    </tr>
    <?php
        if ($grdType == "Arabica"){
            $myArr = $soundBeansArabica;
            $myInput = $arabicaInputIds;
        } else {
            $myArr = $soundBeansRobusta;
            $myInput = $robustaInputIds;
        }
        for ($x=0; $x<count($myArr); $x++){
            ?>
            <tr>
                <td><?= $myArr[$x]?></td>
                <td><input type="number" id="<?= $myInput[$x]?>" name="<?= $myInput[$x]?>" class="tblNum" onblur="calcSubtotal()"></td>
                <td><?= $cat1List[$x]?></td>
                <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tblNum" onblur="calcSubtotal()"></td>
            </tr>
            
            <?php
        }
        for ($x=count($myArr); $x<=count($cat1List);$x++){
            if ($x==count($myArr)){
            ?>
            <tr>
                <th>Subtotal</th>
                <td><input type="number" id="highGrdTotal" name="highGrdTotal" class="tblNum" readonly></td>
                <td><?= $cat1List[$x]?></td>
                <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tblNum" ></td>
            </tr>
            <?php
            }else{
                if ($x==count($cat1List)){
                    ?>
                    <tr>
                        <th></th>
                        <td></td>
                        <th>Subtotal</th>
                        <td><input type="number" id="cat1Total" name="cat1Total" class="tblNum" readonly ></td></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th></th>
                    <td></td>
                    <td><?= $cat1List[$x]?></td>
                    <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tblNum" ></td>
                </tr>
                <?php
                
            }
        }
        ?>
        <tr>
            <th></th>
            <td></td>
            <th>Category 2</th>
            <td></td>
        </tr>
        <?php
        for ($x=0; $x<=count($cat2List); $x++){
            if ($x==count($cat2List)){
                ?>
                <tr>
                    <th>Done By:</th>
                    <td><input id="doneBy" name="doneBy" class="tableInput"></td>
                    <th>Subtotal</th>
                    <th><input type="number" id="cat2Total" name="cat2Total" class="tblNum" readonly></th>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td><?= $summList[$x]?></td>
                <td><input type="number" id="<?= $summListIds[$x]?>" name="<?= $summListIds[$x]?>" class="tblNum" ></td>
                <td><?= $cat2List[$x]?></td>
                <td><input type="number" id="<?= $cat2InputIds[$x]?>" name="<?= $cat2InputIds[$x]?>" class="tblNum" onblur="calcSubtotal()"></td>
            </tr>
            <?php
        }
        ?>
</table>

<script>
    document.getElementById("kibPercOut").setAttribute("readonly", "readonly");
    document.getElementById("outTurn").setAttribute("readonly", "readonly");
    document.getElementById("ttDefects").setAttribute("readonly", "readonly");
    document.getElementById("kibPercOut").setAttribute("step", "0.01");
    document.getElementById("kibParch").addEventListener("blur", calcSubtotal);
    document.getElementById("green").addEventListener("blur", calcSubtotal);
    var coffType = "<?= $grdType ?>";
    //table data (check lists in js to match php arrays]
    var cat1List = ["Full Blacks", "Full Sour", "Pods", "Fungus", "Extraneous Matter", "Severe Insect Damage"];
    var cat1InputIds = ["fullBlaks", "fullSour", "pods", "fungus", "extraMat", "insDamage"];

    var cat2List = ["Partial Black", "Partial Sour", "Parchment", "Floater-Chalky Whites", "Immature", "Withered", 
                        "Shell", "Broken-Chipped-Cut", "Husks", "Pinhole"];
    var cat2InputIds = ["partBlak", "partSour", "parchment", "floater", "immature", "withered", 
                        "shell", "broken", "husks", "pinhole"];

    var soundBeansArabica = ["AA", "A", "B", "C", "Triage"]; //later generate from the database - list
    var arabicaInputIds = ["aa", "a", "b", "c", "triage"];

    var soundBeansRobusta = ["Screen 1800", "Screen 1700", "Screen 1500", "Screen 1200", "Screen 1199"];
    var robustaInputIds = ["sc18", "sc17", "sc15", "sc12", "sc1199"];

    var summList = ["Kibooko-Parchment", "Green", "Percentage Out turn", "", "", "Total Defects", "", "OUT TURN"];
    var summListIds = ["kibParch", "green", "kibPercOut", "", "", "ttDefects", "", "outTurn"];

    if (coffType == "Arabica"){
        var sndBnInputList = arabicaInputIds;
    }else {
        var sndBnInputList = robustaInputIds;
    }
    //getting subtotal
    function calcSubtotal(){
        //category 1
        var cat1SubTotal = 0;
        var cat2SubTotal = 0;
        var sndBnsTotal = 0;
        for (var x=0; x<cat1InputIds.length; x++){
            var lineInput = Number(document.getElementById(cat1InputIds[x]).value);
            cat1SubTotal += lineInput;
        }
        for (var x=0; x<cat2InputIds.length; x++){
            var lineInput = Number(document.getElementById(cat2InputIds[x]).value);
            cat2SubTotal += lineInput;
        }
        for (var x=0; x<sndBnInputList.length; x++){
            var lineInput = Number(document.getElementById(sndBnInputList[x]).value);
            sndBnsTotal += lineInput;
        }
        document.getElementById("cat1Total").setAttribute("value", cat1SubTotal);
        document.getElementById("cat2Total").setAttribute("value", cat2SubTotal);
        document.getElementById("highGrdTotal").setAttribute("value", sndBnsTotal);
        document.getElementById("ttDefects").setAttribute("value", cat1SubTotal+cat2SubTotal);
        var kibParch = document.getElementById("kibParch").value;
        var greenOut = document.getElementById("green").value;
        var perOut = Number((greenOut/kibParch)*100);
        document.getElementById("kibPercOut").setAttribute("value", perOut);
        document.getElementById("outTurn").setAttribute("value", (100-(cat1SubTotal+cat2SubTotal)));
    }
    
</script>




