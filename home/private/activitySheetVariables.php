<?php
include "connlogin.php";
include "functions.php";
// include "../private/functions.php";
if(isset($_GET['actNo'])){
    $actNo=$_GET['actNo'];
    
}
$activityNo="RST-".$actNo;

$summSql = $conn->prepare("SELECT activity_date, customer_id, customer_name, contact_person, telephone, grade_name, qty, 
                        roast_profile, special_request, prepared_by, prep_date, verified_by, ver_date, approved_by, appr_date
                        FROM roastery_activity_summary JOIN grades USING (grade_id) JOIN customer USING (customer_id)
                        WHERE activity_sheet_no=?");
$summSql->bind_param("i", $actNo);
$summSql->execute();
$summSql->bind_result($actDate, $cltId, $cltName, $cltContact, $cltTel, $inputGrd, $inputQty, $roastProfile, $specailRequest, $prepared_by, $prep_time, 
                    $verified_by, $ver_time, $approved_by, $appr_time);
$summSql->fetch();

function itemDetails(){
    include "connlogin.php";
    global $actNo;
    $sql = $conn->prepare("SELECT grade_name, qty, rate FROM roastery_activity_details JOIN grades USING (grade_id)
                        WHERE activity_sheet_no=?");
    $sql->bind_param("i", $actNo);
    $sql->execute();
    $sql->bind_result($grd, $qty, $rate);
    ?>
    <table>
        <thead>
            <tr>
                <th style="width: 330px;">Activity Name</th>
                <th style="width: 100px;">Quantity</th>
                <th style="width: 100px;">Rate</th>
                <th style="width: 150px;">Amount</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $ttValue=0;
    while ($sql->fetch()){
        $ttValue+=$qty*$rate;
        ?>
            <tr>
                <td><?=$grd?></td>
                <td style="text-align: right;"><?=num($qty)?></td>
                <td style="text-align: right;"><?=num($rate)?></td>
                <td style="text-align: right;"><?=num($qty*$qty)?></td>
            </tr>
        <?php
    }
    ?>      
            <tr id="totalRow">
                <td class="emptyCell"></td>
                <td class="emptyCell"></td>
                <th>Total</th>
                <th style="text-align: right;"><b><?=num($ttValue)?></b></th>
            </tr>
        </tbody>
    </table>
    <?php
}








?>