<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}
?>
<?php
$idCode = substr($_GET['q'], 0, 3);
// if $idCode[]

$countSql = $conn->prepare("SELECT RIGHT(customer_id, 3) AS codeNo FROM customer WHERE LEFT(customer_id, 3) = ? ");
$countSql->bind_param("s", $idCode);
$countSql->execute();
$result = $countSql->get_result();

$codes = $conn->affected_rows;
$codeList = array(0);
for ($x=0; $x<$codes; $x++){
    $row = $result->fetch_assoc();
    $nextNo = $row['codeNo'] ;
    array_push($codeList, $nextNo);
}
$maxCode = max($codeList);
$newCodeNo = $maxCode+1;
if ($newCodeNo < 10){
    $nextCode = $idCode."00".$newCodeNo;
} elseif($newCodeNo < 100){
    $nextCode = $idCode."0".$newCodeNo;
}else{$nextCode = $idCode.$newCodeNo;}
echo $nextCode;

?>