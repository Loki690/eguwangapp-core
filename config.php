<?php
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "3eguwangapp";
$con = new mysqli('localhost', 'root','', '3eguwangapp');
if($con->connect_error){
  echo $con->connect_error;
}else{
  return $con;
  echo "connected";
}
?>