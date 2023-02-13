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
                <td><input type="number" id="<?= $myInput[$x]?>" name="<?= $myInput[$x]?>" class="tableInput" ></td>
                <td><?= $cat1List[$x]?></td>
                <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tableInput" ></td>
            </tr>
            
            <?php
        }
        for ($x=count($myArr); $x<=count($cat1List);$x++){
            if ($x==count($myArr)){
            ?>
            <tr>
                <th>Subtotal</th>
                <td></td>
                <td><?= $cat1List[$x]?></td>
                <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tableInput" ></td>
            </tr>
            <?php
            }else{
                if ($x==count($cat1List)){
                    ?>
                    <tr>
                        <th></th>
                        <td></td>
                        <th>Subtotal</th>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th></th>
                    <td></td>
                    <td><?= $cat1List[$x]?></td>
                    <td><input type="number" id="<?= $cat1InputIds[$x]?>" name="<?= $cat1InputIds[$x]?>" class="tableInput" ></td>
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
                    <td><input id="doneBy" name="doneBy" class="tableInput" style="text-align:left"></td>
                    <th>Subtotal</th>
                    <td></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td><?= $summList[$x]?></td>
                <td><input type="number" id="<?= $summListIds[$x]?>" name="<?= $summListIds[$x]?>" class="tableInput" ></td>
                <td><?= $cat2List[$x]?></td>
                <td><input type="number" id="<?= $cat2InputIds[$x]?>" name="<?= $cat2InputIds[$x]?>" class="tableInput" ></td>
            </tr>
            <?php
        }
        ?>


    
</table>













