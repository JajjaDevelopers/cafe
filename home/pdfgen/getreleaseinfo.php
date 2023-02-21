<?php 
 include "./releaseVariables.php";
 include ("../connection/databaseConn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dispatch Information</title>
  <link href="../assets/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/main.css">
  <link href="../assets/dashboard/css/style.css" rel="stylesheet">

</head>
<body>

<form class="regularForm" style="height:fit-content; width:700px">
<input id="releaseNo" name="releaseNo" value="<?=$releaseNo?>" style="display:none" readonly>
<?php require "../templates/releaseTemplate.php" ?>
</form>
<?php include("../assets/js/releaseVer.php") ?>
</body>
</html>