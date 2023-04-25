<?php session_start();
$username = $_SESSION["fullName"];
include ("database.php");

// Generating grades
$salesReportGradeList = array();
$qtyList = array();
$priceList = array();

for ($x=1; $x<=10; $x++){
    array_push($salesReportGradeList, "item".$x."Code"); 
    array_push($qtyList, "item".$x."Qty"); 
    array_push($priceList, "item".$x."UgxPx");
}

$BuyerId = sanitize_table($_POST["customerId"]);
$salesReportDate = $_POST["salesReportDate"];
$salesReportCategory = $_POST["salesReportCategory"];
$ugxGrandTotal = sanitize_table($_POST["ugxGrandTotal"]);
$exchangeRate = sanitize_table($_POST["exchangeRate"]);
$salesReportCurrency = sanitize_table($_POST["salesReportCurrency"]);
$preparedBy = $username;
$salesReportNotes = sanitize_table($_POST["notes"]);
$ttQty = $_POST["totalQty"];
$docType = "Sales Report";
$salesNo = documentNumber("sales_reports_summary", "sales_report_no");
$itmNo = 1;
$selfId = "SELF01";

if ($ugxGrandTotal>0 && $BuyerId!="" && $ttQty>0){
    if(isset($_POST["btnsubmit"])){
        $action = $_POST["btnsubmit"];
        if ($action=="Modify"){
            //eliminate old summary
            $editSalNo = intval($_SESSION["salNo"]);
            $salesNo = $editSalNo;
            $editSummSql = $conn->prepare("DELETE FROM sales_reports_summary WHERE (sales_report_no=?)");
            $editSummSql->bind_param("i", $salesNo);
            $editSummSql->execute();
            $editSummSql->close();
            //eliminate old items
            $deleteSql = $conn->prepare("DELETE FROM inventory WHERE (inventory_reference='Sales Report') AND (document_number=?)");
            $deleteSql->bind_param("i", $salesNo);
            $deleteSql->execute();
            $deleteSql->close();

        }
    }
    //capturing summary
    $summarySql = $conn->prepare("INSERT INTO sales_reports_summary (sales_report_no, customer_id, sales_report_date, sale_category, sales_report_value, 
                            foreign_currency, exchange_rate, preparing_staff, sales_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $summarySql->bind_param("isssisiss",$salesNo, $BuyerId, $salesReportDate, $salesReportCategory, $ugxGrandTotal, $salesReportCurrency, 
    $exchangeRate, $preparedBy, $salesReportNotes);
    $summarySql->execute();
    $summarySql->close();
    //capturing details
    $qtyOutSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, customer_id, item_no, 
            grade_id, qty_out, price_ugx) VALUES (?,?,?,?,?,?,?,?)");
    $qtyInSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, customer_id, item_no, 
            grade_id, qty_in, price_ugx) VALUES (?,?,?,?,?,?,?,?)");   
            
    $docType = "Sales Report";
    for ($p=0; $p < count($qtyList); $p++){
        $qty = ($_POST[$qtyList[$p]]) ;
        $gradeID = ($_POST[$salesReportGradeList[$p]]);
        $itemPx = ($_POST[$priceList[$p]]);
        if ($qty > 0){
            $qtyOutSql->bind_param("sissisdd", $docType, $salesNo, $salesReportDate, $selfId, $itmNo, $gradeID, $qty, $itemPx);
            $qtyOutSql->execute();
            $itmNo += 1;
            $qtyInSql->bind_param("sissisdd", $docType, $salesNo, $salesReportDate, $BuyerId, $itmNo, $gradeID, $qty, $itemPx);
            $qtyInSql->execute();
            $itmNo += 1;
        }
    }  

    //message 
    if(isset($_POST["btnsubmit"]))
    {
    header("location:../marketing/SalesReport?formmsg=success");
    }
}else{
    if(isset($_POST["btnsubmit"]))
    {
    header("location:../marketing/SalesReport?formmsg=fail");
    }
}



?>