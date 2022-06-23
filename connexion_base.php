<?php

$host_name = "localhost";
$database = "users";
$username = "marecar";
$password = "mdpasse_marec";

try {
  $pdo=new PDO('mysql:host='.$host_name.';dbname='.$database,$username,$password);
  }
  catch (PDOException $e) {
  echo "Error! : ".$e->getMessage();
  }
?>
