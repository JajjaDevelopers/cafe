<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"];
include ("connlogin.php");
include "functions.php";

$nextNoSql = $conn->prepare("SELECT max(allocation_no)+1 FROM contract_stock_allocation");
$nextNoSql->execute();
$nextNoSql->bind_result($allocNo);
$nextNoSql->fetch();
if (intval($allocNo)==0){
    $allocNo=1;
}
$nextNoSql->close();

$contractNo = $_POST['reference'];
$allocationDate = $_POST['date'];

$sql = $conn->prepare("INSERT INTO contract_stock_allocation (allocation_no, contract_no, grade_id, inventory_reference,
                    document_number, allocated_qty, allocation_date, prepared_by, item_no) VALUES (?,?,?,?,?,?,?,?,?)");

$itmNo=1;
for ($x=1;$x<=10;$x++){
    $allocQty = $_POST['item'.$x.'DistQty'];
    if ($allocQty>0){
        $grdId = $_POST['item'.$x.'Code'];
        $src = $_POST['item'.$x.'Src'];
        $doc = "Valuation Report";
        $docNo = $_POST['item'.$x.'Src'];
        if ($src=="Open"){
            $doc="Open";
            $docNo=0;
        }

        $sql->bind_param("iissidssi", $allocNo, $contractNo, $grdId, $doc, $docNo, $allocQty, $allocationDate, $prepared_by, $itmNo);
        $sql->execute();
        $itmNo+=1;
    }
    
}

header("location:../marketing/contractAllocation?formmsg=success");

?>