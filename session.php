<?php
  session_start();
  if(!isset($_SESSION['UserLogin'])){
  header("location:login.php");
  }else{
    $session_id = $_SESSION['ID'];
  }
?>