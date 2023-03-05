<?php $pageTitle = "Batch Report";
include "../connection/databaseConn.php";
// include ("../ajax/batchReportReturnsAjax.php");
// include "../connection/batchReportVariables.php";
include "../connection/batchHistVariables.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Batch Information</title>
  <link href="../assets/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/main.css">
  <link href="../assets/dashboard/css/style.css" rel="stylesheet">
</head>
<body>

<form class="regularForm" style="height: fit-content; width:790px">
  <?php
  include "../templates/batchReport.php";
  include "../forms/users.php";
  ?>
</form>
<script>
    document.getElementById("print").addEventListener("click",()=>{
    // alert("Hi God");
    document.getElementById("print").style.display="none";
    window.print();
    document.getElementById("print").style.display="block";
  })
   
    // var noDispalay = ["salesReportBuyer"];
    // for (var x=0;x<noDispalay.length;x++){
    //     document.getElementById(noDispalay[x]).style.display='none';
    // }
   
    
    // var noEditList =["stkCountDate", "notes"];
    // for (var x=0;x<noEditList.length;x++){
    //     document.getElementById(noEditList[x]).setAttribute('readonly', 'readonly')
    // }

</script>


