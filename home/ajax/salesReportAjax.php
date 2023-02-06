<?php require ("../private/database.php"); ?>

<?php
// $conn = new mysqli("localhost", "root", "root", "factory");
$query = "SELECT customer_id, customer_name, contact_person, telephone FROM customer WHERE (customer_id=?) ";


$stmt = $conn->prepare($query);
$id = $_GET['q'];
$selectedId = substr($id, 0, 6);
$stmt->bind_param("s", $selectedId);
$stmt->execute();
$stmt->bind_result($customer_id, $customer_name, $contact_person, $telephone);
$stmt->fetch();
$stmt->close();

echo '<input id="cid" value="'.$customer_id.'">';
echo '<input id="name" value="'.$customer_name.'">';
echo '<input id="contactPerson" value="'.$contact_person.'">';
echo '<input id="tel" value="+256'.$telephone.'">';





?>