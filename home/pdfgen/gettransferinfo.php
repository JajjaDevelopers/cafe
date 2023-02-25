<?php 
include "./transfervariables.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Transfer Information</title>
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
  include "../templates/transfer.php";
  include "../forms/users.php";
  ?>
</form>
<?php
include "../assets/js/transfer.php";
?>
<script>
  document.getElementById("print").style.display="block";
  document.getElementById("print").addEventListener("click",()=>{
  // alert("Hi God");
  document.getElementById("print").style.display="none";
  window.print();
  document.getElementById("print").style.display="none";
})
</script>
</body>
</html>
