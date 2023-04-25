<?php
$pageTitle="Valuation Report";
include("../forms/header.php");
if(isset($_GET['valNo'])){
    $val=$_GET['valNo'];
    $_SESSION["valNo"] = $val;
}
include "../connection/valuationVariables.php";
// include "../pdfgen/valuationVariables.php";
include ("../connection/databaseConn.php");

?>

<form class="regularForm" method="post" action="../connection/valuationVerification.php" style="height:fit-content; width:900px">
  <?php include "../components/print.php";?>
    <?php include "../templates/valuation.php"?>
    <?php include '../components/backbtn.php'?>
</form>
<?php include "../forms/footer.php" ?>
<script>
  document.getElementById("btnback").setAttribute('href','../transactions/valuationList');
</script>
<script src="../assets/js/print.js"></script>
<?php
include "../assets/js/valuationVer.php"
?>


