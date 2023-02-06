<?php 
session_start();
$username = $_SESSION["userName"];
?>
<?php include("../private/database.php"); ?>

<?php
$grnNo = documentNumber("grn", "grn_no");
$grnDate = $_POST["grnDate"];
$timein = $_POST["timein"];
$customerId = sanitize_table($_POST["customerId"]);
$coffeeGrade = sanitize_table($_POST["coffeegrades"]);
$mc = sanitize_table($_POST["mc"]);
$bags = sanitize_table($_POST["bags"]);
$gradeweight = sanitize_table($_POST["gradeweight"]);
$purpose = sanitize_table($_POST["purpose"]);
$origin = sanitize_table(intval($_POST["origin"]));
$deliveryPerson = sanitize_table($_POST["deliveryPerson"]);
$truckNumber = sanitize_table($_POST["truckNumber"]);
$driverName = sanitize_table($_POST["driverName"]) ;
$remarks = sanitize_table($_POST["remarks"]);


$grnStmt = "INSERT INTO grn (grn_no, grn_date, grn_time_in, customer_id, grade_id, grn_mc, no_of_bags, grn_qty, 
            purpose, district_id, delivery_person, truck_no, driver, quality_remarks, prepared_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$grnSql = $conn -> prepare($grnStmt);
$grnSql -> bind_param("issssdiisisssss", $grnNo, $grnDate, $timein, $customerId, $coffeeGrade, $mc, $bags, $gradeweight, 
                    $purpose, $origin, $deliveryPerson, $truckNumber, $driverName, $remarks, $username);
$grnSql -> execute();
$conn->rollback();

$grnDetailStmt = "INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, grade_id, 
                qty_in, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
$grnDetails = $conn-> prepare($grnDetailStmt);
$ref = "GRN";
$itemNo = 1;
$grnDetails -> bind_param("sisisds", $ref, $grnNo, $customerId, $itemNo, $coffeeGrade, $gradeweight, $grnDate);
$grnDetails -> execute();

if(isset($_POST["btnsubmit"]))
{
    header("location:../inventory/Goods_Received_Note?formmsg=success");
}
// header("location:../forms/Goods_Received_Note.php")
?>
