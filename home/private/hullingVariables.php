<?php
include "connlogin.php";
include "functions.php";
$hullNo = intval($_GET['hullNo']);
$hullingNo = formatDocNo($hullNo, "HUL-");

//summary
$sql = $conn->prepare("SELECT hulling_date, customer_id, customer_name, contact_person, telephone, mc_in, mc_out,
                        (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input, input_qty,  
                        (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output, output_qty,
                        notes, prepared_by, prep_date, verified_by, ver_date, approved_by, appr_date, grade_name, notes
                        FROM hulling JOIN customer USING (customer_id) JOIN grades WHERE grades.grade_id=hulling.input_grade_id
                        AND hulling_no=?");
$sql->bind_param("i", $hullNo);
$sql->execute();
$sql->bind_result($hulDate, $cltId, $cltName, $cltContact, $cltTel, $mcIn, $mcOut, $grdIn, $qtyIn, $grdOut, $qtyOut, $comment, $prepared_by, 
                    $prep_time, $verified_by, $ver_time, $approved_by, $appr_tim, $grdName, $comment);
$sql->fetch();
$sql->close();

//output


function outputDetails(){
    include "connlogin.php";
    global $hullNo;
    $outSql = $conn->prepare("SELECT grade_name, qty_in FROM inventory JOIN grades USING (grade_id)
    WHERE inventory_reference='Hulling' AND document_number=? AND qty_in<>0 ORDER BY qty_in DESC" );
    $outSql->bind_param("i", $hullNo);
    $outSql->execute();
    $outSql->bind_result($outGrdName, $outGrdQty);
    $i=1;
    while ($outSql->fetch()){
        ?>
        <tr>
            <?php
            if ($i==1){
                ?>
            <td><label>Output:</td>
            <?php
            }else{
                ?>
            <td><label></td>
            <?php
            }
            ?>
            <td><?=$outGrdName?></td>
            <td style="text-align: right;"><?=num($outGrdQty)?></td>
        </tr>
        <?php
        $i+=1;
    }
}

?>