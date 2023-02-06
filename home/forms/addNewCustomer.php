<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "factory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $conn->prepare("INSERT INTO customer (customer_name, city, telephone, email) 
        VALUES (?, ?, ?, ?)");
$sql->bind_param("ssis", $customer_name, $city, $telephone, $email);

function sanitize_table($tabledata)
{
    $tabledata=stripslashes($tabledata);
    $tabledata=strip_tags($tabledata);
    $tabledata=htmlentities($tabledata);
    return $tabledata;
}

$customer_name = sanitize_table($_POST['customerName']);
$city = sanitize_table($_POST['customerCity']);
$telephone =sanitize_table($_POST['customerTel']);
$email = sanitize_table($_POST['customerEmail']);
if ($customer_name==""){
    echo "Customer Name is required";
} else{
    $sql->execute();
}


$conn->close();
header("location:newCustomer.php");
exit();
?>
