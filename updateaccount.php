<?php
session_start();
if(isset($_GET["message"])){
  $_SESSION["updateMessage"]=$_GET["message"];
}
if(isset($_GET["user"])){
  $identifer=$_GET["user"];
  $_SESSION["userId"]=$identifer;
  include "./updateform.php";
}
?>