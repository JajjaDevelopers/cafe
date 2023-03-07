<?php
include "../private/connlogin.php";
include "../private/functions.php";

$selDate = $_GET['selDate'];

echo getFx($selDate);

?>