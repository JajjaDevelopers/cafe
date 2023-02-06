<?php
//return coffee grades
function getTypeGrades($typeCategory){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE type_category=?");
  $sql->bind_param("s", $typeCategory);
  $sql->execute();
  $sql->bind_result($id, $name);
  ?>
  <option value="all">All</option>
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
    <option value="all">All</option>
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

if ($function == "typeCat"){
    getTypeCategories($key);
}elseif ($function == "grades") {
    getTypeGrades($key);
}




?>