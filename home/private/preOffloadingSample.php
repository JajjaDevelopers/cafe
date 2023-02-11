<?php session_start(); ?>
<?php $preparedBy = $_SESSION["fullName"]; ?>
<?php
include ("connlogin.php");
include ("functions.php");
?>
<?php
$samp_no = documentNumber("quality", "assess_no");
$samp_date = $_POST["sampDate"];
$samp_client = $_POST["customerId"];
$samp_grade = $_POST["coffeegrades"];
$samp_bags = $_POST["sampBags"];
$samp_kgs = $_POST["sampKg"];
$samp_mc = $_POST["sampMC"];
$remarks = $_POST["remarks"];

$sql = $conn->prepare("INSERT INTO quality (assess_no, assess_date, customer_id, grade_id, samp_bags, qty, mc, remarks, prepared_by)
                        VALUES (?,?,?,?,?,?,?,?,?)");
$sql->bind_param("isssiddss", $samp_no, $samp_date, $samp_client, $samp_grade, $samp_bags, $samp_kgs, $samp_mc, $remarks, $preparedBy);
$sql->execute();




header("location:../quality/preOffloadingSample");
exit();

?>