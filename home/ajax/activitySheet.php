<?php
include "../private/connlogin.php";
include "../private/functions.php";

$id = $_GET['id'];
$sql = $conn->prepare("SELECT unit_symbol FROM grades WHERE grade_id=?");
$sql->bind_param("s", $id);
$sql->execute();
$sql->bind_result($unit);
$sql->fetch();
echo $unit;


?>