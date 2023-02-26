<?php
session_start();
if(isset($_SESSION["bulkNo"])){
  include "./getbulkinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>