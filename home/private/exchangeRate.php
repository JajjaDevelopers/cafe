<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php 
include ("database.php");
include "connlogin.php";
?>
<?php
$date = $_POST['date'];
$currency = $_POST['currency'];
$rate = $_POST['rate'];
$ref = sanitize_table($_POST['ref']);

$sql = $conn->prepare("INSERT INTO exchange_rate (rate_date, currency, rate, reference, prep_by) VALUES (?,?,?,?,?)");
$sql->bind_param("ssdss", $date, $currency, $rate, $ref, $prepared_by);
$sql->execute();
$sql->close();







header("location:../settings/exchangeRate");
?>