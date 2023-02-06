<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}
?>
<?php
$ordersSql = $conn->prepare("SELECT batch_order_no FROM batch_processing_order
                            JOIN grn USING(batch_order_no) 
                            WHERE customer_id=?
                            GROUP BY batch_order_no");
$customer_id = $_GET['q'];
$ordersSql->bind_param("s", $customer_id);
$ordersSql->execute();
$allOrders = $ordersSql -> get_result();
$rows = $conn -> affected_rows;

echo '<option></option>';
for ($i=1; $i<=$rows; $i++){
  $order = $allOrders -> fetch_assoc();
  $batch_order_no = $order['batch_order_no'];
  ?>
  <option value="<?= $batch_order_no ?>"><?= $batch_order_no ?></option>
  <?php
}




?>