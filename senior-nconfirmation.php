<?php

  include('header.php');
  include('config.php');
  
  if(!isset($_SESSION)) {
    session_start();
  }

  if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
    $user = $_SESSION['UserLogin'];
    $session_id = $_SESSION['ID'];

  }else{
    echo '<script language="javascript">';
    echo 'alert("Access Denied!");';
    echo 'window.location="index.php";';
    echo '</script>';
  }
  
  $id = $_GET['id'];
  
  // if(isset($_GET['id'])){
  //   $id = $_GET['id'];
   
  // }
  

  $sql = "SELECT * FROM remittances WHERE id = '$id' ";
  $remittance = $con->query($sql) or die ($con->error);
  $row = $remittance->fetch_assoc();

  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
  $senior = $con->query($sql) or die ($con->error);
  $row1 = $senior->fetch_assoc();
  
 // fetching image from seniors table
  $sql_img = "SELECT * FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  $senior_img = $con->query($sql_img) or die ($con->error);
  $row_img = $senior_img->fetch_assoc();

  function trasacID(){
    $floor = FLOOR(RAND() * 401) + 100;
    $id = $floor.rand(10,20);
  
    return $id;
  }
  
  $transId = trasacID();

 //remittance confirmation
  if(isset($_POST['confirm'])){

    $user_id = $_POST['user_id'];
    $id = $_GET['id'];
    $rimittance_info = $_POST['r-mode'];
    $r_info = $_POST['r-info'];

    $status = 1; 
    $sql_insert = "INSERT INTO `remittance_responses`(`remittance_id`, `user_id`, `status`, `remittance_info`, `account_info`) 
    VALUES ('$id', '$user_id', '$status', '$rimittance_info', '$r_info')";

    if($con->query($sql_insert) === TRUE){

      $sql_update = mysqli_query($con, "UPDATE `remittances` SET status = 1 WHERE id = $id");
      ?>
        <script>
          Swal.fire(
            'Confirmed',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-notification.php";
          })
        </script>
      <?php
    }else { //die($con->error);
      echo "Error: ". $sql_insert . "<br>". $con->error;
    }
    $con->close();
  }

  include('notification-count.php');

?>

<div class="topbar transition bg-primary fixed-top pb-5">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
	
			<li class="nav-item">
					<a class="nav-link" href="senior-notification.php">
					   <i class="fa fa-bell size-icon-1" style="color: white;"></i>
						 <?php if($count == 0) {?>
					
						<?php }else{ ?>
							<span class="badge bg-danger notif"> 
							<?php echo $count; ?> 
						</span>
							<?php } ?>
					</a> 								  
				  </li>
			 
				  <li class="nav-item dropdown">
					<?php if(isset($_SESSION['UserLogin'])){?>
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="uploads/<?php echo $row_img['image'] ?>" alt="">
					</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="senior-profile.php"><i class="fa fa-user size-icon-1"></i> <span><?php echo $_SESSION['UserLogin'];?></span></a>
						<a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
						<hr class="dropdown-divider">
						<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>Logout</span></a>
					</ul>
				  </li>
			</ul>
			<?php } ?>
		</div>
	</div>

	<!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-0">E-Guwang</h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="senior-home.php" class="active">
						<i class='bx bxs-home icon' ></i> Home
					</a>
				</li>
        <li>
					<a href="senior-booklet.php">
					<i class='bx bxs-book-open icon'></i>
						Booklet
					</a>
				</li>
				<li>
					<a href="store-senior-index.php">
						<i class='bx bxs-store icon'></i> 
						Shop
					</a>
				</li>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->

  <div class="sidebar-overlay"></div>

	<!--Content Start-->
	<div class="content-start transition mt-5">
		<div class="container-fluid dashboard">
    <div class="content-header hstack g-3 mb-3">
        <div>
          <h1><i class="bi bi-bell-fill"></i></i></h1>
				</div>
        <div class="px-4">
        <h1>Notifications</h1>
        </div>
       </div>
			<div class="row">
        
				<div class="col-md-12 col-lg-12">
					<div class="card">
            
            <div class="card-body"> 
            <div class="mb-2"><span class="badge bg-warning">Ayuda</span>
            <span class="badge bg-primary"><?= $row['user'] ?> </span>
            <div class="mt-2">
            <span>
              <ul class="notification-meta list-inline mb-0 text-black">
				        <li class="list-inline-item"><?= $row['created_at'] ?></li>
				        <li class="list-inline-item">|</li>
                <li class="list-inline-item">System</li>
						  </ul>
            </span>
            </div>
            </div>
            <div class="dflex justify-content-center text-center">
            <h4 class="notification-title mb-1"> <?php echo $row['amount']." Pesos"; ?></h4>
            <div class="mt-4">
              <h5><?= $row['comment'] ?></h5>
              <p>Your remittance will be straight to your selected remittance mode: </p>
              <p><?= $row_img['remittance_mode']; ?>:
              <?php if($row_img['remittance_mode'] == "Land Bank") {?>
              <span>Account Number - <?= $row_img['bankinfo'] ?> </span>
              <?php }elseif($row_img['remittance_mode'] == "Gcash"){ ?>
                <span><?= $row_img['gcashinfo'] ?> </span>
                <?php }elseif($row_img['remittance_mode'] == "Physical"){ ?>
                  <span>Physical Claiming</span>
                  <?php }elseif($row_img['remittance_mode'] == ""){?>
                    <span class="text-danger">Please set remittance mode information</span>
                    <?php } ?>
            </p>
            </div>
						 
              <?php 
                $sql_confirm = "SELECT `status` FROM `remittance_responses` WHERE `remittance_id` = '".$row['id']."' AND `user_id` = '".$_SESSION['ID']."'";
                $response = $con->query($sql_confirm) or die ($con->error);
                $result_confirm = $response->fetch_assoc();
                ?>

             <div class="text-warning mt-43">

              <?php if(isset($result_confirm['status']) != 1){?>

                   <form action="" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $session_id;?>">

                    <?php if($row_img['remittance_mode'] == "Land Bank"){ ?>
                      <input type="hidden" name="r-mode" value="<?= $row_img['remittance_mode'] ?>">
                      <input type="hidden" name="r-info" value="<?= $row_img['bankinfo']; ?>">
                    <?php }elseif($row_img['remittance_mode'] == "Gcash"){ ?>
                      <input type="hidden" name="r-mode" value="<?= $row_img['remittance_mode'] ?>">
                      <input type="hidden" name="r-info" value="<?= $row_img['gcashinfo']; ?>">
                      <?php }else{ ?>
                        <input type="hidden" name="r-mode" value="Physical Claiming">
                        <?php } ?>

                    <div class="px-3 col-md-6 col-sm-12 col-lg-12 mt-5 pt-5">
                      <button type="submit" name="confirm" class='btn btn-block btn-xl btn-primary btn-lg font-bold mt-3'>
                        Confirm
                      </button>
                    </div>
                   </form>

               <?php }else {?>
                <h5 class="text-primary ">Confirmed</h5>
               <?php } ?>
             </div>
            </div>
            
					</div>
           
				</div>
				</div>
       
			</div>

		</div> <!-- End Container -->
	</div><!-- End Content -->




<?php
include('footer.php');
?>