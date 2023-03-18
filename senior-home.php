
<?php
include('config.php');

if(!isset($_SESSION)){
	session_start();
}
// type of user can access 
if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
	$user = $_SESSION['UserLogin'];
	$session_id = $_SESSION['ID'];
	$senior_id = $_SESSION['seniorid'];

}else{
	echo '<script language="javascript">';
	echo 'alert("Access Denied!");';
	echo 'window.location="index.php";';
	echo '</script>';
}
// get data form announcement
	

		$sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
		$senior = $con->query($sql) or die ($con->error);
		$row1 = $senior->fetch_assoc();
		
	 // fetching image from seniors table
		$sql_img = "SELECT * FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
		$senior_img = $con->query($sql_img) or die ($con->error);
		$row_img = $senior_img->fetch_assoc();

		$city = $row_img['city'];
		$brgy = $row_img['barangay'];

		$sql = "SELECT * FROM announcements WHERE `brgy` = '$brgy' ORDER BY id DESC";
		$annoucement = $con->query($sql) or die ($con->error);
		$row = $annoucement->fetch_assoc();
		
		include('notification-count.php');

?>

<!doctype html>
<html lang="en">
  <head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Senior Home</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->

	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  
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
			<div class="content-header">
		
				<h1><i class='bx bxs-home px-3'></i>Home</h1>
				<p></p>
			</div>
			
			<div class="row">
				<?php if(!empty($row)){ ?>
			<?php do{  ?>


				<div class="col-md-12 col-lg-12">
					<div class="card"> 
						<div class="card-header">
							<div>
							<h4><?= $row['type'] ?> <span class="badge bg-warning text-sm-endbhg\';
							"><?= $row['city'] ?></span> <span class="badge bg-success"><?= $row['brgy'] ?></span></h4>
							</div>
							
							<p>Posted by: <span class="badge bg-primary"><?= $row['user'] ?></span></p>
						</div>
						<div class="card-body pb-4">
							<div class="card-title text-black px-4">
								<h3 class="fw-bold"><?= $row['title'] ?></h3></div>
							<div class="recent-message d-flex px-4 py-3">
								<div class="name ms">
									<h5 class="mb-1"><?= $row['message'] ?></h5>
								</div>
							</div>

							<?php 
                 $sql_response = "SELECT * FROM `announcement_responses` WHERE `announcement_id` = '".$row['id']."' AND `user_id` = '".$_SESSION['ID']."'";
                	$response = $con->query($sql_response) or die ($con->error);
                	$result = $response->fetch_assoc();
               ?>
							<?php if(isset($result['response']) == "responded"){?>

								<?php if($result['iscancelled'] == 1){ ?>

									<div class="px-3 col-md-6 col-sm-12 col-lg-12">
										<a href="senior-respond.php?ID=<?php echo $row['id']?>">
										<button class='btn btn-block btn-xl btn-primary btn-lg font-bold mt-3'>
											View</button>
										</a>
									</div>

								<?php }else{ ?>

									<a href="senior-respond.php?ID=<?php echo $row['id']?>">
										<button class="btn btn-warning text-black btn-lg w-100"><i class="bi bi-check"></i>View</button>
									</a>

									<?php } ?>

							<?php }else{ ?>

							<div class="px-3 col-md-12 col-sm-12 col-lg-12">
								<a href="senior-respond.php?ID=<?php echo $row['id']?>">
								<button class='btn btn-block btn-xl btn-primary btn-lg font-bold mt-3'>
									View</button>
								</a>
							</div>
							<?php } ?>
						</div>          
					</div>
				</div>
				<?php }while($row = $annoucement->fetch_assoc()); ?> 
				<?php } else{?>
					<div class="col-md-12">
						<h2>No Announcement Yet</h2>
					</div>
					<?php } ?>
		   </div>
		</div>
	</div>


	<!-- Footer -->				
	<footer>
		<div class="footer">
			<div class="float-start">
				<!-- <p>2022 &copy; Atrana</p> -->
			</div>
		</div>
	</footer>
	
	<!-- Preloader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<!-- Loader -->
	<div class="loader-overlay"></div>

	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="assets/modules/apexcharts/apexcharts.js"></script>
	<script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
 </body>
</html>
