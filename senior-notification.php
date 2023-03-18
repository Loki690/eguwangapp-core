<?php
include('header.php'
);
include('session.php');
include('config.php');
if(!isset($_SESSION)){
  session_start();
}
$sql_senior = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
$senior = $con->query($sql_senior) or die ($con->error);
$row_senior = $senior->fetch_assoc();

// fetching image from seniors table
$sql_img = "SELECT * FROM  `seniors` WHERE `seniorcitizen_id` = '".$row_senior['seniorcitizen_id']."'";
$senior_img = $con->query($sql_img) or die ($con->error);
$row_img = $senior_img->fetch_assoc();

$city = $row_img['city'];
$barangay = $row_img['barangay'];

$sql = "SELECT * FROM `remittances` WHERE `city` = '$city' AND `barangay` = '$barangay' ORDER BY `id` DESC";
$remittance = $con->query($sql) or die ($con->error);
$row = $remittance->fetch_assoc();

$sql_get = mysqli_query($con,"SELECT * FROM `remittances` WHERE `status` = 0 AND `city` = '$city' AND `barangay` = '$barangay'");
$count = mysqli_num_rows($sql_get);

?>

   <!--Topbar -->
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
			
					
        <?php do { ?>
					<?php if(!empty($row)) { ?>
					<?php if($row['isdeleted'] != "yes") {?>
				<div class="col-md-12 col-lg-12">
					<div class="card">
            <a href="senior-nconfirmation.php?id=<?php echo $row['id']; ?>">
            <div class="card-body"> 
            <div class="mb-2"><span class="badge bg-warning">Ayuda</span>
            <span class="badge bg-primary"><?= $row['user'] ?></span>
            </div>
            
            <h4 class="notification-title mb-1"> Ayuda has arrived <?php echo $row['amount']; ?></h4>
						  <ul class="notification-meta list-inline mb-0 text-black">
				        <li class="list-inline-item"><?= $row['created_at'] ?></li>
				        <li class="list-inline-item">|</li>
                <li class="list-inline-item">System</li>
						  </ul>
              <?php 
                $sql_confirm = "SELECT `status` FROM `remittance_responses` WHERE `remittance_id` = '".$row['id']."' AND `user_id` = '".$_SESSION['ID']."'";
                $response = $con->query($sql_confirm) or die ($con->error);
                $result_confirm = $response->fetch_assoc();
                ?>

             <div class="mt-4">
              <?php if(isset($result_confirm['status']) != 1){?>
								
                    <small class="text-warning">Please confirm</small>
								

               <?php }else {?>

              <small class="text-secondary">Confirmed</small>
							
               <?php } ?>
							 <!-- delete-notif.php?id=<?= $row['id']?> -->
							 <a href=""><small class="text-danger">| Delete </small></a>	
             </div>
					
						 
					</div>
            </a>
				</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
					<h1>No Notificaton Yet</h1>
					<?php } ?>

        <?php }while($row = $remittance->fetch_assoc()); ?>

			
			</div>

		</div> <!-- End Container -->
	</div><!-- End Content -->
	
<?php
include('footer.php')
?>