
<?php include "../private/database.php";
if($conn->connect_error) {
  exit('Could not connect');
}


$sql = "SELECT batch_order_no, customer_id, customer_name, batch_order_input_qty, batch_order_mc, grade_name FROM batch_processing_order
        JOIN grn USING (batch_order_no) 
        JOIN customer USING (customer_id) 
        WHERE batch_order_no=0 ";

$stmt = $conn->prepare($sql);
$orderNo = intval($_GET['q']) ;
$stmt->bind_param("s", $orderNo );
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($no, $cid, $name, $inputQty, $mcIn, $grade);
$stmt->fetch();
$stmt->close();

echo '<input id="ajaxCustomerName" value="'.$name.'">';
echo '<input id="ajaxCustomerId" value="'.$cid.'">';
echo '<input id="ajaxInputQty" value="'.$inputQty.'">';
echo '<input id="ajaxMcIn" value="'.$mcIn.'">';
echo '<input id="ajaxInputGrade" value="'.$grade.'">';
?>