<?php $pageTitle="Pre Offloading Sample"; ?>
<?php
include("../private/database.php");
include("../forms/header.php");
$sampNo = nextDocNumber("pre_quality", "assess_no", "POS");
?>
<form class="regularForm" method="post" action="../connection/preOffloadingSample.php">
<?php include "../templates/preoffloadingSample.php" ?>
<?php submitButton("Submit", "submit", "btnSubmit") ?>
</form>
<?php include_once ("../forms/footer.php")?>

<script>
     $("#typeName").hide();
     $("#typCatName").hide();
     $("#gradeName").hide();
     $("#usersDiv").hide();

     function getGrades(str){
      if (str == " ") {
          return;
      } 
      const xhttp = new XMLHttpRequest();
      // Updating grades based on coffee type
      xhttp.onload = function() {
          document.getElementById("gradeId").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/grnAjax.php?q="+str);
      xhttp.send();
    }   
</script>