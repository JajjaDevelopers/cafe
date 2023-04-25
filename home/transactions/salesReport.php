<?php include "../forms/header.php" ?>
<?php include("../connection/salesReportVariables.php");?>
<form class="regularForm" style="height: fit-content;">
    <?php include "../components/print.php";?>
    <?php include "../templates/salesReport.php" ?>
    <?php include "../forms/users.php" ?>
    <?php include '../components/backbtn.php'?>
</form>
<?php include "../forms/footer.php" ?>
<script>
  document.getElementById("btnback").setAttribute('href','../transactions/valuationList');
</script>
<script src="../assets/js/print.js"></script>
<?php include "../assets/js/salesReport.php" ?>