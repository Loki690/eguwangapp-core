<?php 
include('config.php');
include('header.php');


  $id = $_GET['id'];

    $isdeleted = "yes";
    
    $sql = "UPDATE `remittances` SET `isdeleted`='$isdeleted' WHERE `id` = '$id'";
    
    if ($con->query($sql) === TRUE) {
        ?>
        <script>
        Swal.fire(
            'Successfully Deleted!',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-notification.php";
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