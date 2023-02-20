<?php
session_start();
if(isset($_SESSION["relNo"])){
  include "./getreleaseinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>