<?php
session_start();
require_once "../pdf/vendor/autoload.php";
use Dompdf\Dompdf;
if(isset($_SESSION["grn"])){
  include "../connection/databaseConn.php";
  include "./getgrninfo.php";
  include "./newgrntemplate.php";

}else{
  echo "Failed to download pdf, please try again later";
}
?>

