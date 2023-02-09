<?php
$server="localhost";
$db="factory";
$user="root";
$pwd="root";
$charset="utf8mb4";

// $server="localhost";
// $db="jajjcrmv_factory";
// $user="jajjcrmv_isaac";
// $pwd="GO-sS?6~4A*k";
// $charset="utf8mb4";

$options=[
  \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
  \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
  \PDO::ATTR_EMULATE_PREPARES=>false,
];

//creating a connection to the database
$dsn="mysql:host=$server;dbname=$db;charset=$charset";
try{
   $pdo=new \PDO($dsn,$user,$pwd);
} catch(\PDOException $e)
{
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
};

//Isaac
$conn = new mysqli($server, $user, $pwd, $db);
?>