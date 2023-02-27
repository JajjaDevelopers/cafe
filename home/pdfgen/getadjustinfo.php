<?php include "./adjustvariables.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Stock Adjustment Information</title>
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
  include "../templates/adjustment.php";
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
</script>
<?php
include "../assets/js/adjustment.php";
?>
</body>
</html>


