<?php
include('config.php');

include('header.php');


  $id = $_GET['id'];
    $status = "Canceled";
    $sql = "UPDATE `orders` SET `store_status`='$status' WHERE `id` = '$id'";

    if ($con->query($sql) === TRUE) {
        ?>
        <script>
        Swal.fire(
            'Order Canceled',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="store-orders.php";
          })
         
        </script>
          <?php

    } else {
      ?>
      <script>
        alert('Unsuccessful!');
        window.location.href="store-myproducts.php";
      </script>
        <?php
    }
      

?>