<?php

session_start();
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];
$conn = new mysqli($servername, $username, $password, $dbname);


// Generating grades
$gradeIdList = array();
$qtyOutList = array();
$priceList = array();

    for ($x=0; $x<10; $x++){
        // $gradeId = ;
        array_push($gradeIdList, "item".$x."Code");
        // $qty = 
        array_push($qtyOutList, "item".$x."Qty");
        // $price =  ;
        array_push($priceList, "item".$x."UgxPx");
    }


function sanitize_table($tabledata)
{
    $tabledata=stripslashes($tabledata);
    $tabledata=strip_tags($tabledata);
    $tabledata=htmlentities($tabledata);
    return $tabledata;
}



    
// }
// GenerateGrades();

//Sales Report Number
$query = "SELECT max(sales_report_no) FROM sales_reports_summary";
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($sales_report_no);
    $stmt->fetch();
    $stmt->close();
}
$newNo = $sales_report_no + 1;
if ($newNo < 10){
    $zeros = '000';
} elseif ($newNo < 100){
    $zeros = '00';
} elseif ($newNo < 1000){
    $zeros = '0';
}else {
    $zeros='';
}
$nextSalesNo = $zeros.$newNo;
$conn->rollback();

//capturing summary
$summarySql = $conn->prepare("INSERT INTO sales_reports_summary (sales_report_no, customer_id, sales_report_date, sale_category, sales_report_value, 
                            foreign_currency, exchange_rate, preparing_staff, sales_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$BuyerId = sanitize_table($_POST["BuyerId"]);
$salesReportDate = $_POST["salesReportDate"];
$salesReportCategory = $_POST["salesReportCategory"];
$ugxGrandTotal = sanitize_table($_POST["ugxGrandTotal"]);
$exchangeRate = sanitize_table($_POST["exchangeRate"]);
$salesReportCurrency = sanitize_table($_POST["salesReportCurrency"]);
$preparedBy = $username;
$salesReportNotes = sanitize_table($_POST["salesReportNotes"]);

$summarySql->bind_param("isssisiss",$nextSalesNo, $BuyerId, $salesReportDate, $salesReportCategory, $ugxGrandTotal, $salesReportCurrency, 
                        $exchangeRate, $preparedBy, $salesReportNotes);
$summarySql->execute();
$conn->rollback();


//capturing details
function CaptureDetails(){
    
    global $conn, $qtyOutList, $gradeIdList, $priceList, $nextSalesNo;
    $detailSql = $conn->prepare("INSERT INTO nucafe_inventory (document_type, document_no, grade_id, qty_out, price_ugx) 
    VALUES (?, ?, ?, ?, ?)");


    for ($p=0; $p < count($qtyOutList); $p++){
        $qtyOut = intval(sanitize_table($_POST[$qtyOutList[$p]])) ;
        if ($qtyOut>0){
            $docType = "Sales Report";
            $gradeID = sanitize_table($_POST[$gradeIdList[$p]]);
            $itemPx = sanitize_table($_POST[$priceList[$p]]);
            $detailSql->bind_param("sisii", $docType, $nextSalesNo, $gradeID, $qtyOut, $itemPx);
            $detailSql->execute();
        }
            // $docType = "Sales Report";
            // $gradeID = sanitize_table($_POST[$gradeIdList[$p]]);
            // $itemPx = sanitize_table($_POST[$priceList[$p]]);
            // $detailSql->bind_param("sisii", $docType, $nextSalesNo, $gradeID, $qtyOut, $itemPx);
            // $detailSql->execute();


    }  
}
CaptureDetails();




header("location:../public/SalesReport.php") ;
?>