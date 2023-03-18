<?php
include('config.php');

include('header.php');


  $id = $_GET['id'];

    $select_order = "SELECT * FROM `orders` WHERE `id` = '$id'";
    $order = $con->query($select_order) or die($con->error);
    $order_result = $order->fetch_assoc();

    $p_id = $order_result['product_id'];
    $p_order = $order_result['qty'];

    $select_items = "SELECT * FROM `product_items` WHERE `product_id` = '$p_id'";
    $items = $con->query($select_items) or die($con->error);
    $items_result = $items->fetch_assoc();

    $item_qty = $items_result['qty'];

  
    $total = $item_qty - $p_order;

    $qty_update = "UPDATE `product_items` SET `qty`='$total' WHERE `product_id` = '$p_id'";
    $con->query($qty_update) or die($con->error);
    
    $status = "Preparing";

    $sql = "UPDATE `orders` SET `store_status`='$status' WHERE `id` = '$id'";

    if ($con->query($sql) === TRUE) {
        ?>
        <script>
        Swal.fire(
            'Order Preparing',
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