<?php
session_start();
if(isset($_SESSION["batchNo"])){
  include "./getbatchinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>