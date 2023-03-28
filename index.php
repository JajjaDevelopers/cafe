<?php
session_start();
if(isset($_SESSION["userName"])){
  // echo $_SESSION["userName"];
  header("location:./home/forms/index.php");
}
require_once "header.php";
require "login.php";
require_once "footer.php";

?>