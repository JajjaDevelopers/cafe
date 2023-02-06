<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}
?>
<?php
$ordersSql = $conn->prepare("SELECT batch_order_input_qty, batch_order_mc, grade_name, grade_id, coffee_type FROM batch_processing_order
                            JOIN grn USING (batch_order_no)
                            JOIN grades USING (grade_id)
                            WHERE batch_order_no=?");
$batch_order_no = $_GET['q'];
$ordersSql->bind_param("i", $batch_order_no);
$ordersSql->execute();
$ordersSql->bind_result($batch_order_input_qty, $batch_order_mc, $grade_name, $grade_id, $coffee_type);
$ordersSql->fetch();
$ordersSql->close();

// $batch_order_input_qty = intval($order['batch_order_input_qty']);
// $batch_order_mc = intval($order['batch_order_mc']) ;
// $grade_name = $order['grade_name'];
?>
<input id="orderAjaxQty" value="<?= $batch_order_input_qty?>">
<input id="orderAjaxMc" value="<?= $batch_order_mc?>">
<input id="orderAjaxGradeName" value="<?= $grade_name?>">
<input id="orderAjaxGradeId" value="<?= $grade_id?>">
<input id="orderAjaxCoffeeType" value="<?= $coffee_type?>">