<?php session_start(); ?>
<?php $prepared_by = $_SESSION["userName"]; ?>
<?php include ("database.php"); ?>
<?php
$invType = $_POST["invType"];
$itmId = sanitize_table($_POST["itemId"]);
$itmName = sanitize_table($_POST["ItemName"]);
$coffeeType = sanitize_table($_POST["coffeeType"]);
$typeCategory = sanitize_table($_POST["typeCategory"]);
$grdCategory = sanitize_table($_POST["gradeCategory"]);
$unitSymbol = sanitize_table($_POST["unitSymbol"]);
$rank = sanitize_table($_POST["gradeRank"]);

$newGradeSql = $conn->prepare("INSERT INTO grades (grade_id, coffee_type, type_category, grade_name, 
                                grade_type, unit_symbol, grade_rank, inventory_type) VALUES (?,?,?,?,?,?,?,?)") ;
$newGradeSql->bind_param("ssssssis", $itmId, $coffeeType, $typeCategory, $itmName, $grdCategory, $unitSymbol, $rank, $invType);
$newGradeSql->execute();
$newGradeSql->close();




header("Location:../inventory/NewItem");
?>