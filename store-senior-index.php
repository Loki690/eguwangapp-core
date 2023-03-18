<?php 

    include('header.php');
    require_once('class.php');

    $all_stores = $store->showAllStores();

    include('config.php');
    
  if(!isset($_SESSION)){
    session_start();
  }
  // type of user can access
  if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
    $user = $_SESSION['UserLogin'];
    $session_id = $_SESSION['ID'];


  }else{
    echo '<script language="javascript">';
    echo 'alert("Access Denied!");';
    echo 'window.location="index.php";';
    echo '</script>';
  }

  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
	$senior = $con->query($sql) or die ($con->error);
	$row1 = $senior->fetch_assoc();

  // fetching image from seniors table
  $sql_img = "SELECT * FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  $senior_img = $con->query($sql_img) or die ($con->error);
  $row_img = $senior_img->fetch_assoc();

  $city = $row_img['city'];
  $barangay = $row_img['barangay'];

  $sql_get = mysqli_query($con,"SELECT * FROM `remittances` WHERE `status` = 0 AND `city` = '$city' AND `barangay` = '$barangay'");
  $count = mysqli_num_rows($sql_get);

  include('cart-count.php');

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
					<a class="nav-link" href="senior-cart.php">
					   <i class="fa fa-cart-shopping size-icon-1" style="color: white;"></i><span class="badge bg-danger notif"><?= $cart_count; ?></span>
					</a> 								  
				  </li>
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
						<a class="dropdown-item" href="senior-myorders.php"><i class="fa fa-cog size-icon-1"></i> <span>My Orders</span></a>
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
					<a href="senior-home.php">
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
					<a href="store-senior-index.php" class="active">
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
    <h1><i class='bx bxs-store icon px-3'></i></i>Shop</h1>
    <p></p>
  </div>
			<div class="row">
        
      <header class="py-5" style="background-image: url('img/seniorBanner.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;">
        <div class="px-4 px-lg-5 my-5">
            <div class="text-center text-white col-md-12 col-sm-12">
                <h1 class="display-5 fw-bolder text-white">Shop with E-Guwang Partnered Stores</h1>
                <p class="lead fw-normal text-white mb-0">Get Reasonable discounts with these stores</p>
            </div>
        </div>
      </header>

       <!-- Section-->
       <section class="py-5">
            <div class="container px-4 px-lg-5 mt-3">
                <div class="row gx-2 gx-lg-2 row-cols-1 row-cols-md-3 row-cols-xl- justify-content-center">
                <?php foreach($all_stores as $store){ ?>

                    <div class="col mb-5">
                        <div class="card h-100 bg-white" style="background-color: #df6c46;">
                            <!-- Product image-->
                            <img class="card-img-top" src="uploads/<?= $store['image']; ?>" alt="..." height="250px" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $store['store_name'] ?></h5>
                                    <!-- Product price-->
                                    <div class="text-dark">
                                    <?= $store['address'] ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-primary btn-lg mt-auto" href="store-details.php?id=<?= $store['id'];?>" style="border-radius: 0;">View store</a></div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    
       
                    
                   
                    
                   
                    
                    
                </div>
            </div>
        </section>

		</div>
	</div>
  </div>

  <?php
  include('footer.php');
  ?>


