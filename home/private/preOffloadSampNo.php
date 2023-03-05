<?php
include "connlogin.php";
include "functions.php";
$custId = $_GET['q'];
$grdId = $_GET['selGrd'];
$sql = $conn->prepare("SELECT assess_no FROM pre_quality WHERE customer_id=? AND decision='Accepted' AND grn_no=0 AND grade_id=?");
$sql->bind_param("ss", $custId, $grdId);
$sql->execute();
$sql->bind_result($sampNo);
?>
<option>select</option>
<?php
while ($sql->fetch()){
    ?>
    <option value="<?= $sampNo ?>"><?= $sampNo  ?></option>
    <?php
}
echo 123;
?>
