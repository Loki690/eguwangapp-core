<?php
  // notification count
  
include('config.php');
if(!isset($_SESSION)){
  session_start();
}
$sql_senior = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
$senior = $con->query($sql_senior) or die ($con->error);
$row_senior1 = $senior->fetch_assoc();

$user_id = $row_senior1['id'];

// fetching image from seniors table
$sql_img = "SELECT * FROM  `seniors` WHERE `seniorcitizen_id` = '".$row_senior1['seniorcitizen_id']."'";
$senior_img = $con->query($sql_img) or die ($con->error);
$row_img = $senior_img->fetch_assoc();

$city = $row_img['city'];
$barangay = $row_img['barangay'];

$sql_get = mysqli_query($con,"SELECT * FROM `cart` WHERE `user_id` = '$user_id' AND `count` = 0 AND `status` != 'order' AND `isdeleted` != 'yes' ");

$cart_count = mysqli_num_rows($sql_get);

?>