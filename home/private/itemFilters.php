<?php
include "connlogin.php";
include "functions.php";
//return coffee grades
function getTypeGrades($typeCategory, $coffeeType){
  include "connlogin.php";
  // $byCatSql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE coffee_type=? AND type_category=? ");
  // $allSql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE coffee_type=?");
  if ($typeCategory=="All"){
    $sql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE coffee_type=?");
    $sql->bind_param("s", $coffeeType);
    $sql->execute();
    $sql->bind_result($id, $name);
  }else{
    $sql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE (coffee_type=? AND type_category=?)");
    $sql->bind_param("ss", $coffeeType, $typeCategory);
    $sql->execute();
    $sql->bind_result($id, $name);
  }
  ?>
  <option></option>
  <?php
  while ($sql->fetch()){
    ?>
    <option value="<?=$id?>"><?=$name?></option>
    <?php
  }
  $sql->close();
}

//return type categories
function getTypeCategories($type){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT type_category FROM grades WHERE coffee_type=? GROUP BY type_category");
    $sql->bind_param("s", $type);
    $sql->execute();
    $sql->bind_result($typeCategory);
    ?>
    <option>--Select--</option>
    <?php
    while ($sql->fetch()){
      ?>
      <option value="<?=$typeCategory?>"><?=$typeCategory?></option>
      <?php
    }
    $sql->close();
  }

//filter selection
$function = $_GET['filter'];
$key = $_GET['key'];
$selectedType = $_GET['selType'];

if ($function == "typeCat"){
    getTypeCategories($key);
}elseif ($function == "grades") {
  getTypeGrades($key, $selectedType);
}




?>