<?php 
include('config.php');
include("session.php");

  $id = $_GET['ID'];
    $sql = "DELETE FROM seniors WHERE id = '$id'";
    if ($con->query($sql) === TRUE) {
        ?>
        <script>
          alert('Susccessful deleted!');
          window.location.href="osca-senior-list.php";
        </script>
          <?php
    } else {
      ?>
      <script>
        alert('Unsuccessful!');
        window.location.href="osca-dashboard.php";
      </script>
        <?php
    }
      $conn->close();

?>