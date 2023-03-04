<?php session_start(); ?>
<?php $username = $_SESSION["fullName"]; ?>
<?php include ("connlogin.php"); ?>
<?php include ("functions.php"); ?>
<?php
//creeate items
$itmIds = array();
$itmQtys = array();
for ($x=1; $x<=10; $x++){
    array_push($itmIds, "item".$x."Id");
    array_push($itmQtys, "item".$x."Qty");
}
$relNo = documentNumber("release_request", "release_no");
$reqDate = $_POST["relDate"];
$client = $_POST["customerId"];
$ttQty = $_POST["totalQty"];
$destn = $_POST["destination"];
$initiator = $_POST["initiator"];
$cmmt = $_POST["remarks"];
$ref = "Release Request";
$prepDate = $today;
$itmNo = 1;
if ($client!="" && $ttQty>0){
    //insert into release summary
    $summSql = $conn->prepare("INSERT INTO release_request (release_no, request_date, customer_id, total_qty, 
                                prep_by, prep_date, comment, destination, initiated_by)
                                VALUES (?,?,?,?,?,?,?,?,?)");
    $summSql->bind_param("sssdsssss", $relNo, $reqDate, $client, $ttQty, $username, $prepDate, $cmmt, $destn, $initiator);
    $summSql->execute();
    $summSql->close();

    //capturing details
    $detSql = $conn->prepare("INSERT INTO temp_inventory (inventory_reference, document_number, trans_date, customer_id, 
                            item_no, grade_id, qty) VALUES (?,?,?,?,?,?,?)");
    for ($x=0; $x<count($itmIds); $x++){
        $itmId = $_POST[$itmIds[$x]];
        $itmQty = $_POST[$itmQtys[$x]];
        if ($itmQty > 0){
            $detSql->bind_param("sissisd", $ref, $relNo, $reqDate, $client, $itmNo, $itmId, $itmQty);
            $detSql->execute();
            $itmNo += 1;
        } 
    }
    if(isset($_POST["btnsubmit"]))
    {
        header("location:../inventory/release?formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../inventory/release?formmsg=fail");
        }

}

?>