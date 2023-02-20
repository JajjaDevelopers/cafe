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
<?php require "newreleasetemplate.php" ?>
</form>
<script>
    document.getElementById("customerId").setAttribute("value", "<?=$custId?>");
    document.getElementById("customerName").setAttribute("value", "<?=$custName?>");
    document.getElementById("salesReportContact").setAttribute("value", "<?=$ctctPersn?>");
    document.getElementById("salesReportTel").setAttribute("value", "<?=$tel?>");
    document.getElementById("salesReportTel").setAttribute("value", "<?=$tel?>");
    document.getElementById("relDate").setAttribute("value", "<?=$relsDate?>");
    //non displaying
    var noDispList = ["salesReportBuyer", "dispNoLabel", "dispNo"];
    for (var x=0; x<noDispList.length; x++){
        document.getElementById(noDispList[x]).style.display = "none";
    }
    var noEditList = ["initiator", "remarks", "destination", "relDate"];
    for (var x=0; x<noEditList.length; x++){
        document.getElementById(noEditList[x]).setAttribute("readonly", "readonly");
    }
    for (var x=1; x<=10; x++){
        document.getElementById('item'+x+'Select').style.display = "none";
        document.getElementById('item'+x+'Qty').setAttribute("readonly", "readonly");
    }
    //item table
    <?php
        $x=1;
        $qtySum = 0;
        while ($relDetSql->fetch()){
            ?>
            document.getElementById("<?='item'.$x.'Id'?>").setAttribute("value", "<?=$grdId?>")
            document.getElementById("<?='item'.$x.'Name'?>").setAttribute("value", "<?=$grdName?>")
            document.getElementById("<?='item'.$x.'Qty'?>").setAttribute("value", "<?=$qty?>")
            <?php
            $qtySum += $qty;
            $x += 1;
        }
    ?>
    document.getElementById("totalQty").setAttribute("value", "<?=$qtySum?>"); 
    document.getElementById("print").addEventListener("click",()=>{
      // alert("Hi God");
      document.getElementById("print").style.display="none";
      window.print();
    })   
</script>
</body>
</html>