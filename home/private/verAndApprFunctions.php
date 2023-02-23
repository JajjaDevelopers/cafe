<?php
function countPendVerifications($table, $column){
    include "connlogin.php";
    $coutnSql = $conn->query("SELECT count($column) as num FROM $table WHERE $column='None'");
    $result = mysqli_fetch_array($coutnSql);
    $number = $result['num'];
    // $conn->rollback();
    return $number;
}
$grnVerNum = countPendVerifications("grn", "verified_by");
$releasVerNum = countPendVerifications("release_request", "verified_by");
$valuationVerNum = countPendVerifications("valuation_report_summary", "verified_by");
$salesReportVerNum = countPendVerifications("sales_reports_summary", "verified_by");
$hullingVerNum = countPendVerifications("hulling", "verified_by");
$dryingVerNum = countPendVerifications("drying", "verified_by");


$allPendVerList = array($grnVerNum, $releasVerNum, $valuationVerNum, $salesReportVerNum, $hullingVerNum, $dryingVerNum);


//Counting pending approvals
function countPendApprovals($table, $column){
    include "connlogin.php";
    $coutnSql = $conn->query("SELECT count($column) as num FROM $table WHERE  ($column='None' AND verified_by <>'None')");
    $result = mysqli_fetch_array($coutnSql);
    $number = $result['num'];
    // $conn->rollback();
    return $number;
}



$grnApprNum = countPendApprovals("grn", "approved_by");
$releaseApprNum = countPendApprovals("release_request", "appr_by");
$valuationApprNum = countPendApprovals("valuation_report_summary", "approved_by");
$salesReportApprNum = countPendApprovals("sales_reports_summary", "approved_by");
$hullingApprNum = countPendApprovals("hulling", "approved_by");
$dryingApprNum = countPendApprovals("drying", "approved_by");

$allPendApprList = array($grnApprNum, $releaseApprNum, $valuationApprNum, $salesReportApprNum, $hullingApprNum, $dryingApprNum);


$totalPendVer = 0;
$totalPendAppr = 0;

for ($x=0;$x<count($allPendVerList);$x++){
    $totalPendVer += $allPendVerList[$x];
}
for ($x=0;$x<count($allPendApprList);$x++){
    $totalPendAppr += $allPendApprList[$x];
}
//dashboard notification
$totalNotifications = $totalPendVer + $totalPendAppr; //to appear on the notification on the dashboard
function allNotifications($totalNotifications){
    echo $totalNotifications;
}// total number of notifications
function getAllPendingVerifications(){
    global $totalPendVer;
    if ($totalPendVer > 0){
        echo $totalPendVer;
    }
}

function getAllPendingApprovals(){
    global $totalPendAppr;
    if ($totalPendAppr > 0){
        echo $totalPendAppr;
    }
}

//Getting verification list
function grnVerificationList(){
    include "connlogin.php"; 
    $sql = "SELECT grn_no, grn_date, customer_name, grade_name, grn_qty, purpose, prepared_by 
            FROM grn
            JOIN customer USING (customer_id)
            JOIN grades USING (grade_id)
            WHERE (verified_by='None')";
    $getList = $conn->prepare($sql);
    $getList->execute();
    $getList->bind_result($grn_no, $grn_date, $customer_name, $grade_name, $grn_qty, $purpose, $FullName);
    $rows = $conn->$mysqli_affected_rows;
    if ($rows<0){
        ?>
        <tr>
            <td>There are no unverified GRNs currently!</td>
        </tr>
        <?php
    }else{
        while ($getList->fetch()){
            ?>
            <tr>
                <td><a href="verifyGrn?grnNo=<?= $grn_no?>" ><?= formatDocNo($grn_no, "")?></a></td>
                <td><?= $grn_date ?></td>
                <td><?= $customer_name ?></td>
                <td><?= $grade_name ?></td>
                <td style="text-align: right;" ><?= $grn_qty ?></td>
                <td><?= $purpose ?></td>
                <td><?= $FullName ?></td>
            </tr>
        <?php
        }
    }
}


//Getting verification list
function grnApprovalList(){
    include "connlogin.php"; 
    $sql = "SELECT grn_no, grn_date, customer_name, grade_name, grn_qty, purpose, verified_by 
            FROM grn
            JOIN customer USING (customer_id)
            JOIN grades USING (grade_id)
            WHERE (verified_by!='None') AND (approved_by='None')";
    $getList = $conn->prepare($sql);
    $getList->execute();
    $getList->bind_result($grn_no, $grn_date, $customer_name, $grade_name, $grn_qty, $purpose, $FullName);
    $rows = $conn->$mysqli_affected_rows;
    if ($rows<0){
        ?>
        <tr>
            <td colspan="7">There are no unverified GRNs currently!</td>
        </tr>
        <?php
    }else{
        while ($getList->fetch()){
            ?>
            <tr>
                <td><a href="../approval/grn?grnNo=<?= $grn_no?>" ><?= formatDocNo($grn_no, "")?></a></td>
                <td><?= $grn_date ?></td>
                <td><?= $customer_name ?></td>
                <td><?= $grade_name ?></td>
                <td style="text-align: right;" ><?= $grn_qty ?></td>
                <td><?= $purpose ?></td>
                <td><?= $FullName ?></td>
            </tr>
        <?php
        }
    }
}


//Retrieve grn details
function getGrnDetails($grnNo){
    include "connlogin.php";
    $grnSql = $conn->prepare("SELECT * FROM grn WHERE grn_no=$grnNo");
    $grnSql->execute();
    $grnSql->bind_result($grn_no, $grn_date, $grn_time_in, $customer_id, $grade_id, $grn_mc, $no_of_bags, $grn_qty, 
                        $grn_status, $batch_order_no, $purpose, $origin, $delivery_person, $truck_no, $driver, 
                        $quality_remarks, $prepared_by, $verified_by, $approved_by);
$grnSql->fetch();

}

//Document number formatter
function formatDocNo($docNo, $prefix){
    $docNumber = "";
  if ($docNo === 0){
    $docNumber = $prefix."-0001";
  }else{
    if ($docNo<10){
        $docNumber = $prefix."000".$docNo;
    }
    elseif ($docNo<100){
        $docNumber = $prefix."00".$docNo;
    }elseif ($docNo<1000){
        $docNumber = $prefix."0".$docNo;
    }else{
      $docNumber = $prefix."".$docNo;}
    }
  return $docNumber;

}

//Single submit button
function submitButton($value, $type, $btName){
    ?>
    <style>
         #verifyBtn:hover{
            background-color:green;
        }
        #verifyBtn:focus{
            background-color:#765341;
        }
    </style>
    <div id="activityPrepareDiv" style="margin-top:10px; margin-bottom:10px">
    <input type="<?=$type?>" id="verifyBtn" value="<?=$value?>" class="btn  btn-primary btn-sm text-white" name="<?=$btName?>">
    </div>

<?php
}

// Verify document
function verifyActivity($table, $keyColName, $keyVariable, $verifyUser){
    include "connlogin.php";
    $verifySql = $conn->prepare("UPDATE $table SET verified_by = ? WHERE ($keyColName=?)");
    $verifySql->bind_param("ss", $verifyUser, $keyVariable);
    $verifySql->execute();

}

// Approve document
function approveActivity($table, $keyColName, $keyVariable, $approveUser){
    include "connlogin.php";
    $approveSql = $conn->prepare("UPDATE $table SET approved_by = ? WHERE ($keyColName=?)");
    $approveSql->bind_param("ss", $approveUser, $keyVariable);
    $approveSql->execute();

}

//Release verification list
function releaseVerList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT release_no, request_date, customer_name, total_qty, destination, initiated_by FROM release_request
                            JOIN customer USING (customer_id) WHERE verified_by='None' ");
    $sql->execute();
    $sql->bind_result($relNo, $reqDate, $client, $qty, $destn, $initiator);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td><a href="../verification/release?relNo=<?=$relNo?>"><?= formatDocNo($relNo, "")?></a></td>
            <td><?=$reqDate?></td>
            <td><?=$client?></td>
            <td style="text-align: right;"><?=$qty?></td>
            <td><?=$destn?></td>
            <td><?=$initiator?></td>
        </tr>
        <?php
    }
}

//Release Approval list
function releaseApprList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT release_no, request_date, customer_name, total_qty, destination, initiated_by FROM release_request
                            JOIN customer USING (customer_id) WHERE verified_by<>'None' AND appr_by='None'");
    $sql->execute();
    $sql->bind_result($relNo, $reqDate, $client, $qty, $destn, $initiator);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td><a href="../approval/release?relNo=<?=$relNo?>"><?= formatDocNo($relNo, "")?></a></td>
            <td><?=$reqDate?></td>
            <td><?=$client?></td>
            <td style="text-align: right;"><?=$qty?></td>
            <td><?=$destn?></td>
            <td><?=$initiator?></td>
        </tr>
        <?php
    }
}

//valuation verification list
function valuationVerList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT valuation_no, valuation_date, customer_name, sum(qty*price_ugx) AS gross_value, costs
                            FROM valuation_report_summary JOIN valuations USING (valuation_no) JOIN customer USING (customer_id)
                            WHERE verified_by='None' GROUP BY valuation_no");
    $sql->execute();
    $sql->bind_result($valNo, $valDate, $valClient, $valGross, $valCosts);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../verification/valuation?valNo=<?= intval($valNo) ?>"><?= $valNo ?></a></td>
            <td><?= $valDate ?></td>
            <td><?= $valClient ?></td>
            <td style="text-align: right"><?= intval($valGross) ?></td>
            <td style="text-align: right"><?= intval($valCosts) ?></td>
            <td style="text-align: right"><?= intval($valGross-$valNo) ?></td>
        </tr>
        <?php
    }
}

//valuation approval list
//valuation verification list
function valuationApprList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT valuation_no, valuation_date, customer_name, sum(qty*price_ugx) AS gross_value, costs
                            FROM valuation_report_summary JOIN valuations USING (valuation_no) JOIN customer USING (customer_id)
                            WHERE verified_by<>'None' AND approved_by='None' GROUP BY valuation_no");
    $sql->execute();
    $sql->bind_result($valNo, $valDate, $valClient, $valGross, $valCosts);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../approval/valuation?valNo=<?= intval($valNo) ?>"><?= $valNo ?></a></td>
            <td><?= $valDate ?></td>
            <td><?= $valClient ?></td>
            <td style="text-align: right"><?= intval($valGross) ?></td>
            <td style="text-align: right"><?= intval($valCosts) ?></td>
            <td style="text-align: right"><?= intval($valGross-$valNo) ?></td>
        </tr>
        <?php
    }
}

//sales report
function salesReportVerList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT sales_report_no, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency
                            FROM sales_reports_summary JOIN customer USING (customer_id)
                            WHERE verified_by='None'");
    $sql->execute();
    $sql->bind_result($salNo, $salClient, $salDate, $salCat, $salValue, $currency);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../verification/salesReport?salNo=<?= intval($salNo) ?>"><?= $salNo ?></a></td>
            <td><?= $salDate ?></td>
            <td><?= $salClient ?></td>
            <td style="text-align: right"><?= $salCat ?></td>
            <td style="text-align: right"><?= $currency ?></td>
            <td style="text-align: right"><?= intval($salValue) ?></td>
        </tr>
        <?php
    }
}

function salesReportApprList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT sales_report_no, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency
                            FROM sales_reports_summary JOIN customer USING (customer_id)
                            WHERE verified_by<>'None' AND approved_by='None'");
    $sql->execute();
    $sql->bind_result($salNo, $salClient, $salDate, $salCat, $salValue, $currency);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../approval/salesReport?salNo=<?= intval($salNo) ?>"><?= $salNo ?></a></td>
            <td><?= $salDate ?></td>
            <td><?= $salClient ?></td>
            <td style="text-align: right"><?= $salCat ?></td>
            <td style="text-align: right"><?= $currency ?></td>
            <td style="text-align: right"><?= intval($salValue) ?></td>
        </tr>
        <?php
    }
}

//hulling reports
function hullingVerList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT hulling_no, hulling_date, customer_name, input_qty, output_qty,
                            (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input_grade,
                            (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output_grade
                            FROM hulling JOIN customer USING (customer_id)
                            WHERE verified_by='None'");
    $sql->execute();
    $sql->bind_result($hulNo, $hulDate, $hulClient,  $inQty, $outQty, $inGrd, $outGrd);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../verification/hulling?hullNo=<?= intval($hulNo) ?>"><?= $hulNo ?></a></td>
            <td><?= $hulDate ?></td>
            <td><?= $hulClient ?></td>
            <td style="text-align: left"><?= $inGrd ?></td>
            <td style="text-align: right"><?= $inQty ?></td>
            <td style="text-align: left"><?= $outGrd ?></td>
            <td style="text-align: right"><?= $outQty ?></td>
        </tr>
        <?php
    }
}

function hullingApprList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT hulling_no, hulling_date, customer_name, input_qty, output_qty,
                            (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input_grade,
                            (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output_grade
                            FROM hulling JOIN customer USING (customer_id)
                            WHERE verified_by<>'None' AND approved_by='None'");
    $sql->execute();
    $sql->bind_result($hulNo, $hulDate, $hulClient,  $inQty, $outQty, $inGrd, $outGrd);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td style="text-align: center"><a href="../approval/hulling?hullNo=<?= intval($hulNo) ?>"><?= $hulNo ?></a></td>
            <td><?= $hulDate ?></td>
            <td><?= $hulClient ?></td>
            <td style="text-align: left"><?= $inGrd ?></td>
            <td style="text-align: right"><?= $inQty ?></td>
            <td style="text-align: left"><?= $outGrd ?></td>
            <td style="text-align: right"><?= $outQty ?></td>
        </tr>
        <?php
    }
}

//drying reports
function dryingVerList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT drying_no, drying_date, customer_name, grade_name, input_qty, input_mc, output_qty, output_mc
                            FROM drying JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                            WHERE verified_by='None'");
    $sql->execute();
    $sql->bind_result($no, $dryDate, $client, $grdName, $inQty, $inMc, $outQty, $outMc);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td><a href="../verification/drying?dryNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$dryDate?></td>
                <td><?=$client?></td>
                <td><?=$grdName?></td>
                <td style="text-align: center;"><?=$inQty?></td>
                <td style="text-align: right;"><?=$inMc?></td>
                <td style="text-align: center;"><?=$outQty?></td>
            <td style="text-align: right;"><?=$outMc?></td>
        <?php
    }
}


function dryingApprList(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT drying_no, drying_date, customer_name, grade_name, input_qty, input_mc, output_qty, output_mc
                            FROM drying JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                            WHERE verified_by<>'None' AND approved_by='None'");
    $sql->execute();
    $sql->bind_result($no, $dryDate, $client, $grdName, $inQty, $inMc, $outQty, $outMc);
    
    while ($sql->fetch()){
        ?>
        <tr>
            <td><a href="../approval/drying?dryNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$dryDate?></td>
                <td><?=$client?></td>
                <td><?=$grdName?></td>
                <td style="text-align: center;"><?=$inQty?></td>
                <td style="text-align: right;"><?=$inMc?></td>
                <td style="text-align: center;"><?=$outQty?></td>
            <td style="text-align: right;"><?=$outMc?></td>
        <?php
    }
}
?>