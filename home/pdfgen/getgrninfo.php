
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GRN Information</title>
  <link href="../assets/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/main.css">
  <link href="../assets/dashboard/css/style.css" rel="stylesheet">

</head>
<body>

<form class="regularForm" style="height: fit-content; width:790px">

  <?php include "../templates/grnTemplate.php" ?>
</form>
<script>
  
    //disabling editing
    var noEditList = ["grnNo", "grnDate", "timeIn", "type", "gradeId", "weight", "bags", "mc", "purposeName", 
                    "origin", "deliveryPerson", "truckNumber", "driverName", "remarks", "gradeName", "typeName", 
                    "districtName", "regionName"];
    for (var x=0; x<noEditList.length; x++){
        document.getElementById(noEditList[x]).setAttribute("readonly", "readonly");
    }
    var noDisplayList = ["gradeId", "salesReportBuyer", "type", "purpose", "region", "origin", "category"];
    for (var x=0; x<noDisplayList.length; x++){
        document.getElementById(noDisplayList[x]).style.display = "none";
    }
    document.getElementById("print").addEventListener("click",()=>{
    // alert("Hi God");
    document.getElementById("print").style.display="none";
    window.print();
    document.getElementById("print").style.display="block";
    
  })

</script>
</body>
</html>
