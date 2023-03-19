<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}


function getGrades($typeCategory, $gradeType, $coffeeType, $gradeIdPrefix, $tableHeader){
    include "../private/connlogin.php";
    $gradeSql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE (type_category=? AND grade_type=? AND coffee_type=?)
                                ORDER BY grade_rank");
  
    $highGradeList = array();
    $lowGradeList = array();
    $blacksGradeList = array();
    $wastesGradeList = array();
    $lossesGradeList = array();
    $allLists = array($highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList);
    $listsIdentifier = array("high", "low", "blacks", "wastes", "losses");
    //global $conn, $gradeSql, $listsIdentifier, $allLists, $highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList;
    $gradeSql->bind_param("sss", $typeCategory, $gradeType, $coffeeType);
    $gradeSql->execute();
    $allGrades = $gradeSql -> get_result();
    $rows = $conn -> affected_rows;
  
    $index = array_search($gradeIdPrefix, $listsIdentifier);
  
    ?>
    <h6 style="margin-top: 5px;"><?= $tableHeader?></h6>
    <input id="<?= $gradeIdPrefix.'Number' ?>" name="<?= $gradeIdPrefix.'Number' ?>" value="<?= $rows ?> " readonly style="display: none;">
    <table id="highGradeReturnsTable">
        <tr>
            <th class="batchItemLabel">GRADE</th>
            <th class="batchItemBags">BAGS</th>
            <th class="batchItemKgs">KGs</th>
            <th class="batchItemPercent" style="width: 50px;">%</th>
        </tr>
    <?php
    for ($gradeNo=1; $gradeNo <= $rows; $gradeNo++){
        $gradeRow = $allGrades -> fetch_assoc();
        $grade_id = $gradeRow ['grade_id'];
        $grade_name = $gradeNamePrefix.' '.$gradeRow ['grade_name'];
        $prefix = $gradeIdPrefix.'Grade'.$gradeNo;
  
        array_push($allLists[$index], $prefix.'Id');
        ?>
        <tr>
            <input type="text" id="<?= $prefix.'Id'?>" readonly name="<?= $prefix.'Id'?>" value="<?= $grade_id?>" class="tableInput" style="display:none">
            <td><input name="<?= $gradeIdPrefix?>" style="display:none"><?= $grade_name?></td>
            <td><input type="number" id="<?= $prefix.'Bags'?>" readonly name="<?= $prefix.'Bags'?>" class="tblNum"></td>
            <td><input type="number" id="<?= $prefix.'Qty'?>" name="<?= $prefix.'Qty'?>" class="tblNum"></td>
            <td><input type="number" id="<?= $prefix.'Per'?>" readonly name="<?= $prefix.'Per'?>" class="tblNum"></td>
        </tr>
        <?php
    }
        ?>
        <tr>
            <th>SUB TOTAL</th>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalBags' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalBags'?>" class="tblNum"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalQty' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalQty'?>" class="tblNum"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalPer' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalPer'?>" class="tblNum"></td>
        </tr>
    </table>
  <?php
}

//getting batch order input summary
function inputSummary($orderNo){
    include "../private/connlogin.php";
    $sql = $conn->prepare("SELECT grn_date, grn_no, grn_mc, grn_qty, customer_name FROM grn JOIN customer USING (customer_id)
                        WHERE batch_order_no=?");
    $sql->bind_param("s", $orderNo);
    $sql->execute();
    $sql->bind_result($date, $grnNo, $mc, $qty, $batchClient);
    $sqlRows=0;
    while ($sql->fetch()){
        $sqlRows+=1;
        ?>
        <tr>
            <td><?=$date?></td>
            <td style="text-align: center;"><?=$grnNo?></td>
            <td style="text-align: center;"><?=num($mc)?></td>
            <td style="text-align: right;"><?=num($qty)?></td>
            <td><?=$batchClient?></td>
        </tr>
        <?php
    }
    $sql->close();

    $orderSql=$conn->prepare("SELECT batch_order_date, batch_order_mc, batch_order_input_qty, customer_name FROM batch_processing_order
                        JOIN customer USING (customer_id) WHERE batch_order_no=?");
    $orderSql->bind_param("s", $orderNo);
    $orderSql->execute();
    $orderSql->bind_result($date, $mc, $qty, $batchClient);
    $orderSql->fetch();
    if($sqlRows<1){
        ?>
        <tr>
            <td><?=$date?></td>
            <td style="text-align: center;">None</td>
            <td style="text-align: center;"><?=num($mc)?></td>
            <td style="text-align: right;"><?=num($qty)?></td>
            <td><?=$batchClient?></td>
        </tr>
        <?php
    }
}

