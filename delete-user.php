<?php 
include('config.php');
include("session.php");

  $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";

    if ($con->query($sql) === TRUE) {
        ?>
        <script>
          alert('Susccessfully deleted!');
          window.location.href="users.php";
        </script>
          <?php
    } else {
      echo $con->error;
    }
      $con->close();

?>