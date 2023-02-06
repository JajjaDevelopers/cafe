<?php 
$orderNo = intval($_GET['updatedOrderNumber']);
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "factory";
                
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT customer_name, grade_name, batch_order_input_qty, batch_order_mc
        FROM batch_processing_order
        JOIN customer USING (customer_id) WHERE (batch_order_no=' ".$orderNo." ')";

$queryRequest = $conn->query($sql);
$orderResult = mysqli_fetch_array($queryRequest);
echo "<p>".$orderResult['customer_name']."</p>";


$conn->close();

?>