<?php
include "../private/connlogin.php";
$customerId = $_POST["customerId"];
$customerName = $_POST["customerName"];
$customerTel = $_POST["customerTel"];
$contactPerson = $_POST["contactPerson"];
$batchOrderNumber = $_POST["batchOrderNumber"];
$coffeeType = $_POST["coffeeType"];
$inputMc = $_POST["batchMc"];
$netInputQty = $_POST["inputQty"];
$inputGradeName = $_POST["coffeeGrade"];
$inputGradeId = $_POST["gradeId"];

$batchRepNo = formatDocNo(Intval($batchNo), "BRN-") ;


$categorySql = $conn->prepare("SELECT type_category FROM grades WHERE grade_id=?");
$categorySql->bind_param("s", $inputGradeId);
$categorySql->execute();
$categorySql->bind_result($typeCategory);
$categorySql->fetch();
$categorySql->close();




?>