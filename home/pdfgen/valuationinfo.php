<?php
session_start();
if(isset($_SESSION["valNo"])){
  include "./getvaluationinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>