<?php 
    include('header.php');
    
    require_once('class.php');

    $id = $_GET['id'];

    $store_detail = $store->storeDetails($id);

    $store_products = $store->getStoreProduct($id);

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
    $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
    $senior_img = $con->query($sql_img) or die ($con->error);
    $row_img = $senior_img->fetch_assoc();
  
  
    include('notification-count.php');
    include('cart-count.php');
  
    // If the form was submitted, search the database


    if(isset($_POST['search'])){
      $category = $_POST['select'];

      $query = "SELECT * FROM `products` WHERE `product_type` = '$category' ";
      $result = $con->query($query);

      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
  }







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
	<div class="content-start transition">
		<div class="container-fluid dashboard">
			<div class="row">
        <div class="col-md-12">
          <div class="div"></div>
        </div>
      <header class="py-5" style="background-image: url('img/elder.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;">

        <div class="px-4 px-lg-5 my-5">
            <div class="text-center text-white col-md-12 col-sm-12">
              <div class="img">
                <img src="uploads/<?= $store_detail['image'] ?>" alt="" height="100px;">
              </div>
                <h1 class="display-5 fw-bolder text-white">Shop with <?= $store_detail['store_name']; ?></h1>
                <p class="lead fw-normal text-white mb-0">Get Reasonable discounts with <?= $store_detail['store_name']; ?></p>
            </div>
        </div>
      </header>

       <!-- Section-->
       <!-- <div class="col-md-12 mt-3">
        <div class="row">
        <div class="col-auto col-md-4">
          <form action="" method="POST" class=" d-flex">

              <select class="form-select" name="select" id="select" aria-placeholder="Category">
                <option value="">All Products</option>
                <option value="Dairy">Dairy</option>
                <option value="Fruits">Fruits</option>
                <option value="Grains">Grains</option>
                <option value="Protien">Protien Foods</option>
                <option value="Beverages">Beverages</option>
                <option value="Ready to Eat">Ready to Eat</option>
              </select>    

          <div class="col">
          <button class="btn btn-primary btn-lg w-100" type="submit" name="search">Filter</button>
        </div>

        </form>
        </div>
    
        </div>
       </div> -->
       <section class="py-5">
            <div class="container px-4 px-lg-5 mt-1">
            <div class="row gx-2 gx-lg-2 row-cols-1 row-cols-md-3 row-cols-xl- justify-content-center">
              <?php if(!empty($store_products)){ ?>
                <?php foreach($store_products as $product){ ?>

                  <?php 
                      
                      $detail = $product['id'];
                      $item = $store->getProductDetails($detail);
                      $inventory_stocks = array();
                      
                      $order = $store->getOrderDetails($item['storeid']);

                      $sum = $item['total'];
                      $inventory_stocks[] = $sum;

                  ?>
                 
                    <div class="col mb-5">
                        <div class="card h-100 bg-white" style="background-color: #df6c46;">
                        <div class="badge bg-success text-white position-absolute" style="top: 0.5rem; right: 0.5rem">5% Discount</div>
                            <!-- Product image-->
                            <a href="product-details.php?id=<?= $product['id']; ?>">
                            <img class="card-img-top" src="uploads/<?= $product['image']; ?>" alt="..." height="250px" />
                            </a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $product['product_name']?></h5>
                                    <!-- Product price-->
                                    <div class="text-dark">
                                    <p>Available: <?= array_sum($inventory_stocks) ?></p>
                                    </div>
                                    <?php
                                       if(array_sum($inventory_stocks) <= $item['min_stocks'] && array_sum($inventory_stocks) != 0) { ?>

                                      <p class="bg-warning">Low Stocks!</p>
                                          <div class="text-black">
                                            <strong>
                                            <?= "₱".$item['Price'].".00"; ?> 
                                          </strong>
                                        </div>
                                        <!-- <div class="p-4 pt-0 border-top-0 bg-transparent mt-3">
                                            <div class="text-center"><a class="btn btn-primary btn-lg mt-auto" href="product-details.php?id=<?= $product['id']; ?>" style="border-radius: 0;">View</a></div>
                                        </div> -->
                                          <?php }elseif(array_sum($inventory_stocks) == 0 ){ ?>
                                          
                                            <p class="text bg-danger">Out of Stocks!</p>

                                          <?php }else{ ?>
                                            <div class="bg-success">
                                            <p class="text-bg-success text-white">On Sale!</p>
                                            </div>
                                          <div class="text-black">
                                            <strong>
                                            <?= "₱".$item['Price'].".00"; ?> 
                                          </strong>
                                        </div>
                                        <!-- <div class="p-4 pt-0 border-top-0 bg-transparent mt-3">
                                            <div class="text-center"><a class="btn btn-primary w-100 mt-auto" href="product-details.php?id=<?= $product['id']; ?>" style="border-radius: 0;">View Product</a></div>
                                        </div> -->
                                        <?php } ?> 
                                </div>
                            </div>
                           
                        </div>
                    </div>
                  

                    <?php } ?>
                    <?php }else{ ?>
                    <div class="col-md-12 d-flex justify-content-center">
                      <div class="card">
                        <h4>No Products Yet</h4>
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


