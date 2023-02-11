<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
$id = $_POST['newClientId'];
$name = $_POST['customerName'];
$contPerson = $_POST['contactPerson'];
$tel = $_POST['telephone'];
$email = $_POST['email'];
// $region = $_POST['region'];
$district = $_POST['district'];
$category = $_POST['category'];
$membership = $_POST['membership'];
$city = $_POST['city'];

$clientSql = $conn->prepare("INSERT INTO customer (customer_id, customer_name, city, contact_person, telephone, 
                            email, district_id, category, membership) VALUES (?,?,?,?,?,?,?,?,?)");
$clientSql->bind_param("sssssssss", $id, $name, $city, $contPerson, $tel, $email, $district, $category, $membership);
$clientSql->execute();
$clientSql->close();


header("Location:../forms/newClient");
?>