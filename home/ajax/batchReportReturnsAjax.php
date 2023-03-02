<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}


function getGrades($typeCategory, $gradeType, $gradeNamePrefix, $gradeIdPrefix, $tableHeader){
    include "../private/connlogin.php";
    $gradeSql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE (type_category=? AND grade_type=?)
                                ORDER BY grade_rank");
  
    $highGradeList = array();
    $lowGradeList = array();
    $blacksGradeList = array();
    $wastesGradeList = array();
    $lossesGradeList = array();
    $allLists = array($highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList);
    $listsIdentifier = array("high", "low", "blacks", "wastes", "losses");
    //global $conn, $gradeSql, $listsIdentifier, $allLists, $highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList;
    $gradeSql->bind_param("ss", $typeCategory, $gradeType);
    $gradeSql->execute();
    $allGrades = $gradeSql -> get_result();
    $rows = $conn -> affected_rows;
  
    $index = array_search($gradeIdPrefix, $listsIdentifier);
  
    ?>
    <h5 style="margin-top: 10px;"><?= $tableHeader?></h5>
    <input id="<?= $gradeIdPrefix.'Number' ?>" name="<?= $gradeIdPrefix.'Number' ?>" value="<?= $rows ?> " readonly style="display: none;">
    <table id="highGradeReturnsTable">
        <tr>
            <th class="batchItemLabel">GRADE</th>
            <th class="batchItemBags">BAGS</th>
            <th class="batchItemKgs">KGs</th>
            <th class="batchItemPercent">%</th>
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
            <td><input type="number" id="<?= $prefix.'Bags'?>" readonly name="<?= $prefix.'Bags'?>" class="tableInput"></td>
            <td><input type="number" id="<?= $prefix.'Qty'?>" name="<?= $prefix.'Qty'?>" class="tableInput"></td>
            <td><input type="number" id="<?= $prefix.'Per'?>" readonly name="<?= $prefix.'Per'?>" class="tableInput"></td>
        </tr>
        <?php
    }
        ?>
        <tr>
            <th>SUB TOTAL</th>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalBags' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalBags'?>" class="tableInput"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalQty' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalQty'?>" class="tableInput"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalPer' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalPer'?>" class="tableInput"></td>
        </tr>
    </table>
  <?php
  }
 