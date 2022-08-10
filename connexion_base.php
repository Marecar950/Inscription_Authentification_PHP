<?php

$host_name = "sql210.epizy.com";
$database = "epiz_32347783_users";
$username = "epiz_32347783";
$password = "5Lx6hxRtT4LGY";

try {
  $pdo=new PDO('mysql:host='.$host_name.';dbname='.$database,$username,$password);
  }
  catch (PDOException $e) {
  echo "Error! : ".$e->getMessage();
  }
?>
