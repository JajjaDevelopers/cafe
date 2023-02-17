<?php
function countPendVerifications($table, $column){
    include "connlogin.php";
    $coutnSql = $conn->query("SELECT count($column) as num FROM $table WHERE $column='0'");
    $result = mysqli_fetch_array($coutnSql);
    $number = $result['num'];
    // $conn->rollback();
    return $number;
}
$grnVerNum = countPendVerifications("grn", "verified_by");
$releasVerNum = countPendVerifications("release_request", "verified_by");
$valuationVerNum = countPendVerifications("valuation_report_summary", "verified_by");
$allPendVerList = array($grnVerNum, $releasVerNum, $valuationVerNum);


//Counting pending approvals
function countPendApprovals($table, $column){
    include "connlogin.php";
    $coutnSql = $conn->query("SELECT count($column) as num FROM $table WHERE  ($column='0' AND verified_by <>'0')");
    $result = mysqli_fetch_array($coutnSql);
    $number = $result['num'];
    // $conn->rollback();
    return $number;
}



$grnApprNum = countPendApprovals("grn", "approved_by");
$releaseApprNum = countPendApprovals("release_request", "appr_by");
$valuationApprNum = countPendApprovals("valuation_report_summary", "approved_by");
$allPendApprList = array($grnApprNum, $releaseApprNum, $valuationApprNum);


$totalPendVer = 0;
$totalPendAppr = 0;

for ($x=0;$x<count($allPendVerList);$x++){
    $totalPendVer += $allPendVerList[$x];
}
for ($x=0;$x<count($allPendApprList);$x++){
    $totalPendAppr += $allPendApprList[$x];
}

$totalNotifications = $totalPendVer + $totalPendAppr; //to appear on the notification on the dashboard
function getAllPendingVerifications(){
    global $totalPendVer;
    if ($totalPendVer > 0){
        ?>
        <span class="badge"><?=$totalPendVer?></span>
        <?php
    }
}

function getAllPendingApprovals(){
    global $totalPendAppr;
    if ($totalPendAppr > 0){
        ?>
        <span class="badge"><?=$totalPendAppr?></span>
        <?php
    }
}

//Getting verification list
function grnVerificationList(){
    include "connlogin.php"; 
    $sql = "SELECT grn_no, grn_date, customer_name, grade_name, grn_qty, purpose, prepared_by 
            FROM grn
            JOIN customer USING (customer_id)
            JOIN grades USING (grade_id)
            WHERE (verified_by='0')";
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
            WHERE (verified_by!='0') AND (approved_by='0')";
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
                            JOIN customer USING (customer_id) WHERE verified_by='0' ");
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
                            JOIN customer USING (customer_id) WHERE verified_by<>'0' AND appr_by='0'");
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
                            WHERE verified_by='0' GROUP BY valuation_no");
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
                            WHERE verified_by<>'0' AND approved_by='0' GROUP BY valuation_no");
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
?>