<?php include ("../private/database.php")?>
<?php
function gradePicker($no){
?>
<input type="text" value="" id="<?= 'highGrade'.$no.'Code' ?>" readonly name="<?= 'highGrade'.$$no.'Code' ?>" class="itmNameInput" style="grid-column: 1; display:none">';
<input type="text" value="" id="<?= 'highGrade'.$no.'Name' ?>" readonly name="<?= 'highGrade'.$no.'Name' ?>" class="itmNameInput" style="grid-column: 2; width: 250px">';
            
<select id="<?= 'highGrade'.$no.'Select' ?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">
 <?php CoffeeGrades(); ?>
</select>


<script>
  // var codeIds = [];
  // var nameIds = []; 
  // var itemSelections = [];
  // for (var x=1; x<=10; x++){
  //   codeIds.push("highGrade"+x+"Code");
  //   nameIds.push("highGrade"+x+"Name");
  //   itemSelections.push("highGrade"+x+"Select");
  // }
  function valuationItemCodeAndName(selectId){
    var selectedItem = document.getElementById(selectId).value;
    // var selectIndex = Number(itemSelections.indexOf(selectId));

    document.getElementById("<?= 'highGrade'.$no.'Code' ?>").setAttribute("value", selectedItem.slice(0,6));
    document.getElementById("<?= 'highGrade'.$no.'Name' ?>").setAttribute("value", selectedItem.substr(8));
  }
</script>
<?php
}
?>